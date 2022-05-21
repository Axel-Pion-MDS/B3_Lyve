<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Module;
use App\Entity\Part;
use App\Form\ChapterType;
use App\Normalizer\ChapterNormalizer;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chapter', name: 'chapter')]
class ChapterController extends AbstractController
{
    private ChapterRepository $chapterRepository;
    private ManagerRegistry $doctrine;
    private array $status = ['result' => 'success', 'msg' => ''];


    public function __construct(ChapterRepository $chapterRepository, ManagerRegistry $doctrine)
    {
        $this->chapterRepository = $chapterRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $chapter = $this->chapterRepository->findAll();
            $normalizer = ChapterNormalizer::listNormalizer($chapter);
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
            $chapter = $this->chapterRepository->find($id);
            if ($chapter === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested chapter not found.";
            } else {
                $normalizer = ChapterNormalizer::showNormalizer($chapter);
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

            $chapter = new Chapter();
            $form = $this->createForm(ChapterType::class, $chapter);

            $parts = [];
            if (isset($content['parts'])) {
                foreach ($content['parts'] as $part) {
                    $parts[] = $this->findPart($part)->getId();
                }
            }

            $content['module'] = isset($content['module']) ? $this->findModule($content['module'])->getId() : [];
            $content['parts'] = $parts;

            $request->request->add($content);
            $form->submit($request->request->all(), true);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($chapter);
                $em->flush();

                $this->status['msg'] = "Chapter added.";
            } else if ($form->isSubmitted() && !$form->isValid()) {
                $this->status['result'] = "error";
                $this->status['msg'] = sprintf('Error in form: "%s"', $form->getErrors(true)->current()->getMessage());
            }

            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'chapterId' => $chapter->getId()];
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
            $chapter = $this->chapterRepository->find($id);

            if ($chapter === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested chapter not found.";
            } else {
                $form = $this->createForm(ChapterType::class, $chapter);

                $parts = [];
                if (isset($content['parts'])) {
                    foreach ($content['parts'] as $part) {
                        $parts[] = $this->findPart($part)->getId();
                    }
                }

                $content['module'] = isset($content['module']) ? $this->findModule($content['module'])->getId() : [];
                $content['parts'] = $parts;

                $request->request->add($content);
                $form->submit($request->request->all(), true);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($chapter);
                    $em->flush();

                    $this->status['msg'] = "Chapter edited.";
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
            $chapter = $this->chapterRepository->find($id);

            if ($chapter === null) {
                $this->status['result'] = "error";
                $this->status['msg'] = "Requested chapter not found.";
            } else {
                $em->remove($chapter);
                $em->flush();

                $this->status['msg'] = "Chapter deleted.";
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

    public function findPart(int $data): Part
    {
        return $this->doctrine->getRepository(Part::class)->find($data);
    }
}
