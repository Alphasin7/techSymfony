<?php

namespace App\Controller;
use App\Entity\Conge;
use App\Entity\Equipement;
use App\Entity\Reclamation;
use App\Repository\EquipementRepository;
use PHPUnit\Util\Json;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{




    #[Route('/dash', name: 'app_user_dash', methods: ['GET'])]
    public function dashBoard(EntityManagerInterface $entityManager):JsonResponse
    {
        $equip = $entityManager->createQuery(
            'SELECT COUNT(e.id) FROM ' . Equipement::class . ' e'
        );
        $equipCount = $equip->getSingleScalarResult();

        $conge = $entityManager->createQuery(
            "SELECT COUNT(e.id) FROM ". Conge::class ." e WHERE UPPER(e.progress)='Y' "
        );
        $congeCount = $conge->getSingleScalarResult();

        $rec = $entityManager->createQuery(
            "SELECT COUNT(e.id) FROM ". Reclamation::class ." e WHERE UPPER(e.progress)='Y' "
        );
        $recCount = $rec->getSingleScalarResult();
        $user = $entityManager->createQuery(
            'SELECT COUNT(e.id) FROM ' . User::class . ' e'
        );
        $userCount = $user->getSingleScalarResult();

        return new JsonResponse(["equip"=>$equipCount,"conge"=>$congeCount,"rec"=>$recCount,"user"=>$userCount]) ;

    }
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository)
    {
        $data = $userRepository->findAll();
        $serializedUsers = $this->serializeUsers($data);
        return new JsonResponse($serializedUsers) ;

    }
    private function serializeUsers($users): array
    {
        // Serialize users to an array or customize the serialization as needed
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'fullname' => $user->getNom().' '.$user->getPrenom(),
                'name' => $user->getNom(),
                'lastname' => $user->getPrenom(),
                'birthdate' => $user->getDateNaisString(),
                'address' => $user->getAdresse(),
                'role'=> $user->getRoles()[0],
                'nbrConj' => $user->getNombreJrsConge(),
                'email' => $user->getEmail(),
            ];
        }
        return $data;
    }

    /**
     * @throws \Exception
     */
    #[Route('/new', name: 'app_user_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher): JsonResponse
    {
        $user = new User();
        $data = json_decode($request->getContent(), true);
        $user->setNom($data['firstname']);
        $user->setPrenom($data['lastname']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $date = \DateTime::createFromFormat("Y-m-d", $data['birthdate']);
        $user->setDateNais($date);
        $user->setRoles([$data['role']]);
        $user->setAdresse($data['address']);
        $user->setNombreJrsConge(15);
        $user->setIsVerified(true);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
               $data['password']
            )
        );
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['status'=>"ok"]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager):JsonResponse
    {
        // Update user data based on the request data
        $data = json_decode($request->getContent(), true);
try{

    $user->setNom($data["name"]);
    $user->setPrenom($data["lastname"]);
    $user->setEmail($data['email']);
    $date = \DateTime::createFromFormat("Y-m-d", $data['birthdate']);
    $user->setDateNais($date);
    $user->setAdresse($data["address"]);
    $user->setRoles([$data["role"]]);

    $entityManager->flush();
}catch (\Exception $e){
    return new JsonResponse(['error' => $e->getMessage()]);
}

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'S']);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): JsonResponse
    {

            $entityManager->remove($user);
            $entityManager->flush();


        return new JsonResponse(['info'=>'D']);
    }
}
