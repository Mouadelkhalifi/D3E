<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\VtkUser;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    private JWTTokenManagerInterface $jwtManager;
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->jwtManager = $jwtManager;
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['username']) || !isset($data['password'])) {
            return new JsonResponse(['message' => 'Username and password are required'], 400);
        }

        $username = $data['username'];
        $password = $data['password'];

        $this->logger->info('Attempting login for username: ' . $username);

        $user = $this->entityManager->getRepository(VtkUser::class)->findOneBy(['username' => $username]);

        if (!$user) {
            $this->logger->info('User not found');
            return new JsonResponse(['message' => 'Invalid credentials'], 401);
        }

        $this->logger->info('Stored password hash: ' . $user->getPassword());

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            $this->logger->info('Invalid password');
            return new JsonResponse(['message' => 'Invalid credentials'], 401);
        }

        $token = $this->jwtManager->create($user);

        // Temporairement, pour le débogage
        $this->logger->info('JWT Passphrase: ' . $_ENV['JWT_PASSPHRASE']);

        return new JsonResponse(['token' => $token]);
    }
}
