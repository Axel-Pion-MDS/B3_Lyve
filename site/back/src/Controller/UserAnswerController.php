<?php

namespace App\Controller;

use App\Entity\UserAnswer;
use App\Form\UserAnswerType;
use App\Repository\UserAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/answer')]
class UserAnswerController extends AbstractController
{
    #[Route('/', name: 'app_user_answer_index', methods: ['GET'])]
    public function index(UserAnswerRepository $userAnswerRepository): Response
    {
        return $this->render('user_answer/index.html.twig', [
            'user_answers' => $userAnswerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserAnswerRepository $userAnswerRepository): Response
    {
        $userAnswer = new UserAnswer();
        $form = $this->createForm(UserAnswerType::class, $userAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userAnswerRepository->add($userAnswer);
            return $this->redirectToRoute('app_user_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_answer/new.html.twig', [
            'user_answer' => $userAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_answer_show', methods: ['GET'])]
    public function show(UserAnswer $userAnswer): Response
    {
        return $this->render('user_answer/show.html.twig', [
            'user_answer' => $userAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserAnswer $userAnswer, UserAnswerRepository $userAnswerRepository): Response
    {
        $form = $this->createForm(UserAnswerType::class, $userAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userAnswerRepository->add($userAnswer);
            return $this->redirectToRoute('app_user_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_answer/edit.html.twig', [
            'user_answer' => $userAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_answer_delete', methods: ['POST'])]
    public function delete(Request $request, UserAnswer $userAnswer, UserAnswerRepository $userAnswerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userAnswer->getId(), $request->request->get('_token'))) {
            $userAnswerRepository->remove($userAnswer);
        }

        return $this->redirectToRoute('app_user_answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
