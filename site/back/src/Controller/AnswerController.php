<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\User;
use App\Form\AnswerType;
use App\Normalizer\AnswerNormalizer;
use App\Repository\AnswerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/answer', name: 'answer')]
class AnswerController extends AbstractController
{
    private AnswerRepository $answerRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    /**
     * @param AnswerRepository $answerRepository
     * @param ManagerRegistry $doctrine
     */
    public function __construct(AnswerRepository $answerRepository, ManagerRegistry $doctrine)
    {
        $this->answerRepository = $answerRepository;
        $this->doctrine = $doctrine;
    }

    /**
     * List every answer fetched from database
     *
     * @return JsonResponse
     */
    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $answer = $this->answerRepository->findAll();
            $normalizer = AnswerNormalizer::listNormalizer($answer);
            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage())];
        }

        return new JsonResponse($response);
    }

    /**
     * Show answer's details from answer's ID
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/show', name: '_show', requirements: ["id" => "^[1-9]\d*$"], methods: ['GET'])]
    public function show(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            $answer = $this->answerRepository->find($id);
            if ($answer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested answer not found.";
            } else {
                $normalizer = AnswerNormalizer::showNormalizer($answer);
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $normalizer ?? []];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    /**
     * Add an answer from request
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/add', name: '_add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        try {
            $em = $this->doctrine->getManager();
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $answer = new Answer();
            $form = $this->createForm(AnswerType::class, $answer);

            if (isset($content['question'])) $content['question'] = $this->findQuestion($content['question'])->getId();

            $users = [];
            if (isset($content['users'])) {
                foreach ($content['users'] as $user) {
                    $users[] = $this->findUser($user)->getId();
                }
            }

            $content['users'] = $users;

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($answer);
                $em->flush();

                $this->status['msg'] = "Answer added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'answerId' => $answer->getId()];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    /**
     * Edit an answer from request
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
            $id = $content['id'];
            $answer = $this->answerRepository->find($id);

            if ($answer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested answer not found.";
            } else {
                $form = $this->createForm(AnswerType::class, $answer);

                if (isset($content['question'])) $content['question'] = $this->findQuestion($content['question'])->getId();

                $users = [];
                if (isset($content['users'])) {
                    foreach ($content['users'] as $user) {
                        $users[] = $this->findUser($user)->getId();
                    }
                }

                $content['users'] = $users;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($answer);
                    $em->flush();

                    $this->status['msg'] = "Answer edited.";
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
     * Delete an answer from answer's ID
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
            $answer = $this->answerRepository->find($id);

            if ($answer === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested answer not found.";
            } else {
                $em->remove($answer);
                $em->flush();

                $this->status['msg'] = "Answer deleted.";
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    /**
     * Fetch question related to the ID
     *
     * @param int $data
     * @return Question
     */
    public function findQuestion(int $data): Question
    {
        return $this->doctrine->getRepository(Question::class)->find($data);
    }

    /**
     * Fetch user related to the ID
     *
     * @param int $data
     * @return User
     */
    public function findUser(int $data): User
    {
        return $this->doctrine->getRepository(User::class)->find($data);
    }
}
