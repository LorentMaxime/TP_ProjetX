<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
   * @Route("/admin")
   */
class BackController extends AbstractController
{

  /**
   * @Route("/personne/ajouter", name="personne_ajouter")
   */
public function ajouter(EntityManagerInterface $em, Request $request):Response
{
  $personne = new Personne(); // je crée une Entity "vide"
  // je crée mon formulaire (type de formulaire + entity)
  $formPersonne = $this->createForm(PersonneType::class, $personne);
// associer le formulaire avec les données envoyées
// hydrater $personne
  $formPersonne->handleRequest($request);

  if($formPersonne->isSubmitted() && $formPersonne->isValid())
  {
      $personne->setAge(666);
      $em->persist($personne);
      $em->flush();
      return $this->redirectToRoute('personne_liste');
  }


  return $this->render('back/ajouter.html.twig',
  [ 'formPersonne'=>$formPersonne->createView()]);


  /*
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
    //return $this->json($personne);
    return $this->redirectToRoute('home');
    */
}

/**
   * @Route("/personne/enlever/{id}", name="personne_enlever")
   */
public function effacer(Personne $personne, EntityManagerInterface $em):Response
{
    // pas besoin de persister
    $em->remove($personne);
    $em->flush();
    //return $this->json($personne);
    return $this->redirectToRoute('home');
}

/**
   * @Route("/", name="personne_liste")
   */
  public function liste(PersonneRepository $repo):Response
  {
      $personnes = $repo->findAll();
      return $this->render("back/liste.html.twig",['personnes'=>$personnes]);
  }

}
