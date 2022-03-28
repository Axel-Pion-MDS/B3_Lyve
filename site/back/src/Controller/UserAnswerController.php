<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAnswerController extends AbstractController
{
    #[Route('/user/answer', name: 'app_user_answer')]
    public function index(): Response
    {
        return $this->render('user_answer/index.html.twig', [
            'controller_name' => 'UserAnswerController',
        ]);
    }
}
