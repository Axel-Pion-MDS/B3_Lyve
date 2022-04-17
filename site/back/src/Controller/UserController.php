<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Entity\Offer;
use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Normalizer\UserNormalizer;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user')]
class UserController extends AbstractController
{
    private $userRepository;
    private $doctrine;
    private $status = ['result' => 'success', 'msg' => ''];

    public function __construct(UserRepository $userRepository, ManagerRegistry $doctrine)
    {
        $this->userRepository = $userRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function index(): JsonResponse
    {
        try {
            $users = $this->userRepository->findAll();
            $normalizer = UserNormalizer::listNormalizer($users);
            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], $normalizer];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    #[Route('/show', name: '_show', methods: ['GET'], requirements: ["id" => "^[1-9]\d*$"])]
    public function show(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            $user = $this->userRepository->find($id);

            if (empty($user)) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $data = UserNormalizer::showNormalizer($user);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $data];
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
            $content = json_decode($request->getContent(), true);
            $em = $this->doctrine->getManager();

            $user = new User();
            $form = $this->createForm(UserType::class, $user);

            $role = (array_key_exists('role', $content) || !empty($content['role'])) ? $this->setUserRole($content['role']) : $this->setUserRole(1);
            if (array_key_exists('offer', $content) || !empty($content['offer'])) $offer = $this->setUserOffer($content['offer']);
            if (array_key_exists('badge', $content) || !empty($content['badge'])) $badge = $this->setUserBadge($content['badge']);

            $content['role'] = $role->getId();
            if (isset($badge)) $content['badge'] = $badge->getId();
            if (isset($offer)) $content['offer'] = $offer->getId();

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $user->setCreatedAt(new DateTimeImmutable());
                $em->persist($user);
                $em->flush();

                $this->status['msg'] = "User added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/delete', name: '_delete', methods: ['DELETE'], requirements: ["id" => "^[1-9]\d*$"])]
    public function delete(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $id = $request->get('id');
            $user = $this->userRepository->find($id);

            if (empty($user)) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $em->remove($user);
                $em->flush();

                $this->status['msg'] = "User deleted.";
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/edit', name: '_edit', methods: ['POST'], requirements: ["id" => "^[1-9]\d*$"])]
    public function edit(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true);
            $id = $request->query->get('id');
            $user = $this->userRepository->find($id);

            if (empty($user)) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $role = (array_key_exists('role', $content) || !empty($content['role'])) ? $this->setUserRole($content['role']) : $this->setUserRole(1);
                if (array_key_exists('offer', $content) || !empty($content['offer'])) $offer = $this->setUserOffer($content['offer']);
                if (array_key_exists('badge', $content) || !empty($content['badge'])) $badge = $this->setUserBadge($content['badge']);

                $content['role'] = $role->getId();
                if (isset($badge)) $content['badge'] = $badge->getId();
                if (isset($offer)) $content['offer'] = $offer->getId();

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $user->setCreatedAt(new DateTimeImmutable());
                    $em->persist($user);
                    $em->flush();

                    $this->status['msg'] = "User edited.";
                } else if ($form->isSubmitted() && !$form->isValid()) {
                    $this->status['result'] = "error";
                    $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
                }

                $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
            }
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    public function setUserRole(int $data): Role
    {
        $roleRepository = $this->doctrine->getRepository(Role::class);
        return $roleRepository->find($data);
    }

    public function setUserOffer(int $data): Offer
    {
        $offerRepository = $this->doctrine->getRepository(Offer::class);
        return $offerRepository->find($data);
    }

    public function setUserBadge(int $data): Badge
    {
        $badgeRepository = $this->doctrine->getRepository(Badge::class);
        return $badgeRepository->find($data);
    }
}
