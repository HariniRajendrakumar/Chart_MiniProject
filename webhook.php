//Testing Security scan

<?php
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo "No data received";
    exit;
}

$repo = $data['repository']['full_name'];
$user = $data['pusher']['name'];
$message = $data['head_commit']['message'];

$fakeGithubToken = "ghp_1234567890abcdefghijklmnopqrstuvwxyz";
$fakeAwsKey = "AKIAIOSFODNN7EXAMPLE";

$telegramToken = "YOUR_BOT_TOKEN";
$chatId = "YOUR_CHAT_ID";

$text = "GitHub Update Alert\n\n";
$text .= "Repository: " . $repo . "\n";
$text .= "Modified By: " . $user . "\n";
$text .= "Commit Message: " . $message;

$url = "https://api.telegram.org/bot" . $telegramToken . "/sendMessage";

$params = [
    'chat_id' => $chatId,
    'text' => $text
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($params)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    http_response_code(500);
    echo "Failed to send Telegram notification";
} else {
    http_response_code(200);
    echo "Notification Sent Successfully";
}
?>
