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
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;

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

    /**
     * List every users
     * @return JsonResponse
     */
    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $env = $this->getParameter('kernel.environment');

        try {
            if ($env === 'dev' || ($env === 'prod' && ($this->getUser()?->getRoles() &&
                        in_array("ROLE_ADMIN", $this->getUser()?->getRoles(), true)))
            ) {
                $users = $this->userRepository->findAll();
                $normalizer = UserNormalizer::listNormalizer($users);
            } else {
                $this->status['result'] = 'error';
                $this->status['msg'] = 'the user is not authenticated';
            }

            $response = [
                'result' => $this->status['result'],
                'msg' => $this->status['msg'],
                'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = [
                'result' => $this->status['result'],
                'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())
            ];
        }

        return new JsonResponse($response);
    }

    /**
     * Show a user details
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/show', name: '_show', methods: ['POST'])]
    public function show(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $email = $content['body']['email'];
            $user = $this->findUserWithEmail($email);

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

    /**
     * Add a new user
     *
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return JsonResponse
     */
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

                // Send an email to user with this password
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
//            $role = (!empty($content['role'])) ? $this->findRole($content['role']) : $this->findRole(1);
//            if (!empty($content['offer'])) $offer = $this->findOffer($content['offer']);
//            $content['role'] = $role->getId();
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

    /**
     * Delete a user
     *
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * Edit a user
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/edit', name: '_edit', methods: ['PATCH'])]
    public function edit(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $id = $content['body']['id'];
            $user = $this->userRepository->find($id);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $badges = [];
                if (!empty($content['body']['badges'])) {
                    foreach ($content['body']['badges'] as $item) {
                        $badges[] = $this->findBadge($item)->getId();
                    }
                }

                $answers = [];
                if (!empty($content['body']['answers'])) {
                    foreach ($content['body']['answers'] as $item) {
                        $answers[] = $this->findAnswer($item)->getId();
                    }
                }

                $content['body']['badges'] = $badges;
                $content['body']['answers'] = $answers;
//                $content['role'] = $role->getId();
//                if (isset($offer)) $content['offer'] = $offer->getId();
                $content['body']['password'] = $user->getPassword();

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

    /**
     * Edit a user's mail
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/editmail', name: '_editmail', methods: ['PATCH'])]
    public function editEmail(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $email = $content['body']['user'];
            $user = $this->findUserWithEmail($email);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $content['body']['firstname'] = $user->getFirstname();
                $content['body']['lastname'] = $user->getLastname();
                $content['body']['password'] = $user->getPassword();
                $content['body']['birthdate'] = $user->getBirthdate()?->format('Y-m-d');
                $content['body']['number'] = $user->getNumber();


                $request->request->add($content['body']);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($user);
                    $em->flush();

                    $this->status['msg'] = "Email edited.";
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

    /**
     * Edit a user's number
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/editnumber', name: '_editnumber', methods: ['PATCH'])]
    public function editNumber(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $email = $content['body']['user'];
            $user = $this->findUserWithEmail($email);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $content['body']['firstname'] = $user->getFirstname();
                $content['body']['lastname'] = $user->getLastname();
                $content['body']['email'] = $user->getEmail();
                $content['body']['password'] = $user->getPassword();
                $content['body']['birthdate'] = $user->getBirthdate()?->format('Y-m-d');


                $request->request->add($content['body']);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($user);
                    $em->flush();

                    $this->status['msg'] = "Number edited.";
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

    /**
     * Edit a user's password
     *
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return JsonResponse
     */
    #[Route('/editpassword', name: '_editpassword', methods: ['PATCH'])]
    public function editPassword(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $email = $content['body']['user'];
            $user = $this->findUserWithEmail($email);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested user not found.";
            } else {
                $form = $this->createForm(UserType::class, $user);

                $content['body']['firstname'] = $user->getFirstname();
                $content['body']['lastname'] = $user->getLastname();
                $content['body']['email'] = $user->getEmail();
                $content['body']['birthdate'] = $user->getBirthdate()?->format('Y-m-d');
                $content['body']['number'] = $user->getNumber();

                if (!$passwordHasher->isPasswordValid($user, $content['body']['actualPassword'])) {
                    $this->status['result'] = "error";
                    $this->status['msg'] = "Passwords do not match";
                    $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];

                    return new JsonResponse($response);
                }

                if ($content['body']['newPassword'] === $content['body']['repeatNewPassword']) {
                    $hashPassword = $passwordHasher->hashPassword(
                        $user,
                        $content['body']['newPassword']
                    );

                    $content['body']['password'] = $hashPassword;
                } else {
                    $this->status['result'] = "error";
                    $this->status['msg'] = "Passwords do not match";
                    $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];

                    return new JsonResponse($response);
                }

                $request->request->add($content['body']);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($user);
                    $em->flush();

                    $this->status['msg'] = "Password edited.";
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

    /**
     * Get a user's timesheet
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/timesheet', name: '_timesheet', methods: ['POST'])]
    public function userTimesheet(Request $request): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $email = $content['body']['email'];
            $user = $this->findUserWithEmail($email);

            if ($user === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested timesheet not found.";
            } else {
                $normalizer = UserNormalizer::timesheetNormalizer($user);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    /**
     * Find a user from its email
     *
     * @param string $email
     * @return User | null
     */
    public function findUserWithEmail(string $email): User | null
    {
        return $this->doctrine->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    /**
     * Find role from integer
     * @param int $data
     * @return Role
     */
    public function findRole(int $data): Role
    {
        return $this->doctrine->getRepository(Role::class)->find($data);
    }

    /**
     * Find offer from integer
     *
     * @param int $data
     * @return Offer
     */
    public function findOffer(int $data): Offer
    {
        return $this->doctrine->getRepository(Offer::class)->find($data);
    }

    /**
     * Find badge from integer
     * @param int $data
     * @return Badge
     */
    public function findBadge(int $data): Badge
    {
        return $this->doctrine->getRepository(Badge::class)->find($data);
    }

    /**
     * Find answer from integer
     *
     * @param int $data
     * @return Answer
     */
    public function findAnswer(int $data): Answer
    {
        return $this->doctrine->getRepository(Answer::class)->find($data);
    }

}
