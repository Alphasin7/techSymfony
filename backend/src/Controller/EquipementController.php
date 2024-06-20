<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipement')]
class EquipementController extends AbstractController
{

    #[Route('/save', name: 'save', methods: ['POST'])]
    public function upload(Request $request): JsonResponse
    {

        $uploadedFile = $request->files->get('file');

        if ($uploadedFile) {
            // Move the uploaded file to the desired directory
            $uploadsDirectory = $this->getParameter('kernel.project_dir') . '/public/images';
            $uploadedFile->move($uploadsDirectory, $uploadedFile->getClientOriginalName());

            return new JsonResponse(["results"=>"S"]);
        }

        return new JsonResponse(["results"=>"F"]);
    }
    #[Route('/', name: 'app_equipement_index', methods: ['GET'])]
    public function index(EquipementRepository $equipementRepository): JsonResponse
    {
       $data =$equipementRepository->findAll();
       $jsonData = $this->serialize($data);
       return new JsonResponse($jsonData);
    }


    private function serialize($equips): array
    {
        // Serialize users to an array or customize the serialization as needed
        $data = [];

        foreach ($equips as $equip) {
            $data[] = [
                'id' => $equip->getId(),
                'label' => $equip->getLabel(),
                'image' =>[$equip->getImage()]
            ];
        }
        return $data;
    }

    #[Route('/new', name: 'app_equipement_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        try{
            $equipement = new Equipement();
            $data = json_decode($request->getContent(), true);
            $equipement->setLabel($data['label']);
            $equipement->setImage($data['image'][0]);
            $entityManager->persist($equipement);
            $entityManager->flush();
        }catch (\Exception $e){
            return new JsonResponse(['error'=>$e->getMessage()]);
        }


        return new JsonResponse(['id'=>$equipement->getId()]);
    }

    #[Route('/{id}', name: 'app_equipement_show', methods: ['GET'])]
    public function show(Equipement $equipement): Response
    {
        return $this->render('equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        try{
            $data = json_decode($request->getContent(), true);
            $equipement->setLabel($data['label']);
            $equipement->setImage($data['image'][0]);
            $entityManager->flush();
        }catch (\Exception $e){
            return new JsonResponse(['error'=>$e->getMessage()]);
        }
        return new JsonResponse(['message' => 'S']);
    }

    #[Route('/{id}', name: 'app_equipement_delete', methods: ['POST'])]
    public function delete(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {

            $entityManager->remove($equipement);
            $entityManager->flush();

        return new JsonResponse(['info'=>'D']);
    }



}
