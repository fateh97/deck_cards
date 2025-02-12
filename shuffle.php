<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // handle form submission

    $player = $_POST['players'];

    if ($player < 1) { // validate the input number of players
        echo "<p>Please enter a valid number of players.</p>";
        exit;
    } else {

        $decks = ['S', 'H', 'D', 'C']; // assign the decks (S = Spade, H = Heart, D = Diamond, C = Cloud)
        $cards = []; // create an empty array

        $cardValues = [
            1 => 'A',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => 'X',
            11 => 'J',
            12 => 'Q',
            13 => 'K'
        ];

        // Generate deck of cards
        foreach ($decks as $deck) {
            for ($value = 1; $value <= 13; $value++) {
                $cards[] = $cardValues[$value] . "-" . $deck;
            }
        }

        shuffle($cards); // shuffle the decks

        $cardsPerPlayer = floor(count($cards) / $player); // round the number so that the card is distributed evenly

        $players = [];

        // Distribute cards to players
        for ($i = 0; $i < $player; $i++) {
            $players[$i] = array_splice($cards, 0, $cardsPerPlayer);
        }

        // Return the result as a JSON string to index.php
        $result = urlencode(json_encode($players));
        header("Location: index.php?result=$result");
        exit;
    }
}
