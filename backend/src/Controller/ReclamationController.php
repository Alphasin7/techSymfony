<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): JsonResponse
    {
        $data = $reclamationRepository->findAll();
        $jsonData = $this->serialize($data);
        return new JsonResponse($jsonData);
    }

    #[Route('/only/{id}', name: 'app_req_only', methods: ['GET'])]
    public function allById(ReclamationRepository $reclamationRepository,int $id): JsonResponse
    {

        try {
            $user = $this->userRepository->findOneBy(['id'=>$id]);
            $data = $user->getReclamations();
            $jsonData = $this->serialize($data);
        }catch (\Exception $e){
            return new JsonResponse(["error"=>$e->getMessage()]);
        }
        return new JsonResponse($jsonData);
    }
    private function serialize($datas): array
    {
        // Serialize users to an array or customize the serialization as needed
        $data = [];

        foreach ($datas as $item) {
            $data[] = [
                'id'=>$item->getId(),
                'fullname' => $item->getFullname(),
                'position' => $item->getPosition(),
                'department'=>$item->getDepartment(),
                'progress'=>$item->getProgress(),
                'description'=>$item->getContenu(),
                'answer'=>$item->getAnswer(),
                'problem'=>$item->getProblem()

            ];
        }
        return $data;
    }
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $reclamation = new Reclamation();
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(['id'=>$data['id']]);
        $reclamation->setUser($user);
        $reclamation->setAnswer($data['answer']);
        $reclamation->setDepartment($data['department']);
        $reclamation->setFullname($data['fullname']);
        $reclamation->setProgress('Y');
        $reclamation->setPosition($data['position']);
        $reclamation->setContenu($data['description']);
        $reclamation->setProblem($data['problem']);
        $reclamation->setDate(new DateTime());

            $entityManager->persist($reclamation);
            $entityManager->flush();

        return new JsonResponse(['state'=>'S']);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $reclamation->setAnswer($data['answer']);
        $reclamation->setProgress($data['progress']);
            $entityManager->flush();

        return new JsonResponse(['message'=>'S']);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): JsonResponse
    {

            $entityManager->remove($reclamation);
            $entityManager->flush();


        return new JsonResponse(['info'=>'D']);
    }
}
