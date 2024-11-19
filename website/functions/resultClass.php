<?php

Class ResultFunctions{
    public $con;
    function __construct($con) {
        $this->con = $con;
    }

    public function DeclareWinnerFromAnswers($playerOneAns, $playerTwoAns){
        $counters = [
            'rock' => 'paper',
            'paper' => 'scissor',
            'scissor' => 'rock'
        ];

        if ($playerOneAns != $playerTwoAns) {
            // if player 1's answer is equal to the counter of player 2's answer
            $winner = $playerOneAns == $counters[$playerTwoAns] ? 1 : 2;
            return $winner;
        } else {
            return 0;
        }
    }
}