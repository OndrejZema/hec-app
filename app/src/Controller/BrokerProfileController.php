<?php

namespace App\Controller;

use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Dto\BrokerProfile\UpdateBrokerProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Form\BrokerProfileFormType;
use App\Service\Interface\IBrokerProfileService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BrokerProfileController extends HecAbstractController
{
    public function __construct(protected IBrokerProfileService $brokerProfileService)
    {

    }

    #[Route('/broker-profiles', name: 'app_broker_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getAppUser();
        $page = $request->query->getInt("page", 0);
        $perPage = $request->query->getInt("perPage", 0);

        if ($page === 0 || $perPage === 0) {
            return $this->redirectToRoute('app_broker_profile', [
                'page' => 1,
                'perPage' => 10,
            ]);
        }
        if ($request->headers->get('turbo-frame')) {
            list($brokerProfiles, $pagination) = $this->brokerProfileService->getAll($user, $page, $perPage);
            return $this->render('broker_profile/_table_frame.html.twig', [
                'brokerProfiles' => $brokerProfiles,
                'pagination' => $pagination
            ]);
        }

        return $this->render('broker_profile/index.html.twig', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }
    #[Route('/broker-profiles/create', name: 'app_broker_profile_create')]
    public function create(Request $request): Response
    {
        $user = $this->getAppUser();
        $brokerProfile = new CreateBrokerProfileDto();

        $form = $this->createForm(BrokerProfileFormType::class, $brokerProfile);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brokerProfile = $form->getData();
            $this->brokerProfileService->create($user, $brokerProfile);
            return $this->redirectToRoute('app_broker_profile');
        }

        return $this->render('broker_profile/create.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/broker-profiles/update/{id}', name: 'app_broker_profile_update')]
    public function update(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $brokerProfileDto = $this->brokerProfileService->getById($user, $id);
        $brokerProfile = new UpdateBrokerProfileDto();
        $brokerProfile->id = $brokerProfileDto->id;
        $brokerProfile->name = $brokerProfileDto->name;
        $brokerProfile->description = $brokerProfileDto->description;
        $brokerProfile->purchaseProfileDay = $brokerProfileDto->purchaseProfileDay;
        $brokerProfile->purchaseProfileWeek = $brokerProfileDto->purchaseProfileWeek;
        $brokerProfile->purchaseProfileMonth = $brokerProfileDto->purchaseProfileMonth;
        $brokerProfile->purchaseProfileYear = $brokerProfileDto->purchaseProfileYear;
        $brokerProfile->saleProfileDay = $brokerProfileDto->saleProfileDay;
        $brokerProfile->saleProfileWeek = $brokerProfileDto->saleProfileWeek;
        $brokerProfile->saleProfileMonth = $brokerProfileDto->saleProfileMonth;
        $brokerProfile->saleProfileYear = $brokerProfileDto->saleProfileYear;

        $form = $this->createForm(  BrokerProfileFormType::class, $brokerProfile, [
            'data_class' => UpdateBrokerProfileDto::class
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $house = $form->getData();
            $this->brokerProfileService->update($user, $house);
            return $this->redirectToRoute('app_broker_profile');
        }
        return $this->render('broker_profile/create.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/broker-profiles/switch/{id}', name: 'app_broker_profile_switch_profile', methods: ['POST'])]
    public function switchProfile(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
//        $houseId = $this->houseService->getCurrentId($user);
//        $this->performanceProfileService->switchProfile($user, $houseId, $id);
        return $this->redirectToRoute('app_broker_profile');
    }
    #[Route('/broker-profiles/delete/{id}', name: 'app_broker_profile_delete', methods: ['POST'])]
    public function delete(Request $request, int $id): Response
    {
        $user = $this->getAppUser();
        $this->brokerProfileService->delete($user, $id);
        return $this->redirectToRoute('app_broker_profile');
    }

}
