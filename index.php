<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\Console;
use App\Classes\Game;
use App\Classes\HMAC;
use App\Classes\Menu;
use App\Classes\Table;

$moves = $argv;
// Removing an array element with a file name.
unset($moves[0]);

if (count($moves) < 3) {
    echo "The number of arguments must be more than two.\n";
    exit(1);
}

if (count($moves) % 2 == 0) {
    echo "The number of arguments must be odd.\n";
    exit(1);
}

if (count($moves) !== count(array_unique($moves))) {
    echo "The given arguments are repeated.\n";
    exit(1);
}

$game = new Game($moves);
$hmac = new HMAC();

$game->executeComputerMove();

Menu::showAvailableMoves($moves);

$validator = function ($input) {
    global $moves;
    return $input == 0 || $input == '?' || isset($moves[$input]);
};
$userMoveIndex = Console::requestValidInput("Enter your move: ", $validator);
if (array_key_exists($userMoveIndex, $moves)) {
    $game->executeUserMove($userMoveIndex);

    $moveResult = $game->calculateRoundResult();
    echo "Result: $moveResult";
} else {
    switch ($userMoveIndex) {
        case 0:
            echo "Bye.\n";
            exit();
        case '?':
            Table::showAllResultTable($moves);
    }
}
