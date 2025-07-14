<?php
session_start();
require_once('init.php');

// ログイン確認
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// POSTデータの取得
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$count = $_POST['countValue'] ?? '';

if (empty($title) || empty($description)) {
    die("入力が不完全です。戻って再入力してください。");
}

// FileMakerのトークンを取得（セッションに保存されていると仮定）
$token = $curlclass->login($URL, $DB, $AUTH); // セッション保持していない場合は再取得
$layout = '投稿'; // FileMakerのレイアウト名に置き換える

// 入力データをFileMakerに送信
$postFields = json_encode([
    'fieldData' => [
        'title' => $title,
        'description' => $description,
        'id' => $_SESSION['user']['Username'], // ログイン中のユーザー名を記録
        'count' => $count
    ]
]);


$response = $curlclass->createRecord($URL, $DB, $layout, $token, $postFields);

// 保存の結果を確認
if (!empty($response['response']['recordId'])) {
    echo "データが正常に保存されました。<br>";
    echo "<a href='music.php'>戻る</a>";
} else {
    echo "エラーが発生しました: " . json_encode($response);
    echo "<br><a href='music.php'>戻る</a>";
}
