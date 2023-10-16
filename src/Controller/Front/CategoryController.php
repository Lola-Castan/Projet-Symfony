<?php

namespace App\Controller\Front;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * Details page for a category
     *
     * @Route("/{id}", name="category_show", methods={"GET"})
     */
    public function show(int $id, CategoryRepository $categoryRepository, Category $category)
    {
        $category = $categoryRepository->find($id);

        $socks = $category->getSocks();

        if ($category === null) {
            throw $this->createNotFoundException('Category not found');
        }
        return $this->render('front/category/show.html.twig', [
            'category' => $category,
            'socks' => $socks
        ]);
    }
}
