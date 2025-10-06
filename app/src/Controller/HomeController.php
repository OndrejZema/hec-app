<?php

namespace App\Controller;

use App\Form\TestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request,): Response
    {
        $testForm = $this->createForm(TestFormType::class, ['chartData' => [100, 200, 300]]);
        $testForm->handleRequest($request);

        dd($testForm);
        if ($testForm->isSubmitted() && $testForm->isValid()) {
            dd($testForm);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'testForm' => $testForm
        ]);
    }
}
