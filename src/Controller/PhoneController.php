<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PhoneRepository;

use App\Entity\Phone;
use App\Form\PhoneType;

class PhoneController extends AbstractController
{
  private $phoneRepo;

    public function __construct(PhoneRepository $phoneRepo)
    {
      $this->phoneRepo = $phoneRepo;
    }
    /**
     * @Route("/", name="phone")
     */
    public function index(): Response
    {
      $phones = $this->phoneRepo->findAll();
        return $this->render('phone/index.html.twig', [
            'phones' => $phones,
        ]);
    }

    /**
     * @Route("/phone/add", name="phone_add")
     * @Route("/phone/{id}/update", name="phone_update")
     */
    public function create($id=0 ,Request $req): Response
    {
      $phone = $this->phoneRepo->find($id);
      $modif = true;
      if (!isset($phone)) {
        $phone = new Phone();
        $modif = false;
      }
      //metre en place le formulaire
      $form = $this->createForm(PhoneType::class, $phone);
      $form->handleRequest($req);
      if ($form->isSubmitted() && $form->isValid()) {
        $this->phoneRepo->create($phone);
        return $this->redirectToRoute('phone');
      }
        return $this->render('phone/create.html.twig', [
            'form' => $form->createView(),
            'modif' => $modif
        ]);
    }

    /**
     * @Route("/phone/{id}/show", name="phone_show")
     */
    public function show($id): Response
    {
      $phone = $this->phoneRepo->find($id);
      if (!isset($phone)) {
        return $this->redirectToRoute('phone');
      }
        return $this->render('phone/show.html.twig', [
            'phone' => $phone,
        ]);
    }

    /**
     * @Route("/phone/{id}/delete", name="phone_delete")
     */
    public function delete($id): Response
    {
      $phone = $this->phoneRepo->find($id);
      if (!isset($phone)) {
       return  $this->redirectToRoute('phone');
      }
      $this->phoneRepo->delete($phone);
       return  $this->redirectToRoute('phone');
    }

}
