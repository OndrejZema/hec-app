<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\Interface\IHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HouseController extends HecAbstractController
{
    public function __construct(protected IHouseRepository $houseRepository)
    {
    }

    #[Route('/house', name: 'app_house')]
    public function index(Request $request): Response|RedirectResponse
    {
        $page = $request->query->getInt("page", -1);
        $perPage = $request->query->getInt("perPage", -1);

        if($page === -1 || $perPage === -1) {
            return $this->redirectToRoute('app_house', [
                'page' => 1,
                'perPage' => 10,
            ]);
        }

        if ($request->headers->get('turbo-frame')) {
            $user = $this->getAppUser();
            $houses = $this->houseRepository->findByUser($user);
            return $this->render('house/_table_frame.html.twig', [
                'houses' => $houses,
                'page' => $page,
                'perPage' => $perPage,
            ]);
        }

        return $this->render('house/index.html.twig', [
            'controller_name' => 'HouseController',
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }
}
