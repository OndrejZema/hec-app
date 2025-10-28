<?php

namespace App\Controller;

use App\Dto\HouseDto;
use App\Form\HouseFormType;
use App\Repository\Interface\IHouseRepository;
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
        $page = $request->query->getInt("page", 0);
        $perPage = $request->query->getInt("perPage", 0);

        if ($page === 0 || $perPage === 0) {
            return $this->redirectToRoute('app_house', [
                'page' => 1,
                'perPage' => 10,
            ]);
        }

        if ($request->headers->get('turbo-frame')) {
            $user = $this->getAppUser();
            $houses = $this->houseRepository->findByUser($user);
            $lastPage = 12;
            return $this->render('house/_table_frame.html.twig', [
                'houses' => $houses,
                'page' => $page,
                'perPage' => $perPage,
                'lastPage' => $lastPage
            ]);
        }

        return $this->render('house/index.html.twig', [
            'controller_name' => 'HouseController',
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    #[Route('/house/create', name: 'app_house_create')]
    public function create(Request $request): Response
    {
        $house = new HouseDto();

        $form = $this->createForm(HouseFormType::class, $house);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$house = $form->getData();
            //@todo create
            return $this->redirectToRoute('app_house');
        }

        return $this->render('house/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/house/update', name: 'app_house_update')]
    public function update(Request $request): Response
    {
        $house = new HouseDto();

        $form = $this->createForm(HouseFormType::class, $house);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$house = $form->getData();
            //@todo update
            return $this->redirectToRoute('app_house');
        }

        return $this->render('house/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/house/delete/{id}', name: 'app_house_delete', methods: ['POST'])]
    public function delete(Request $request): Response
    {
        //@todo delete
        return $this->redirectToRoute('app_house');
    }
}
