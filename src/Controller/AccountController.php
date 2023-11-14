<?php

namespace App\Controller;

use App\Form\ChangerPasswordType;
use App\Form\ModificationFormType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
#[Route('/account')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'app_account', methods: ['GET', 'POST'])]
    public function index(UserRepository $repository, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $id = $this->getUser()->getId();

        $user = $repository->find($id);
        $form = $this->createForm(ModificationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Votre modification a ete effectuer avec sucess');
            return $this->redirectToRoute('app_account');
        }



        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController', 'form' => $form->createView()

        ]);
    }


    /*  #[Route('/updateclient/{id}', name: 'clientupdate',methods: ['GET','POST'])]
      public function update($id, UserRepository $repository, Request $request): Response
      {
          $user = $repository->find($id);
          $form = $this->createForm(RegistrationFormType::class, $user);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {

              $em = $this->getDoctrine()->getManager();
              $em->flush();
              $this->addFlash('success', 'Votre modification a ete effectuer avec sucess');
              return $this->redirectToRoute('account');
          }
          return $this->render('account/updateClient.html.twig', [
              'form' => $form->createView()
          ]);
      }
  */

    #[Route('/reset', name: 'passwordReset', methods: ['GET', 'POST'])]
    public function editAction(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ChangerPasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $request->request->get('changer_password')['oldPassword'];
            // Si l'ancien mot de passe est bon
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $form->get('plainPassword')->getData()
                );
                $user->setPassword($newEncodedPassword);
                $em->persist($user);
                $em->flush();
                $this->addFlash('success', 'Votre mot de passe à bien été changé !');
                return $this->redirectToRoute('app_account');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }
        return $this->render('account/passwordChange.html.twig', array(
            'form' => $form->createView(),
        ));


    }
}