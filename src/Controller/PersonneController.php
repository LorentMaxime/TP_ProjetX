<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
   * @Route("/personne")
   */
class PersonneController extends AbstractController
{

  /**
   * @Route("/ajouter", name="pesonne_ajouter")
   */
public function ajouter(EntityManagerInterface $em):Response
{
    // dd = dump die
    // dunmp() // le var_dump de symfony
      //dd('Ajouter personne !');

      $personne = new Personne();
    // On hydrate !!!  
    $personne->setPrenom('Jean');
    $personne->setNom('DUJARDIN');
    // persister
    $em->persist($personne);

    // flush
    $em->flush();
    return $this->json($personne);
}

/**
   * @Route("/enlever/{id}", name="pesonne_ajouter")
   */
public function effacer(Personne $personne, EntityManagerInterface $em):Response
{
    // pas besoin de persister
    $em->remove($personne);
    $em->flush();
    return $this->json($personne);
}

}
