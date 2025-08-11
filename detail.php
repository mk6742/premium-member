<?php
session_start();
require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? '';

if (empty($id)) {
    echo "IDが指定されていません。";
    exit;
}

$TOKEN = $curlclass->login($URL, $DB, $AUTH);
$LAYOUT = '案件_管理アポ'; // あなたの詳細表示に使うレイアウト名に合わせてください

$result = $curlclass->getRecordById($URL, $DB, $LAYOUT, $TOKEN, $id);
$curlclass->logout($URL, $DB, $TOKEN);

$record = $result['response']['data'][0] ?? null;

if (!$record) {
    echo "<pre>";
    print_r($result); // ← これでAPIレスポンス構造確認
    echo "</pre>";
    echo "データが見つかりません。";
    exit;
}

// echo "<pre>";
// print_r($result);
// echo "</pre>";

$field = $record['fieldData'] ?? [];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>詳細情報</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h1>詳細情報（<?= htmlspecialchars($field['t_契約者名'] ?? '') ?>）</h1>

    <table>
        <tr>
            <th>契約者名</th>
            <td><?= htmlspecialchars($field['t_契約者名'] ?? '記載なし') ?></td>
        </tr>
        <tr>
            <th>管理番号</th>
            <td><?= htmlspecialchars($field['n_管理番号'] ?? '記載なし') ?></td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td><?= htmlspecialchars($field['t_エントリーステータス'] ?? '記載なし') ?></td>
        </tr>
        <tr>
            <th>サブステータス</th>
            <td><?= htmlspecialchars($field['t_サブエントリーステータス'] ?? '記載なし') ?></td>
        </tr>
        <!-- 他にも必要な項目を追加 -->
    </table>

    <p><a href="customer.php">← 一覧に戻る</a></p>
</body>

</html>