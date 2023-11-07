<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Entity\Taches;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugger;
use App\Repository\TachesRepository;

#[Route('/projets')]
class ProjetsController extends AbstractController
{
    #[Route('/', name: 'app_projets_index', methods: ['GET'])]
    public function index(ProjetsRepository $projetsRepository): Response
    {
        return $this->render('projets/index.html.twig', [
            'projets' => $projetsRepository->findAll(),
        ]);
    }

    #[Route('/choixprojet', name: 'app_projets_choix', methods: ['GET'])]
    public function ChoixProjet(ProjetsRepository $projetsRepository): Response
    {
        return $this->render('projets/selectprojet.html.twig', [
            'projets' => $projetsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_projets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = new Slugger();
            $projet->setSlug($slug->slugify($projet->getNomProjet()));
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_projets_kanban', methods: ['GET'])]
    public function kanban(Projets $projet, TachesRepository $tacherepository): Response
    {
        return $this->render('projets/kanban.html.twig', [
            'projet' => $projet,
            'taches' =>$tacherepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_projets_show', methods: ['GET'])]
    public function show(Projets $projet): Response
    {
        return $this->render('projets/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projets $projet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projets/edit.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projets_delete', methods: ['POST'])]
    public function delete(Request $request, Projets $projet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
    }
}
