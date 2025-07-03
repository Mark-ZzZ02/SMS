<?php
require '../vendor/autoload.php';  // Load Gemini SDK

use GeminiAPI\Client;
use GeminiAPI\Requests\GenerateContentRequest;
use GeminiAPI\Resources\Content;

header('Content-Type: text/plain');

// Read the incoming POST data
$input = json_decode(file_get_contents('php://input'), true);
$student = $input['studentData'] ?? [];

if (!$student) {
    echo "No student data provided.";
    exit;
}

// Compose a prompt
$prompt = "Provide a formal academic case analysis for the following student:\n\n";
$prompt .= "Name: {$student['first_name']} {$student['surname']}\n";
$prompt .= "Student Number: {$student['student_id']}\n";
$prompt .= "Program: {$student['program']}, Major: {$student['major']}\n";
$prompt .= "Offense Type: {$student['offense_type']}\n";
$prompt .= "Sanction: {$student['sanction']}\n";
$prompt .= "Warning Level: {$student['warning']}\n";
$prompt .= "Statement: {$student['statement']}\n\n";
$prompt .= "Please analyze the student's offense, contextualize based on academic conduct, and recommend actions.";

// Initialize Gemini Client
$apiKey = 'AIzaSyALtzKm41Oi46bOHwsyjpWv41KxPCD7oH8';
$client = new Client($apiKey);
$model = 'gemini-1.5-pro';

try {
    // Use the helper method to construct the content with default "user" role
    $content = Content::text($prompt);

    // Create the request with model and content
    $request = new GenerateContentRequest($model, [$content]);

    // Generate the AI response
    $response = $client->generateContent($request);
    echo $response->text();  // Output the generated text
} catch (Exception $e) {
    echo "AI Error: " . $e->getMessage();
}
