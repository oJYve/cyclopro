<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reparation;
use App\Form\ReparationType;
use App\Repository\ReparationRepository;

final class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/accueil.html.twig', []);
    }

    #[Route('/reparation', name: 'app_reparation')]
    public function add_reparation(Request $request, EntityManagerInterface $em): Response
    {
        $reparation = new Reparation();
        $form = $this->createForm(ReparationType::class, $reparation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reparation);
            $em->flush();
            $this->addFlash('success', 'Votre demande de réparation à bien été prise en compte !');
            return $this->redirectToRoute('app_reparation');
        }
        return $this->render('base/ajoutReparation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/liste-reparation', name: 'app_liste_reparation')]
    public function liste_reparation(ReparationRepository $reparationRepository): Response
    {
        $reparations = $reparationRepository->findAll();
        return $this->render('base/listeReparation.html.twig', [
            'reparations' => $reparations,
        ]);
    }
}
