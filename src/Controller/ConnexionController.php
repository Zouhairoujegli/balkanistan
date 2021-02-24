<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/login",name="connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $errors = $authenticationUtils->getLastAuthenticationError();
        return $this->render('affaire/connexion.html.twig',[
            'last_username' => $lastUsername,
            'error' => $errors,
        ]);
    }    
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        $this->container->get('security.context')->setToken(null);

     }
}