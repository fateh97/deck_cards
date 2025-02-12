<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // handle form submission

    $player = $_POST['players'];

    if ($player < 1) { // validate the input number of players
        echo "<p>Please enter a valid number of players.</p>";
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

        foreach ($decks as $deck) {
            for ($value = 1; $value <= 13; $value++) {
                $cards[] = $cardValues[$value] . "-" . $deck;
            }
        }

        shuffle($cards); // shuffle the decks

        $cardsPerPlayer = floor(count($cards) / $player); // round the number so that the card is distributed evenly

        $players = [];

        for ($i = 0; $i < $player; $i++) {
            $players[$i] = array_splice($cards, 0, $cardsPerPlayer);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Deck of Cards</h1>
    <div class="form-container">
        <form method="POST">
            <label for="numberOfPlayers">Enter number of players:</label>
            <input type="number" name="players" required>
            <button type="submit">Shuffle</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($players)) { // display the decks after submission

        foreach ($players as $index => $playerCards) {
            echo "<div><h3>Player " . ($index + 1) . ":</h3>";

            echo implode(', ', $playerCards); // cards being separated by commas

            echo "</div>";
        }
    }
    ?>

</body>

</html>