<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deck of Cards</title>
</head>

<body>
    <h1>Enter Number of Players</h1>
    <form action="shuffle.php" method="POST">
        <label for="players">Number of Players:</label>
        <input type="number" name="players" id="players" required min="1">
        <button type="submit">Start Game</button>
    </form>

    <?php
    if (isset($_GET['result'])) {
        $players = json_decode($_GET['result'], true);
        echo "<h2>Deck Distributed:</h2>";
        foreach ($players as $index => $playerCards) {
            echo "<div><h3>Player " . ($index + 1) . ":</h3>";
            echo implode(', ', $playerCards);
            echo "</div>";
        }
    }
    ?>
</body>

</html>