<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $product->setName('Mouse');
        $product->setPrice(999);
        $product->setDescription('Lightweight and easy');
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Saved new product '.$product->getId());
    }

    #[Route('/product/{id}', name: 'product_show')]
    public function show(Product $product): JsonResponse
    {

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id'
            );
        }

        return $this->render('/product/single.html.twig', [
            'name' => $product->getName(),
        ]);
    }

    #[Route('api/products', name: 'products_index')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {

        $products = $entityManager->getRepository(Product::class)->findAll();
        return $this->json($products);
    }

    #[Route('api/products/{id}', name: 'product_api_show')]
    public function single(Product $product): JsonResponse
    {

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id'
            );
        }

        return $this->json($product);
    }
}
