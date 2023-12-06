<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Saved new product '.$product->getId());
    }

    #[Route('/product/{id}', name: 'product_show')]
    public function show(Product $product): Response
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
}
