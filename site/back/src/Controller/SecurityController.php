<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\NonUniqueResultException;
use Exception;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

#[Route('/security', name:'security')]
class SecurityController extends AbstractController
{
//    private UserAuthenticatorInterface $authenticatorManager;
    private array $status = ['result' => 'success', 'msg' => ''];

    #[Route('/login', name:'_login', methods:['POST'])]
    public function login(): JsonResponse
    {
        try {
            if (!$this->getUser()) {
                $this->status['result'] = "error";
                $this->status['msg'] = 'missing credentials';
            } else {
                $data = ['user' => $this->getUser()->getUserIdentifier(), 'roles' => $this->getUser()->getRoles()];
            }


            $response = ['result' => $this->status['result'], 'msg' => $this->status['msg'], 'data' => $data ?? []];
        } catch (Exception | NonUniqueResultException $e) {
            $this->status['result'] = "error";
            $response = ['result' => $this->status['result'], 'msg' => sprintf('Exception thrown : "%s"', $e->getMessage()), 'data' => []];
        }

        return new JsonResponse($response);
    }

    #[Route('/logout', name:'_logout', methods: ['GET'])]
    public function logout(): void
    {
    }
}
