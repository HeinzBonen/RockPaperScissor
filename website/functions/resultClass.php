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

    public function LogResults($playerId, $opponent, $result, $matchKey){
        try {
            // log in history
            $stmt = $this->con->prepare("INSERT INTO game_history 
                (user_id, end_state, play_date, opponent, match_key) 
                VALUES 
                (?, ?, NOW(), ?, ?);");
            $stmt->bind_param("isss", $playerId, $result, $opponent, $matchKey);
            $stmt->execute();
            // log in statistics
            switch($result) {
                case "won": // result is a win
                    $stmt = $this->con->prepare("UPDATE users SET total_ties = total_wins + 1 WHERE ID = ?;");
                    break;
                case "lost": // result is a loss
                    $stmt = $this->con->prepare("UPDATE users SET total_ties = total_losses + 1 WHERE ID = ?;");
                    break;
                default: // result is a tie
                    $stmt = $this->con->prepare("UPDATE users SET total_ties = total_ties + 1 WHERE ID = ?;");
                    break;
            }
            $stmt->bind_param("i", $playerId);
            $stmt->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetHistoryFromId($userId) {
        if (isset($userId) && is_numeric($userId)) {
            $stmt = $this->con->prepare("SELECT 
                match_key, end_state, play_date, opponent
            FROM game_history WHERE user_id = ?;");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmtResult = $stmt->get_result();

            $results = [];

            while($row = $stmtResult->fetch_assoc()) {
                $results[] = $row;
            }

            return $results;
        }
    }
}