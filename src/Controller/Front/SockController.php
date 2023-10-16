<?php

namespace App\Controller\Front;

use App\Repository\SockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/socks", name="socks_")
 */
class SockController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(SockRepository $sockRepository)
    {
        $socks = $sockRepository->findAll();

        return $this->render('front/sock/list.html.twig', [
            'socks' => $socks
        ]);
    }

    /**
     * Details page for socks
     *
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, SockRepository $sockRepository)
    {
        $sock = $sockRepository->findWithAssociatedData($id);

        if ($sock === null) {
            throw $this->createNotFoundException('Sock not found');
        }
        return $this->render('front/sock/show.html.twig', [
            'sock' => $sock
        ]);
    }
}
