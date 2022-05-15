<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Offer;
use App\Form\ModuleType;
use App\Normalizer\ModuleNormalizer;
use App\Repository\ModuleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/module', name: 'module')]
class ModuleController extends AbstractController
{
    private ModuleRepository $moduleRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    public function __construct(ModuleRepository $moduleRepository, ManagerRegistry $doctrine)
    {
        $this->moduleRepository = $moduleRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $module = $this->moduleRepository->findAll();
            $normalizer = ModuleNormalizer::listNormalizer($module);
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
            $module = $this->moduleRepository->find($id);

            if ($module === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested module not found.";
            } else {
                $normalizer = ModuleNormalizer::showNormalizer($module);
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

            $module = new Module();
            $form = $this->createForm(ModuleType::class, $module);

            if (!empty($content['offers'])) {
                foreach ($content['offers'] as $offer) {
                    $offers[] = $this->findOffer($offer)->getId();
                }
            }

            if (isset($offers)) $content['offers'] = $offers;

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($module);
                $em->flush();

                $this->status['msg'] = "Module added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'moduleId' => $module->getId()];
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
            $module = $this->moduleRepository->find($id);

            if ($module === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested module not found.";
            } else {
                $form = $this->createForm(ModuleType::class, $module);

                if (!empty($content['offers'])) {
                    foreach ($content['offers'] as $offer) {
                        $offers[] = $this->findOffer($offer)->getId();
                    }
                }

                if (isset($offers)) $content['offers'] = $offers;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($module);
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
            $module = $this->moduleRepository->find($id);

            if ($module === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested role not found.";
            } else {
                $em->remove($module);
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

    public function findOffer(int $data): Offer
    {
        return $this->doctrine->getRepository(Offer::class)->find($data);
    }
}
