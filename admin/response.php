<?php
require '../vendor/autoload.php';  // Load Gemini SDK

use GeminiAPI\Client;
use GeminiAPI\Requests\GenerateContentRequest;
use GeminiAPI\Resources\Content;
use GeminiAPI\Resources\Parts\TextPart;

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
$apiKey = getenv('GEMINI_API_KEY'); // Set this in your server environment
$client = new Client($apiKey);
$model = 'models/gemini-1.5-pro-001';

try {
    $textPart = new TextPart($prompt);
    $content = new Content("user", [$textPart]);
    $request = new GenerateContentRequest($model, [$content]);

    $response = $client->generateContent($request);
    echo $response->text();  // Output the generated text
} catch (Exception $e) {
    echo "AI Error: " . $e->getMessage();
}
