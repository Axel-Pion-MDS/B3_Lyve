<?php

namespace App\Controller;

use App\Entity\Part;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Normalizer\QuestionNormalizer;
use App\Repository\QuestionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question', name: 'question')]
class QuestionController extends AbstractController
{
    private QuestionRepository $questionRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    public function __construct(QuestionRepository $questionRepository, ManagerRegistry $doctrine)
    {
        $this->questionRepository = $questionRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $question = $this->questionRepository->findAll();
            $normalizer = QuestionNormalizer::listNormalizer($question);
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
            $question = $this->questionRepository->find($id);
            if ($question === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested question not found.";
            } else {
                $normalizer = QuestionNormalizer::showNormalizer($question);
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

            $question = new Question();
            $form = $this->createForm(QuestionType::class, $question);

            if (isset($content['part'])) $content['part'] = $this->findPart($content['part'])->getId();

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($question);
                $em->flush();

                $this->status['msg'] = "Question added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'questionId' => $question->getId()];
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
            $question = $this->questionRepository->find($id);

            if ($question === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested question not found.";
            } else {
                $form = $this->createForm(QuestionType::class, $question);

                if (isset($content['part'])) $content['part'] = $this->findPart($content['part'])->getId();

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($question);
                    $em->flush();

                    $this->status['msg'] = "Question edited.";
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
            $question = $this->questionRepository->find($id);

            if ($question === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested question not found.";
            } else {
                $em->remove($question);
                $em->flush();

                $this->status['msg'] = "Question deleted.";
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg']];
        } catch (Exception $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    public function findPart(int $data): Part
    {
        return $this->doctrine->getRepository(Part::class)->find($data);
    }
}
