<?php

declare(strict_types=1);

namespace App\Command;

use App\Game\Deck;
use App\Game\GameManager;
use App\Game\Service\Sorter;
use App\Game\Service\RandomOrderGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(
    name: 'game:test',
    description: 'Teste le jeu de cartes en console',
)]
class GameTestCommand extends Command
{
    protected function configure(): void
    {
        $this->addArgument('cards', InputArgument::OPTIONAL, 'Nombre de cartes à tirer', 10);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $cardCount = (int) $input->getArgument('cards');

        $deck = new Deck();
        $sorter = new Sorter();
        $orderGenerator = new RandomOrderGenerator();
        $gameManager = new GameManager($deck, $sorter, $orderGenerator);

        $result = $gameManager->drawHand($cardCount);

        $io->title('Test du jeu de cartes');

        $io->section('Ordre aléatoire des couleurs');
        $io->listing(array_map(fn($s) => $s->label(), $result['suits_order']));

        $io->section('Ordre aléatoire des valeurs');
        $io->listing(array_map(fn($v) => $v->label(), $result['values_order']));

        $io->section('Main non triée');
        $io->listing(array_map(fn($c) => (string) $c, $result['non_sorted']));

        $io->section('Main triée');
        $io->listing(array_map(fn($c) => (string) $c, $result['sorted']));

        $io->success("Cartes restantes dans le paquet : {$gameManager->getDeckCount()}");

        return Command::SUCCESS;
    }
}
