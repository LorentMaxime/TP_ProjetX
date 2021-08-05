<?php

namespace App\Controller;

use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

   /**
    * @Route("/", name="home")
    */
    public function home(PersonneRepository $repo):Response
    {
        $personnes = $repo->findAll(); 
        return $this->render("personne/home.html.twig",['personnes'=>$personnes]);
    } 

      /**
    * @Route("/contact", name="contact")
    */
    public function contact():Response
    {
        //$route = new Route()
        return $this->render("personne/contact.html.twig");
    } 

      /**
    * @Route("/about-us", name="about")
    */
    public function about():Response
    {
        //$route = new Route()
        return $this->render("personne/about.html.twig");
    } 


}
