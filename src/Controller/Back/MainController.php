<?php

namespace App\Controller\Back;

use App\Repository\SockRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/index", name="bo_index")
     */
    public function index(SockRepository $sockRepository, BrandRepository $brandRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('back/main/index.html.twig', [
            'socks' => $sockRepository->findAll(),
            'brands' => $brandRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
