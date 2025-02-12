<?php
namespace App\Controller;

use App\Form\Model\SearchPointsModel;
use App\Form\SearchPointsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SearchPointsController extends AbstractController
{
    #[Route('/', name: 'app_search_points')]
    public function index(Request $request): Response
    {
        $searchPoints = new SearchPointsModel();
        $form = $this->createForm(SearchPointsType::class, $searchPoints);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // TODO
        }

        return $this->render('search_points.html.twig', [
            'form' => $form,
        ]);
    }
}