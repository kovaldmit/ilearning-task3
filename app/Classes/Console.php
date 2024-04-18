<?php

namespace App\Classes;

class Console
{
    /**
     * Create request for valid console input.
     * @param $prompt
     * @param $validator
     * @return string
     */
    public static function requestValidInput($prompt, $validator): string
    {
        while (true) {
            echo $prompt;
            $input = fgets(STDIN);
            $input = trim($input);

            if ($validator($input)) {
                return $input;
            } else {
                echo "Wrong. Please try again.\n";
            }
        }
    }
}
