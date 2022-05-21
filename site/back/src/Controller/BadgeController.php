<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Entity\Module;
use App\Entity\User;
use App\Form\BadgeType;
use App\Normalizer\BadgeNormalizer;
use App\Repository\BadgeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/badge', name: 'badge')]
class BadgeController extends AbstractController
{
    private BadgeRepository $badgeRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    public function __construct(BadgeRepository $badgeRepository, ManagerRegistry $doctrine)
    {
        $this->badgeRepository = $badgeRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $badge = $this->badgeRepository->findAll();
            $normalizer = BadgeNormalizer::listNormalizer($badge);
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
            $badge = $this->badgeRepository->find($id);
            if ($badge === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested badge not found.";
            } else {
                $normalizer = BadgeNormalizer::showNormalizer($badge);
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

            $badge = new Badge();
            $form = $this->createForm(BadgeType::class, $badge);

            $modules = [];
            if (!empty($content['modules'])) {
                foreach ($content['modules'] as $module) {
                    $modules[] = $this->findModule($module)->getId();
                }
            }

            $users = [];
            if (!empty($content['users'])) {
                foreach ($content['users'] as $user) {
                    $users[] = $this->findUser($user)->getId();
                }
            }

            $content['modules'] = $modules;
            $content['users'] = $users;

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($badge);
                $em->flush();

                $this->status['msg'] = "Badge added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'badgeId' => $badge->getId()];
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
            $badge = $this->badgeRepository->find($id);

            if ($badge === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested badge not found.";
            } else {
                $form = $this->createForm(BadgeType::class, $badge);

                $modules = [];
                if (!empty($content['modules'])) {
                    foreach ($content['modules'] as $module) {
                        $modules[] = $this->findModule($module)->getId();
                    }
                }

                $users = [];
                if (!empty($content['users'])) {
                    foreach ($content['users'] as $user) {
                        $users[] = $this->findUser($user)->getId();
                    }
                }

                $content['modules'] = $modules;
                $content['users'] = $users;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($badge);
                    $em->flush();

                    $this->status['msg'] = "Badge edited.";
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
            $badge = $this->badgeRepository->find($id);

            if ($badge === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested badge not found.";
            } else {
                $em->remove($badge);
                $em->flush();

                $this->status['msg'] = "Badge deleted.";
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

    public function findUser(int $data): User
    {
        return $this->doctrine->getRepository(User::class)->find($data);
    }
}
