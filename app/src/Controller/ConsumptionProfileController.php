<?php

namespace App\Controller;

use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Dto\ConsumptionProfile\UpdateConsumptionProfileDto;
use App\Form\ConsumptionProfileFormType;
use App\Service\Interface\IConsumptionProfileService;
use App\Service\Interface\IHouseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConsumptionProfileController extends HecAbstractController
{
    public function __construct(
        protected IHouseService              $houseService,
        protected IConsumptionProfileService $consumptionProfileService)
    {

    }

    #[Route('/consumption-profiles', name: 'app_consumption_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getAppUser();

        $page = $request->query->getInt("page", 0);
        $perPage = $request->query->getInt("perPage", 0);

        if ($page === 0 || $perPage === 0) {
            return $this->redirectToRoute('app_consumption_profile', [
                'page' => 1,
                'perPage' => 10,
            ]);
        }
        $houseId = $this->houseService->getCurrentId($user);
        if ($request->headers->get('turbo-frame')) {
            list($consumptionProfiles, $pagination) = $this->consumptionProfileService->getAll($user, $houseId, $page, $perPage);
            return $this->render('consumption_profile/_table_frame.html.twig', [
                'consumptionProfiles' => $consumptionProfiles,
                'pagination' => $pagination
            ]);
        }

        return $this->render('consumption_profile/index.html.twig', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    #[Route('/consumption-profiles/create', name: 'app_consumption_profile_create')]
    public function create(Request $request): Response
    {
        $user = $this->getAppUser();
        $performanceProfile = new CreateConsumptionProfileDto();

        $form = $this->createForm(ConsumptionProfileFormType::class, $performanceProfile);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $performanceProfile = $form->getData();
            $this->consumptionProfileService->create($user, $performanceProfile);
            return $this->redirectToRoute('app_consumption_profile');
        }

        return $this->render('consumption_profile/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/consumption-profiles/update/{id}', name: 'app_consumption_profile_update')]
    public function update(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $consumptionProfileDto = $this->consumptionProfileService->getById($user, $id);
        //@todo check houseDto
        $consumptionProfile = new UpdateConsumptionProfileDto();
        $consumptionProfile->id = $consumptionProfileDto->id;
        $consumptionProfile->name = $consumptionProfileDto->name;
        $consumptionProfile->description = $consumptionProfileDto->description;
        $consumptionProfile->type = $consumptionProfileDto->type;
        $consumptionProfile->consumptionIndex = $consumptionProfileDto->consumptionIndex;
        $consumptionProfile->profileDay = $consumptionProfileDto->profileDay;
        $consumptionProfile->profileWeek = $consumptionProfileDto->profileWeek;
        $consumptionProfile->profileMonth = $consumptionProfileDto->profileMonth;
        $consumptionProfile->profileYear = $consumptionProfileDto->profileYear;
        $form = $this->createForm(ConsumptionProfileFormType::class, $consumptionProfile, [
            'data_class' => UpdateConsumptionProfileDto::class
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $house = $form->getData();
            $this->consumptionProfileService->update($user, $house);
            return $this->redirectToRoute('app_consumption_profile');
        }
        return $this->render('consumption_profile/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/consumption-profiles/delete/{id}', name: 'app_consumption_profile_delete', methods: ['POST'])]
    public function delete(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $this->consumptionProfileService->delete($user, $id);
        return $this->redirectToRoute('app_consumption_profile');
    }
}
