<?php

namespace App\Controller;

use App\Service\CurlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameUserController extends AbstractController
{
    #[Route('api/masters/', name: 'user_game_index')]
    public function index(Request $request): JsonResponse
    {
        $curl = new CurlService('https://explorer.lichess.ovh/masters');

        $curl->setOptions(
            headers: array(
                'Content-Type: application/json',
            ),
            params: array(
                'fen' => $request->query->get('root'),
                'play' => $request->query->get('moves'),
                'moves' => $request->query->get('branches'),
                'topGames' => $request->query->get('numberOfGames'),
            )
        );

        return $this->json($curl->execute());
    }
}
