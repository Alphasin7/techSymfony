<?php

namespace App\Controller;

use App\Entity\Consommable;
use App\Form\ConsommableType;
use App\Repository\ConsommableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consommable')]
class ConsommableController extends AbstractController
{
    #[Route('/', name: 'app_consommable_index', methods: ['GET'])]
    public function index(ConsommableRepository $consommableRepository): Response
    {
        return $this->render('consommable/index.html.twig', [
            'consommables' => $consommableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_consommable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consommable = new Consommable();
        $form = $this->createForm(ConsommableType::class, $consommable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consommable);
            $entityManager->flush();

            return $this->redirectToRoute('app_consommable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consommable/new.html.twig', [
            'consommable' => $consommable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consommable_show', methods: ['GET'])]
    public function show(Consommable $consommable): Response
    {
        return $this->render('consommable/show.html.twig', [
            'consommable' => $consommable,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consommable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consommable $consommable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConsommableType::class, $consommable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_consommable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consommable/edit.html.twig', [
            'consommable' => $consommable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consommable_delete', methods: ['POST'])]
    public function delete(Request $request, Consommable $consommable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consommable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($consommable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_consommable_index', [], Response::HTTP_SEE_OTHER);
    }
}
