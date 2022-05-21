<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Badge;
use App\Entity\Offer;
use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Normalizer\UserNormalizer;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user')]
class UserController extends AbstractController
{
    private UserRepository $userRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];

    public function __construct(UserRepository $userRepository, ManagerRegistry $doctrine)
    {
        $this->userRepository = $userRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $users = $this->userRepository->findAll();
            $normalizer = UserNormalizer::listNormalizer($users);
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
            $user = $this->userRepository->find($id);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $normalizer = UserNormalizer::showNormalizer($user);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/add', name: '_add', methods: ['POST'])]
    public function add(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $em = $this->doctrine->getManager();
            $user = new User();
            $form = $this->createForm(UserType::class, $user);

            if (!empty($content['password'])) {
                $hashPassword = $passwordHasher->hashPassword(
                    $user,
                    $content['password']
                );
            } else {
                $random = random_int(1, 10);
                $hashPassword = $passwordHasher->hashPassword(
                    $user,
                    $random
                );
            }

            $badges = [];
            if (!empty($content['badges'])) {
                foreach ($content['badges'] as $item) {
                    $badges[] = $this->findBadge($item)->getId();
                }
            }

            $answers = [];
            if (!empty($content['answers'])) {
                foreach ($content['answers'] as $item) {
                    $answers[] = $this->findAnswer($item)->getId();
                }
            }

            $content['badges'] = $badges;
            $content['answers'] = $answers;
            $content['password'] = $hashPassword;
            $role = (!empty($content['role'])) ? $this->findRole($content['role']) : $this->findRole(1);
            if (!empty($content['offer'])) $offer = $this->findOffer($content['offer']);
            $content['role'] = $role->getId();
            if (isset($offer)) $content['offer'] = $offer->getId();

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($user);
                $em->flush();

                $this->status['msg'] = "User added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'userId' => $user->getId()];
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
            $user = $this->userRepository->find($id);

            if ($user === null) {
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

    #[Route('/edit', name: '_edit', methods: ['PATCH'])]
    public function edit(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $id = $content['id'];
            $user = $this->userRepository->find($id);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $role = (!empty($content['role'])) ? $this->findRole($content['role']) : $this->findRole(1);
                if (!empty($content['offer'])) $offer = $this->findOffer($content['offer']);

                $badges = [];
                if (!empty($content['badges'])) {
                    foreach ($content['badges'] as $item) {
                        $badges[] = $this->findBadge($item)->getId();
                    }
                }

                $answers = [];
                if (!empty($content['answers'])) {
                    foreach ($content['answers'] as $item) {
                        $answers[] = $this->findAnswer($item)->getId();
                    }
                }

                $content['badges'] = $badges;
                $content['answers'] = $answers;
                $content['role'] = $role->getId();
                if (isset($offer)) $content['offer'] = $offer->getId();
                $content['password'] = $user->getPassword();

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($user);
                    $em->flush();

                    $this->status['msg'] = "User edited.";
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

    public function findRole(int $data): Role
    {
        return $this->doctrine->getRepository(Role::class)->find($data);
    }

    public function findOffer(int $data): Offer
    {
        return $this->doctrine->getRepository(Offer::class)->find($data);
    }

    public function findBadge(int $data): Badge
    {
        return $this->doctrine->getRepository(Badge::class)->find($data);
    }

    public function findAnswer(int $data): Answer
    {
        return $this->doctrine->getRepository(Answer::class)->find($data);
    }
}
