<?php

namespace App\Classes;

class Menu
{
    /**
     * Show available moves in console.
     * @param $moves
     * @return void
     */
    public static function showAvailableMoves($moves): void
    {
        echo "Available moves:\n";
        foreach ($moves as $key => $value) {
            echo "$key - $value\n";
        }
        echo "0 - exit\n? - help\n";
    }
}
