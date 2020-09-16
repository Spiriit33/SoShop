<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("api/users/")
     */
    public function getUsers(Request $request)
    {
        $email = $request->get('email');
        $refCompte = $request->get('comptes_reference');
        $refCarte = $request->get('comptes_carte_reference_carte');
        $user = !is_null($email) ? $this->userRepository->findByEmail($email) : (!is_null($refCompte) ? $this->userRepository->findByReferenceCompte($refCompte) :
            (!is_null($refCarte) ? $this->userRepository->findByReferenceCarte($refCarte) : null));

        $response = new \Symfony\Component\HttpFoundation\Response($user);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
