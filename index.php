<?php

require 'vendor/autoload.php';

use RandomQuotes\RandomQuotes;

$conn = mysqli_connect("mysql","root","root","quotes");
if(!$conn){
    die("Connection failed". mysqli_connect_error());
}

$rq = new RandomQuotes();
$quoteArray = $rq->generate();

$fullQuote = $quoteArray['quoteAuthor'] . " said \"" . $quoteArray['quoteText'] . "\"";

$tableCreate = "CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote TEXT NOT NULL
)";

mysqli_query($conn, $tableCreate);

$quoteInsert = "INSERT INTO quotes (quote) VALUES ('{$fullQuote}')"; 

mysqli_query($conn, $quoteInsert);

$quotesQuery = "SELECT * FROM quotes";
$result = mysqli_query($conn, $quotesQuery);

echo "<h2>Quotionary!</h2>"; 

echo "<ul>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row['quote'] . "</li>";
}
echo "</ul>";

mysqli_close($conn);

?>
