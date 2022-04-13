<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Entity\User;
use App\Normalizer\UserNormalizer;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user')]
class UserController extends AbstractController
{
    private $userRepository;
    private $status = ['result' => 'success', 'msg' => ''];

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception levée : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response, Response::HTTP_OK);
    }

    #[Route('/show', name: '_show', methods: ['GET'], requirements: ["id" => "^[1-9]\d*$"])]
    public function show(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        try {
            $id = $request->get('id');
            $em = $doctrine->getManager();
            $user = $em->getRepository(User::class)->find($id);

            if (empty($user)) {
                $this->status['result'] = "error";
                $this->status['msg'] = "L'utilisateur demandé n'a pas été trouvé";
            } else {
                $data = UserNormalizer::showNormalizer($user);
            }
            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $data];
        } catch (\Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception levée : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response, Response::HTTP_FOUND);
    }

    #[Route('/add', name: '_add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $newUser = new User();

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $birthdate = date_create_immutable_from_format('Y-m-d', $data['birthdate']);
        $number = $data['number'];
        $role = $data['role'] ?? null;
        $offer = $data['offer'] ?? null;
        $badges = array_key_exists('badges', $data) ? $newUser->addBadge($data['badges']) : null;
        $modules = array_key_exists('modules', $data) ? $newUser->addModule($data['modules']) : null;


        $user[] = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthdate' => $birthdate,
            'number' => $number,
            'role' => $role,
            'offer' => $offer,
            'created_at' => new \DateTimeImmutable('now'),
            'updated_at' => new \DateTimeImmutable('now'),
        ];

        if ($badges != null) {
            $user[] = [
                'badges' => $badges,
            ];
        }
        if ($modules != null) {
            $user[] = [
                'modules' => $modules,
            ];
        }


        if (empty($firstname) || empty($lastname) || empty($email) || empty($birthdate) || empty($number)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->userRepository->add($user);

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
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
}
