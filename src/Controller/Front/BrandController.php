<?php

namespace App\Controller\Front;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/brand")
 */
class BrandController extends AbstractController
{
    /**
     * Index page for brands
     *
     * @Route("/", name="brand_index", methods={"GET"})
     */
    public function index(BrandRepository $brandRepository): Response
    {
        $brands = $brandRepository->findAll();

        return $this->render('front/brand/index.html.twig', [
            'brands' => $brands
        ]);
    }

    /**
     * Details page for a brand
     *
     * @Route("/{id}", name="brand_show", methods={"GET"})
     */
    public function show(int $id, BrandRepository $brandRepository, Brand $brand)
    {
        $brand = $brandRepository->find($id);

        $socks = $brand->getSocks();

        if ($brand === null) {
            throw $this->createNotFoundException('Brand not found');
        }
        return $this->render('front/brand/show.html.twig', [
            'brand' => $brand,
            'socks' => $socks
        ]);
    }
}
