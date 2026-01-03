<?php

namespace App\Controller;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Form\HouseFormType;
use App\Service\Interface\IHouseService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HouseController extends HecAbstractController
{
    public function __construct(
        protected IHouseService $houseService
    )
    {
    }

    #[Route('/houses', name: 'app_house')]
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
            list($houses, $pagination) = $this->houseService->getAll($user, $page, $perPage);

            return $this->render('house/_table_frame.html.twig', [
                'houses' => $houses,
                'pagination' => $pagination
            ]);
        }

        return $this->render('house/index.html.twig', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    #[Route('/houses/create', name: 'app_house_create')]
    public function create(Request $request): Response
    {
        $user = $this->getAppUser();
        $house = new CreateHouseDto();

        $form = $this->createForm(HouseFormType::class, $house);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $house = $form->getData();
            $this->houseService->create($user, $house);
            return $this->redirectToRoute('app_house');
        }

        return $this->render('house/form.html.twig', [
            'currentHouse' => 'house 1',
            'form' => $form,
        ]);
    }

    #[Route('/houses/update/{id}', name: 'app_house_update')]
    public function update(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $houseDto = $this->houseService->getById($user, $id);
        //@todo check houseDto
        $house = new UpdateHouseDto();
        $house->id = $houseDto->id;
        $house->name = $houseDto->name;
        $house->description = $houseDto->description;
        $form = $this->createForm(HouseFormType::class, $house, [
            'data_class' => UpdateHouseDto::class
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $house = $form->getData();
            $this->houseService->update($user, $house);
            return $this->redirectToRoute('app_house');
        }
        return $this->render('house/form.html.twig', [
            'currentHouse' => 'house 1',
            'form' => $form,
        ]);
    }

    #[Route('/houses/delete/{id}', name: 'app_house_delete', methods: ['POST'])]
    public function delete(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $this->houseService->delete($user, $id);
        return $this->redirectToRoute('app_house');
    }

    #[Route('/houses/visit/{id}', name: 'app_house_visit', methods: ['POST'])]
    public function visit(Request $request, int $id): RedirectResponse
    {
        $user = $this->getAppUser();
        $this->houseService->visit($user, $id);
        return $this->redirect($request->headers->get('referer'));
    }
}
