<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConsumptionProfileController extends HecAbstractController
{
    #[Route('/consumption/profile', name: 'app_consumption_profile')]
    public function index(): Response
    {
        return $this->render('consumption_profile/index.html.twig', [
        ]);
    }
}
