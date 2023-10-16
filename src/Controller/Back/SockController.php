<?php

namespace App\Controller\Back;

use App\Entity\Sock;
use App\Form\SockType;
use App\Repository\SockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/sock")
 */
class SockController extends AbstractController
{
    /**
     * @Route("/", name="app_sock_index", methods={"GET"})
     */
    public function index(SockRepository $sockRepository): Response
    {
        return $this->render('back/sock/index.html.twig', [
            'socks' => $sockRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_sock_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em ): Response
    {
        $sock = new Sock();
        $form = $this->createForm(SockType::class, $sock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sock);
            $em->flush();

            $this->addFlash('success', 'Sock added');

            return $this->redirectToRoute('app_sock_index');
        }

        return $this->renderForm('back/sock/new.html.twig', [
            'sock' => $sock,
            'form' => $form,
        ]);
        
    }

    /**
     * @Route("/{id}", name="app_sock_show", methods={"GET"})
     */
    public function show(Sock $sock): Response
    {
        return $this->render('back/sock/show.html.twig', [
            'sock' => $sock,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_sock_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sock $sock, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SockType::class, $sock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sock);
            $em->flush();

            $this->addFlash('success', 'Sock edited');

            return $this->redirectToRoute('app_sock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/sock/edit.html.twig', [
            'sock' => $sock,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_sock_delete", methods={"POST"})
     */
    public function delete(Request $request, Sock $sock, SockRepository $sockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete-sock-'.$sock->getId(), $request->request->get('_token'))) {
            $sockRepository->remove($sock, true);
        }

        return $this->redirectToRoute('app_sock_index', [], Response::HTTP_SEE_OTHER);
    }
}
