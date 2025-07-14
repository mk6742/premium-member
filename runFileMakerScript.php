<?php
// FileMaker の初期設定を読み込む
require_once("init.php");
session_start();

// ログイン状態の確認
if (!isset($_SESSION['token'])) {
    // ログインしていなければログインを実行
    $token = $curlclass->login($URL, $DB, $AUTH);
    $_SESSION['token'] = $token;  // トークンをセッションに保存
} else {
    // すでにログインしていればセッションからトークンを取得
    $token = $_SESSION['token'];
}

// 実行する FileMaker スクリプト名
$scriptName = "IncrementCount";  // スクリプト名を指定

// FileMaker スクリプトの実行
$response = $curlclass->script($URL, $DB, '投稿', $token, $scriptName, null);

// スクリプト結果が成功であれば返す
if (isset($response['response'])) {
    echo json_encode([
        'success' => true,
        'count' => $response['response']['scriptResult']  // スクリプト結果を返す
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => $response['messages'][0]['message'] ?? 'Unknown error'
    ]);
}
