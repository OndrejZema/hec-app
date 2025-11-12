<?php

namespace App\Controller;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Form\HouseFormType;
use App\Service\Interface\IHouseService;
use App\Service\Interface\IPerformanceProfileService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PerformanceProfileController extends HecAbstractController
{
    public function __construct(
        protected IHouseService              $houseService,
        protected IPerformanceProfileService $performanceProfileService)
    {

    }

    #[Route('/performance/profile', name: 'app_performance_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getAppUser();

        $page = $request->query->getInt("page", 0);
        $perPage = $request->query->getInt("perPage", 0);
        $houseId = $request->query->getInt("houseId", 0);

        if ($page === 0 || $perPage === 0 || $houseId === 0) {
            return $this->redirectToRoute('app_performance_profile', [
                'page' => 1,
                'perPage' => 10,
                'houseId' => $this->houseService->getSelectedId($user)
            ]);
        }

        if ($request->headers->get('turbo-frame')) {
            list($performanceProfiles, $pagination) = $this->performanceProfileService->getAll($user, $houseId, $page, $perPage);

            return $this->render('performance_profile/_table_frame.html.twig', [
                'performanceProfiles' => $performanceProfiles,
                'pagination' => $pagination
            ]);
        }

        return $this->render('performance_profile/index.html.twig', [
            'houseId' => $houseId,
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }
    #[Route('/performance-profiles/create', name: 'app_performance_profile_create')]
    public function create(Request $request): Response
    {
        $user = $this->getAppUser();
        $performanceProfile = new CreatePerformanceProfileDto();

        $form = $this->createForm(HouseFormType::class, $performanceProfile);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $performanceProfile = $form->getData();
            $this->performanceProfileService->create($user, $performanceProfile);
            return $this->redirectToRoute('app_performance_profile');
        }

        return $this->render('performance_profile/create.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/houses/update/{id}', name: 'app_house_update')]
    public function update(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $performanceProfileDto = $this->performanceProfileService->getById($user, $id);
        //@todo check houseDto
        $performanceProfile = new UpdatePerformanceProfileDto();
        $performanceProfile->id = $performanceProfileDto->id;
        $performanceProfile->name = $performanceProfileDto->name;
        $performanceProfile->description = $performanceProfileDto->description;
        $performanceProfile->type = $performanceProfileDto->type;
        $performanceProfile->profileDay = $performanceProfileDto->profileDay;
        $performanceProfile->profileWeek = $performanceProfileDto->profileWeek;
        $performanceProfile->profileMonth = $performanceProfileDto->profileMonth;
        $performanceProfile->profileYear = $performanceProfileDto->profileYear;
        $form = $this->createForm(HouseFormType::class, $performanceProfile, [
            'data_class' => UpdatePerformanceProfileDto::class
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $house = $form->getData();
            $this->performanceProfileService->update($user, $house);
            return $this->redirectToRoute('app_performance_profile');
        }
        return $this->render('performance_profile/create.html.twig', [
            'form' => $form,
        ]);
    }


}
