<?php

require 'vendor/autoload.php';

use RandomQuotes\RandomQuotes;

$rq = new RandomQuotes();
$quoteArray = $rq->generate();

$fullQuote = $quoteArray['quoteAuthor'] . " said \"" . $quoteArray['quoteText'] . "\"";

echo "<h2>Quotionary!</h2>"; 
echo "$fullQuote";

?>
