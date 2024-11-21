<?php

Class MatchFunctions{
    public $con;
    function __construct($con) {
        $this->con = $con;
    }

    public function UpdateMatch($matchKey, $userMoves, $opponentMoves, $playerScore, $opponentScore) {
        if (isset($matchKey) && is_array($userMoves) && is_array($opponentMoves) && is_numeric($playerScore) && is_numeric($opponentScore)) {
            $um = json_encode($userMoves);
            $om = json_encode($opponentMoves);

            $stmt = $this->con->prepare("UPDATE matches SET 
                    user_moves = ?, 
                    opponent_moves = ?, 
                    rounds = rounds + 1, 
                    user_score = ?, 
                    opponent_score = ? 
                WHERE match_key = ?;");

            $stmt->bind_param("ssiis", $um, $om, $playerScore, $opponentScore, $matchKey);
            $stmt->execute();
        }
    }

    public function GetMatchInfoFromKey($matchKey) {
        if (isset($matchKey)) {
            $stmt = $this->con->prepare("SELECT ID, user_id, user_moves, opponent, opponent_moves, rounds, user_score, opponent_score, cpu_level FROM matches WHERE match_key = ?;");
            $stmt->bind_param("s", $matchKey);
            $stmt->execute();
            $stmtResult = $stmt->get_result();

            $result = $stmtResult->fetch_assoc();
            $result["user_moves"] = json_decode($result["user_moves"], true);
            $result["opponent_moves"] = json_decode($result["opponent_moves"], true);
            return $result;
        }
    }

    public function CreateMatch($userId, $opponent, $cpuLvl, $key) {
        $allowedCpu = ["none", "easy", "normal", "hard"];
        if (is_numeric($userId) && in_array($cpuLvl, $allowedCpu)) {
            $stmt = $this->con->prepare("INSERT INTO matches (user_id, opponent, cpu_level, match_key) VALUES (?, ?, ?, ?);");
            $stmt->bind_param("iiss", $userId, $opponent, $cpuLvl, $key);
            $stmt->execute();
        }
    }

    function CreateGuid() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $guid = '';
    
        for ($i = 0; $i < 10; $i++) {
            $guid .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $guid;
    }
}

?>