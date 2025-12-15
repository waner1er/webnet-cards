<?php

declare(strict_types=1);

namespace App\Controller;

use App\Game\GameManager;
use App\Game\Deck;
use App\Game\Service\Sorter;
use App\Game\Service\RandomOrderGenerator;
use App\Game\Exception\InvalidCardCountException;
use App\Game\Exception\NotEnoughCardsException;
use App\Game\Enum\Suit;
use App\Game\Enum\CardValue;
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
        $useCustomRules = (bool) $request->request->get('use_custom_rules');

        try {
            $customSuits = null;
            $customValues = null;

            if ($useCustomRules) {
                $customSuits = $this->parseCustomOrder($request->request->all('suit_order'), Suit::class);
                $customValues = $this->parseCustomOrder($request->request->all('value_order'), CardValue::class);
            }

            $result = $this->playGame($cardCount, $customSuits, $customValues);
            $result['is_custom'] = $useCustomRules;

            return $this->renderGamePage(result: $result);
        } catch (InvalidCardCountException | NotEnoughCardsException $e) {
            return $this->renderGamePage(error: $e->getMessage());
        }
    }

    private function renderGamePage(?array $result = null, ?string $error = null): Response
    {
        return $this->render('game/index.html.twig', [
            'result' => $result,
            'error' => $error,
            'suits' => Suit::cases(),
            'values' => CardValue::cases(),
        ]);
    }

    private function playGame(int $cardCount, ?array $customSuits = null, ?array $customValues = null): array
    {
        $gameManager = $this->createGameManager();

        $result = $gameManager->drawHand($cardCount, $customSuits, $customValues);
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

    private function parseCustomOrder(array $orderArray, string $enumClass): array
    {
        $result = [];

        foreach ($orderArray as $value) {
            if (empty($value)) {
                continue;
            }

            foreach ($enumClass::cases() as $case) {
                if ($case->value === $value) {
                    $result[] = $case;
                    break;
                }
            }
        }

        return $result;
    }
}
