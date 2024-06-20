<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Form\CongeType;
use App\Repository\CongeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conge')]
class CongeController extends AbstractController
{

    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'app_conge_index', methods: ['GET'])]
    public function index(CongeRepository $congeRepository): JsonResponse
    {
        $data = $congeRepository->findAll();
        $jsonData = $this->serialize($data);
        return new JsonResponse($jsonData);
    }
    #[Route('/only/{id}', name: 'app_conge_only', methods: ['GET'])]
    public function allById(CongeRepository $congeRepository,int $id): JsonResponse
    {

        try {
            $user = $this->userRepository->findOneBy(['id'=>$id]);
            $data = $user->getConges();
            $jsonData = $this->serialize($data);
        }catch (\Exception $e){
            return new JsonResponse(["error"=>$e->getMessage()]);
    }
        return new JsonResponse($jsonData);
    }
    private function serialize($conges): array
    {
        // Serialize users to an array or customize the serialization as needed
        $data = [];

        foreach ($conges as $conge) {
            $data[] = [
                'id'=>$conge->getId(),
                'fullname' => $conge->getFullname(),
                'reason' => $conge->getReason(),
                'department'=>$conge->getDepartment(),
                'sdate'=>$conge->getDateDebutCon(),
                'fdate'=>$conge->getDateFinCon(),
                'progress'=>$conge->getProgress()

            ];
        }
        return $data;
    }
    #[Route('/new', name: 'app_conge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(['id'=>$data['id']]);
        $conge = new Conge();
        $sdate = \DateTime::createFromFormat("Y-m-d", $data['sdate']);
        $fdate = \DateTime::createFromFormat("Y-m-d", $data['fdate']);
                $conge->setUser($user);
                $conge->setFullname($data['fullname']);
                $conge->setReason($data['reason']);
                $conge->setDepartment($data['department']);
                $conge->setDateDebutCon($sdate);
                $conge->setDateFinCon($fdate);
                $conge->setDureeConge(10);
                $conge->setProgress($data['progress']);
            $entityManager->persist($conge);
            $entityManager->flush();
        return new JsonResponse(['state'=>'S']);

        }



    #[Route('/{id}', name: 'app_conge_show', methods: ['GET'])]
    public function show(Conge $conge): Response
    {
        return $this->render('conge/show.html.twig', [
            'conge' => $conge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conge $conge, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $conge->setProgress($data['progress']);
        $entityManager->flush();
        return new JsonResponse(['message'=>'S']);

    }

    #[Route('/{id}', name: 'app_conge_delete', methods: ['POST'])]
    public function delete(Request $request, Conge $conge, EntityManagerInterface $entityManager): JsonResponse
    {

            $entityManager->remove($conge);
            $entityManager->flush();


        return new JsonResponse(['info'=>'D']);
    }
}
