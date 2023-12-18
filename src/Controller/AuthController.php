<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;


class AuthController extends AbstractController
{
    private $em;
    private $JWTManager;
    private $encoder;

    public function __construct(EntityManagerInterface $em, JWTTokenManagerInterface $JWTManager,
        UserPasswordHasherInterface $encoder) {
        $this->em = $em;
        $this->JWTManager = $JWTManager;
        $this->encoder = $encoder;
    }

}
