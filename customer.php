<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

require_once('init.php');

$userData = $_SESSION['user'];
$AUTH = $userData['auth'] ?? '';
$premiumId = $userData['t_保障用ID'] ?? '';

$TOKEN = $curlclass->login($URL, $DB, $AUTH);
$LAYOUT = '顧客マスタ';

$postFields = json_encode([
    'query' => [
        ['t_保障用ID' => $premiumId]
    ],
    'limit' => 1
]);

$result = $curlclass->find($URL, $DB, $LAYOUT, $TOKEN, $postFields);
$curlclass->logout($URL, $DB, $TOKEN);

$customer = $result['response']['data'][0]['fieldData'] ?? null;



// echo "<pre>";
// print_r($result);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>顧客情報</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="p-customer">
        <div class="p-customer__left">
            <div class="p-customer__left__heading">
                <p>
                    こんにちは！<br>
                    <?php echo htmlspecialchars($customer['t_顧客名'] ?? 'unknown'); ?>さん
                </p>
                <div class="p-customer__left__heading__id">
                    <p>会員ID：</p>
                    <p>
                        <?= htmlspecialchars($customer['t_保障用ID'] ?? '記載なし') ?>
                    </p>
                </div>
            </div>

            <div class="p-customer__left__customer-info">
                <p>お客様情報</p>
                <table>
                    <tr>
                        <td>氏名かな</td>
                        <td><?= htmlspecialchars($customer['t_顧客名カナ'] ?? '記載なし') ?></td>
                    </tr>
                    <tr>
                        <td>氏名</td>
                        <td><?= htmlspecialchars($customer['t_顧客名'] ?? '記載なし') ?></td>
                    </tr>
                    <tr>
                        <td>固定電話</td>
                        <td><?= htmlspecialchars($customer['cn_電話固定'] ?? '記載なし') ?></td>
                    </tr>
                    <tr>
                        <td>携帯電話</td>
                        <td><?= htmlspecialchars($customer['cn_電話携帯'] ?? '記載なし') ?></td>
                    </tr>
                    <tr>
                        <td>郵便番号</td>
                        <td><?= htmlspecialchars($customer['t_郵便番号'] ?? '記載なし') ?></td>
                    </tr>
                    <tr>
                        <td>住所</td>
                        <td><?= htmlspecialchars($customer['t_連結住所'] ?? '記載なし') ?></td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="p-customer__center">
            <div class="p-customer__center__heading">
                <p>契約内容</p>
                <p>Contract Detail.</p>
            </div>
            <div class="p-customer__center__contents">
                <div class="p-customer__center__contents__item">
                    <div class="p-customer__center__contents__item__heading">プレミアム会員</div>

                    <div class="p-customer__center__contents__item__main">
                        <div class="p-customer__center__contents__item__main__element">
                            <p>保証期間：</p>
                            <p><span>2</span>年</p>
                        </div>
                        <div class="p-customer__center__contents__item__main__element">
                            <p>サービス内容：</p>
                            <ul>
                                <li>・発電シミュレーション＆キャッシュバック保証</li>
                                <li>・太陽光⾧期延⾧保証</li>
                                <li>・住宅設備延⾧保証</li>
                                <li>・駆け付けサービス</li>
                                <li>・足場費用サポート</li>
                            </ul>
                        </div>
                    </div>

                    <div class="p-customer__center__contents__item__bottom">
                        <a href="./pdf/Renovia-premium-member.pdf" target="_blank">マニュアル</a>
                        <a href="./pdf/Renovia-premium-member.pdf" download>資料ダウンロード</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-customer__right">
            <div class="p-customer__right__news">
                <div class="p-customer__right__news__heading">
                    <p>お知らせ</p>
                    <a href="">すべて見る</a>
                </div>
                <ul>
                    <li>
                        <a href="">
                            <time datetime="2025-07-14">2025.07.14</time>
                            <p>システムメンテナンスのお知らせ</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="p-customer__right__nav">
                <a href="">お問い合わせ</a>
                <a href="./logout.php">ログアウト</a>
            </div>
        </div>
    </main>
</body>

</html>