<?php

namespace App\EventListener;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event):void
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }
        $user1 = $this->userRepository->findOneBy(['email' => $user->getUserIdentifier()]);
        $data['data'] = array(
            'id' => $user1->getId(),
            'fullname' => $user1->getNom().' '.$user1->getPrenom(),
            'name' => $user1->getNom(),
            'lastname' => $user1->getPrenom(),
            'birthdate' => $user1->getDateNaisString(),
            'address' => $user1->getAdresse(),
            'role'=> $user1->getRoles()[0],
            'nbrConj' => $user1->getNombreJrsConge(),
            'email' => $user1->getEmail(),
        );

        $event->setData($data);
    }

}