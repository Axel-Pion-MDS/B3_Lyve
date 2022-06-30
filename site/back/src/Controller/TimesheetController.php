<?php

namespace App\Controller;

use App\Entity\Timesheet;
use App\Entity\User;
use App\Form\TimesheetType;
use App\Normalizer\TimesheetNormalizer;
use App\Repository\TimesheetRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/timesheet', name: 'timesheet')]
class TimesheetController extends AbstractController
{
    private array $status = ['result' => 'success', 'msg' => ''];

    public function __construct(
        private TimesheetRepository $timesheetRepository,
        private ManagerRegistry $doctrine
    ) {}

    /**
     * @return JsonResponse
     */
    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
//            if ($this->getUser()?->getRoles() && in_array("ROLE_ADMIN" | "ROLE_COACH" | "ROLE_ADVISER", $this->getUser()?->getRoles(), true)) {
//                $timesheets = $this->timesheetRepository->findAll();
//                dd($timesheets);
//                $normalizer = TimesheetNormalizer::listNormalizer($timesheets);
//            } else {
//                $this->status['result'] = 'error';
//                $this->status['msg'] = 'the user is not authenticated';
//            }

            $timesheets = $this->timesheetRepository->findAll();
            $normalizer = TimesheetNormalizer::listNormalizer($timesheets);

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/show', name: '_show', requirements: ["id" => "^[1-9]\d*$"], methods: ['GET'])]
    public function show(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            $timesheet = $this->timesheetRepository->find($id);

            if ($timesheet === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested timesheet not found.";
            } else {
                $normalizer = TimesheetNormalizer::showNormalizer($timesheet);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/add', name: '_add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $em = $this->doctrine->getManager();
            $timesheet = new Timesheet();
            $form = $this->createForm(TimesheetType::class, $timesheet);

            $users = [];
            if (!empty($content['body']['users'])) {
                foreach ($content['body']['users'] as $item) {
                    $users[] = $this->findUser($item)->getId();
                }
            } else {
                $users[] = $this->findUserWithEmail("admin.lyve@gmail.com")->getId();
            }

            $content['body']['users'] = $users;
            $content['body']['status'] = 1;

            $request->request->add($content['body']);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($timesheet);
                $em->flush();

                $this->status['msg'] = "Timesheet added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'timesheetId' => $timesheet->getId()];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/edit', name: '_edit', methods: ['PATCH'])]
    public function edit(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $id = $content['id'];
            $timesheet = $this->timesheetRepository->find($id);

            if ($timesheet === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested timesheet not found.";
            } else {
                $form = $this->createForm(TimesheetType::class, $timesheet);

                $users = [];
                if (!empty($content['user'])) {
                    foreach ($content['user'] as $item) {
                        $users[] = $this->findUser($item)->getId();
                    }
                }

                $content['user'] = $users;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($timesheet);
                    $em->flush();

                    $this->status['msg'] = "Timesheet edited.";
                } else if ($form->isSubmitted() && !$form->isValid()) {
                    $this->status['result'] = "error";
                    $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
                }
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/delete', name: '_delete', requirements: ["id" => "^[1-9]\d*$"], methods: ['DELETE'])]
    public function delete(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $id = $request->get('id');
            $timesheet = $this->timesheetRepository->find($id);

            if ($timesheet === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested timesheet not found.";
            } else {
                $em->remove($timesheet);
                $em->flush();

                $this->status['msg'] = "Timesheet deleted.";
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * @param int $data
     * @return User
     */
    public function findUser(int $data): User
    {
        return $this->doctrine->getRepository(User::class)->find($data);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findUserWithEmail(string $email): User
    {
        return $this->doctrine->getRepository(User::class)->findOneBy(['email' => $email]);
    }
}
