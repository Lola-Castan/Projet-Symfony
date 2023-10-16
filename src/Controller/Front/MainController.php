<?php

namespace App\Controller\Front;

use App\Entity\Category;
use App\Repository\SockRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(SockRepository $sockRepository, CategoryRepository $categoryRepository)
    {
        $socks = $sockRepository->findOrderedByTitle(5);

        $categories = $categoryRepository->findAll();

        return $this->render('front/main/home.html.twig', [
            'socks' => $socks,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(UserRepository $userRepository)
    {
        return $this->render('front/main/profile.html.twig');
    }
}
