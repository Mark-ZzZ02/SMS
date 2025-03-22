<?php

require "vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$apiKey = "AIzaSyDLayjpQvPwYO93yHNQSYGoqYlgASoAgBk";
$client = new Client($apiKey);

$text = "Generate a case report for a student with the following details: Student ID: 12345, Name: John Doe, Program: Computer Science, Offense: Plagiarism";

try {
    $response = $client->geminiPro()->generateContent(new TextPart($text));
    echo "Response: " . $response->text();
} catch (Exception $e) {
    echo "Error with Gemini API request: " . $e->getMessage();
}
?>
