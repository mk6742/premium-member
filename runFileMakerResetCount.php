<?php
// FileMaker の初期設定を読み込む
require_once("init.php");
session_start();

// ログインしているかを確認
if (!isset($_SESSION['token'])) {
    die('Not logged in');
}

$token = $_SESSION['token'];  // FileMaker トークン
$scriptName = "ResetCount";    // カウントリセット用のスクリプト名

// FileMaker スクリプト実行（カウントをリセット）
$response = $curlclass->script($URL, $DB, '投稿', $token, $scriptName, null);

// リセットしたカウントを再取得（カウントが0にリセットされているか確認）
$getUpdatedCount = $curlclass->getrecords($URL, $DB, '投稿', $token);
$newCount = $getUpdatedCount['response']['data'][0]['count'] ?? 0; // 最新のカウント値

// 結果の返却
if (isset($response['response'])) {
    echo json_encode([
        'success' => true,
        'count' => $newCount,  // 更新されたカウント値を返す
        'message' => 'Count reset successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => $response['messages'][0]['message'] ?? 'Unknown error'
    ]);
}
