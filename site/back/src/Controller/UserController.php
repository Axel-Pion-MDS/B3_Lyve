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
use Symfony\Component\HttpFoundation\Response;
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
            $em = $this->doctrine->getManager();
            $user = $em->getRepository(User::class)->find($id);

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

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }
//    #[Route('/', name: 'app_user_index', methods: ['GET'])]
//    public function index(UserRepository $userRepository): Response
//    {
//        return $this->render('user/index.html.twig', [
//            'users' => $userRepository->findAll(),
//        ]);
//    }
//
//    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
//    public function new(Request $request, UserRepository $userRepository): Response
//    {
//        $user = new User();
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $userRepository->add($user);
//            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//
//        return $this->renderForm('user/new.html.twig', [
//            'user' => $user,
//            'form' => $form,
//        ]);
//    }
//
//    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
//    public function show(User $user): Response
//    {
//        return $this->render('user/show.html.twig', [
//            'user' => $user,
//        ]);
//    }
//
//    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
//    public function edit(Request $request, User $user, UserRepository $userRepository): Response
//    {
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $userRepository->add($user);
//            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('user/edit.html.twig', [
//            'user' => $user,
//            'form' => $form,
//        ]);
//    }
//
//    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
//    public function delete(Request $request, User $user, UserRepository $userRepository): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
//            $userRepository->remove($user);
//        }
//
//        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
//    }
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
