<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Offer;
use App\Form\OfferType;
use App\Normalizer\OfferNormalizer;
use App\Repository\OfferRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/offer', name: 'offer')]
class OfferController extends AbstractController
{
    private OfferRepository $offerRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    public function __construct(OfferRepository $offerRepository, ManagerRegistry $doctrine)
    {
        $this->offerRepository = $offerRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $offer = $this->offerRepository->findAll();
            $normalizer = OfferNormalizer::listNormalizer($offer);
            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    #[Route('/show', name: '_show', requirements: ["id" => "^[1-9]\d*$"], methods: ['GET'])]
    public function show(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            $offer = $this->offerRepository->find($id);

            if ($offer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested offer not found.";
            } else {
                $normalizer = OfferNormalizer::showNormalizer($offer);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/add', name: '_add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $offer = new Offer();
            $form = $this->createForm(OfferType::class, $offer);

            $modules = [];
            if (!empty($content['modules'])) {
                foreach ($content['modules'] as $module) {
                    $modules[] = $this->findModule($module)->getId();
                }
            }

            $content['modules'] = $modules;

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($offer);
                $em->flush();

                $this->status['msg'] = "Offer added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'offerId' => $offer->getId()];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/edit', name: '_edit', methods: ['PATCH'])]
    public function edit(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $id = $content['id'];
            $offer = $this->offerRepository->find($id);

            if ($offer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested offer not found.";
            } else {
                $form = $this->createForm(OfferType::class, $offer);

                $modules = [];
                if (!empty($content['modules'])) {
                    foreach ($content['modules'] as $module) {
                        $modules[] = $this->findModule($module)->getId();
                    }
                }

                $content['modules'] = $modules;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($offer);
                    $em->flush();

                    $this->status['msg'] = "Offer edited.";
                } else if ($form->isSubmitted() && !$form->isValid()) {
                    $this->status['result'] = "error";
                    $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
                }
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/delete', name: '_delete', requirements: ["id" => "^[1-9]\d*$"], methods: ['DELETE'])]
    public function delete(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $id = $request->get('id');
            $offer = $this->offerRepository->find($id);

            if ($offer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested role not found.";
            } else {
                $em->remove($offer);
                $em->flush();

                $this->status['msg'] = "Offer deleted.";
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    public function findModule(int $data): Module
    {
        return $this->doctrine->getRepository(Module::class)->find($data);
    }
}
