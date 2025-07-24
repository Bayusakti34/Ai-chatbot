<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
$prompt = $data["prompt"];

// Ganti dengan API Key Anda
$apiKey = "YOUR_OPENAI_API_KEY";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
  "model" => "gpt-3.5-turbo",
  "messages" => [
    ["role" => "system", "content" => "You are a helpful assistant."],
    ["role" => "user", "content" => $prompt]
  ]
]));
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
echo json_encode([
  "response" => $result["choices"][0]["message"]["content"]
]);
