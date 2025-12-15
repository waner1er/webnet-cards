<?php

declare(strict_types=1);

namespace App\Controller;

use App\Game\GameManager;
use App\Game\Deck;
use App\Game\Service\Sorter;
use App\Game\Service\RandomOrderGenerator;
use App\Game\Exception\InvalidCardCountException;
use App\Game\Exception\NotEnoughCardsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    #[Route('/', name: 'card_game')]
    public function index(Request $request): Response
    {
        if (!$request->isMethod('POST')) {
            return $this->renderGamePage();
        }

        $cardCount = (int) $request->request->get('card_count');

        try {
            $result = $this->playGame($cardCount);
            return $this->renderGamePage(result: $result);
        } catch (InvalidCardCountException $e) {
            return $this->renderGamePage(error: $e->getMessage());
        } catch (NotEnoughCardsException $e) {
            return $this->renderGamePage(error: $e->getMessage());
        }
    }

    private function renderGamePage(?array $result = null, ?string $error = null): Response
    {
        return $this->render('game/index.html.twig', [
            'result' => $result,
            'error' => $error,
        ]);
    }

    private function playGame(int $cardCount): array
    {
        $gameManager = $this->createGameManager();

        $result = $gameManager->drawHand($cardCount);
        $result['remaining_cards'] = $gameManager->getDeckCount();

        return $result;
    }

    private function createGameManager(): GameManager
    {
        return new GameManager(
            new Deck(),
            new Sorter(),
            new RandomOrderGenerator()
        );
    }
}
