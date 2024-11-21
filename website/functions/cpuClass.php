<?php

Class CpuFunctions{

    // will make a choice based on a pattern
    public function MakeChoiceEasy($prevChoice){
        $result = null;
        switch($prevChoice) {
            case "scissor":
                $result = "rock";
                break;
            case "rock":
                $result = "paper";
                break;
            case "paper":
                $result = "scissor";
                break;
            default:
                $result = "scissor";
                break;
        }
        return $result;
    }

    // will make a completely arbitrary choice
    public function MakeChoiceNormal(){
        $cpuChoiceNr = random_int(0, 2);
        $result = null;
        switch($cpuChoiceNr) {
            case 0:
                $result = "rock";
                break;
            case 1:
                $result = "paper";
                break;
            case 2:
                $result = "scissor";
                break;
            default:
                $result = "scissor";
                break;
        }
        return $result;
    }

    // will calculate based on the players previous choices
    public function MakeChoiceHard($prevChoices){
        // Define the counters to each choice
        $counters = [
            'rock' => 'paper',
            'paper' => 'scissor',
            'scissor' => 'rock'
        ];

        // If there are no previous choices, pick randomly
        if (empty($prevChoices) || !isset($prevChoices)) {
            return $this->MakeChoiceNormal();
        }

        // Count the occurrences of each choice
        $choiceCounts = array_count_values($prevChoices);

        // Find the player's most common choice
        $mostCommonChoice = array_keys($choiceCounts, max($choiceCounts))[0];

        // Return the counter to the most common choice
        return $counters[$mostCommonChoice];
    }

}

?>