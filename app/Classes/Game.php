<?php

namespace App\Classes;

class Game
{
    /**
     * @var array Game moves.
     */
    private array $moves;

    /**
     * @var HMAC HMAC class instance.
     */
    private HMAC $hmac;

    /**
     * @var int Computer move index.
     */
    public int $computerMoveIndex;

    /**
     * @var string Computer move;
     */
    public string $computerMove;

    /**
     * @var string HMAC computer move.
     */
    public string $computerMoveHmac;

    /**
     * @var string User move index.
     */
    public string $userMoveIndex;

    /**
     * @var string User move.
     */
    public string $userMove;

    /**
     * @param array $moves
     */
    public function __construct(array $moves)
    {
        $this->moves = $moves;
        $this->hmac = new HMAC();
    }

    /**
     * Execute computer move.
     * @return void
     */
    public function executeComputerMove(): void
    {
        $this->computerMoveIndex = array_rand($this->moves);
        $this->computerMove = $this->moves[$this->computerMoveIndex];
        $this->computerMoveHmac = $this->hmac->generate($this->computerMove);
        echo "HMAC of computer move: $this->computerMoveHmac\n";
    }

    /**
     * Execute user move.
     * @param $userMoveIndex
     * @return void
     */
    public function executeUserMove($userMoveIndex): void
    {
        $this->userMoveIndex = $userMoveIndex;
        $this->userMove = $this->moves[$this->userMoveIndex];
        echo "Your move: $this->userMove\n";
        echo "Computer move: $this->computerMove\n";
        $hmacKey = $this->hmac->getKey();
        echo "HMAC key: $hmacKey\n";
    }

    /**
     * Calculating game round result.
     * @param int $userMoveIndex
     * @param int $computerMoveIndex
     * @return string
     */
    public function calculateRoundResult(int $userMoveIndex = 0, int $computerMoveIndex = 0): string
    {
        $userMoveIndex = $userMoveIndex ?: $this->userMoveIndex;
        $computerMoveIndex = $computerMoveIndex ?: $this->computerMoveIndex;

        $n = count($this->moves);
        $p = intdiv($n, 2);

        $diff = ($computerMoveIndex - $userMoveIndex + $p + $n) % $n - $p;

        if ($diff === 0) {
            return 'Draw';
        } elseif ($diff > 0) {
            return 'Win';
        } else {
            return 'Lose';
        }
    }
}
