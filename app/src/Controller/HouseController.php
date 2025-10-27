<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\Interface\IHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HouseController extends AbstractController
{
    public function __construct(protected IHouseRepository $houseRepository)
    {
    }

    #[Route('/house', name: 'app_house')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Musíš být přihlášen');
        }

        $houses = $this->houseRepository->findByUser($user);
        return $this->render('house/index.html.twig', [
            'controller_name' => 'HouseController',
            'houses' => $houses
        ]);
    }
}
