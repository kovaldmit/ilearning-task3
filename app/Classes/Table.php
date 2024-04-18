<?php

namespace App\Classes;

use LucidFrame\Console\ConsoleTable;

class Table
{
    /**
     * Show table with all possible moves.
     * @param $moves
     * @return void
     */
    public static function showAllResultTable($moves): void
    {
        $table = new ConsoleTable();
        $game = new Game($moves);

        $headers = ['v PC\\User >'];
        foreach ($moves as $move) {
            $headers[] = $move;
        }
        $table->setHeaders($headers);

        foreach ($moves as $userMove) {
            $row = [$userMove];
            foreach ($moves as $computerMove) {
                $userIndex = array_search($userMove, $moves);
                $computerIndex = array_search($computerMove, $moves);
                $result = $game->calculateRoundResult($userIndex, $computerIndex);
                $row[] = $result;
            }
            $table->addRow($row);
        }

        $table->display();
    }
}
