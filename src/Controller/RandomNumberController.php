<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RandomNumberController extends AbstractController
{
    #[Route('/lucky/number')]
    public function index(): Response
    {
        $number = random_int(0, 100);

        return $this->render('/number.html.twig', [
            'number' => $number,
        ]);
    }
}
