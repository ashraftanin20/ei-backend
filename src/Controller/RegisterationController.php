<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class RegisterationController extends AbstractController
{
    #[Route('/register', name: 'app_registeration')]
    public function index(ManagerRegistry $doctrine, Request $request,
                          UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $em = $doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $username = $decoded->username;
        $email = $decoded->email;
        $plainPassword = $decoded->password;

        $user = new User();
        $hashPassword = $passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setEmail($email);
        $user->setPassword($hashPassword);
        $user->setUsername($username);
        $em->persist($user);
        $em->flush();
        return $this->json([
            'message' => 'Registered Successfully!',
            Response::HTTP_CREATED,
        ]);
    }
}
