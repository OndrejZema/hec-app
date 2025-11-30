<?php

namespace App\Controller;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Form\PerformanceProfileFormType;
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

    #[Route('/performance-profiles', name: 'app_performance_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getAppUser();

        $page = $request->query->getInt("page", 0);
        $perPage = $request->query->getInt("perPage", 0);

        if ($page === 0 || $perPage === 0) {
            return $this->redirectToRoute('app_performance_profile', [
                'page' => 1,
                'perPage' => 10,
            ]);
        }
        $houseId = $this->houseService->getCurrentId($user);
        if ($request->headers->get('turbo-frame')) {
            list($performanceProfiles, $pagination) = $this->performanceProfileService->getAll($user, $houseId, $page, $perPage);
            return $this->render('performance_profile/_table_frame.html.twig', [
                'performanceProfiles' => $performanceProfiles,
                'pagination' => $pagination
            ]);
        }

        return $this->render('performance_profile/index.html.twig', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }
    #[Route('/performance-profiles/create', name: 'app_performance_profile_create')]
    public function create(Request $request): Response
    {
        $user = $this->getAppUser();
        $performanceProfile = new CreatePerformanceProfileDto();

        $form = $this->createForm(PerformanceProfileFormType::class, $performanceProfile);

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
    #[Route('/performance-profiles/update/{id}', name: 'app_performance_profile_update')]
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
        $performanceProfile->performanceIndex = $performanceProfileDto->performanceIndex;
        $performanceProfile->profileDay = $performanceProfileDto->profileDay;
        $performanceProfile->profileWeek = $performanceProfileDto->profileWeek;
        $performanceProfile->profileMonth = $performanceProfileDto->profileMonth;
        $performanceProfile->profileYear = $performanceProfileDto->profileYear;
        $form = $this->createForm(  PerformanceProfileFormType::class, $performanceProfile, [
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

    #[Route('/performance-profiles/delete/{id}', name: 'app_performance_profile_delete', methods: ['POST'])]
    public function delete(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $this->performanceProfileService->delete($user, $id);
        return $this->redirectToRoute('app_performance_profile');
    }
}
