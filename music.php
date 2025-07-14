<?php
// セッションを開始
session_start();

// ユーザーがログインしているか確認
if (!isset($_SESSION['user'])) {
    // ログインしていない場合はログインページへリダイレクト
    header('Location: login.php');
    exit;
}

// ログイン中のユーザー名を取得
$id = htmlspecialchars($_SESSION['user']['Username']);


require_once('init.php');

// FileMakerからデータを取得
$TOKEN = $curlclass->login($URL, $DB, $AUTH); // ログイン

$LAYOUT = '曲リスト'; // FileMakerのテーブルに紐付くレイアウト名
$result = $curlclass->getrecords($URL, $DB, $LAYOUT, $TOKEN);

$curlclass->logout($URL, $DB, $TOKEN); // ログアウト

// レコードが存在する場合
$tracks = $result['response']['data'] ?? [];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>曲リスト</title>
</head>

<body>
    <style>
        body {
            padding: 2vw;
        }

        p {
            padding: 2vw 0 0;
        }

        ul {
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1vw;
        }

        li {
            list-style: none;
        }

        form {
            padding: 2vw 0;
        }

        form ul {
            display: flex;
            flex-direction: column;
            gap: 1vw;
            padding: 0;
            padding-bottom: 1vw;
        }

        form ul li {
            display: grid;
            grid-template-columns: 100px 1fr;
        }

        .count {
            padding: 0 0 2vw;
        }
    </style>

    <p>
        こんにちは！<?php echo $id; ?>さん
    </p>

    <form method="POST" action="save-data.php">
        <ul>
            <li>
                <label for="title">タイトル:</label>
                <input type="text" name="title" id="title" required>
            </li>

            <li>
                <label for="description">説明:</label>
                <textarea name="description" id="description" required></textarea>
            </li>

            <input type="hidden" id="countValue" name="countValue" value="0" /> <!-- 隠しフィールドにカウントの値を保持 -->
        </ul>

        <button type="submit">保存</button>
    </form>

    <div class="count">
        <h4>カウントアップ</h4>
        <div id="result">0</div> <!-- カウント表示部分 -->
        <div class="btn">
            <button id="countBtn">1を足す</button>
            <button id="resetButton">リセット</button>
        </div>
    </div>

    <script>
        document.getElementById('countBtn').addEventListener('click', async () => {
            try {
                // PHP スクリプトを呼び出して FileMaker のカウントを取得
                const response = await fetch('./runFileMakerScript.php', {
                    method: 'POST'
                });

                const result = await response.json();

                if (result.success) {
                    // カウントの値を更新して表示
                    document.getElementById('result').innerText = result.count;

                    document.getElementById('countValue').value = result.count; // 隠しフィールド
                } else {
                    document.getElementById('result').innerText = `エラー: ${result.error}`;
                }
            } catch (error) {
                document.getElementById('result').innerText = `通信エラー: ${error.message}`;
            }
        });

        // リセットボタンのクリックイベント
        document.getElementById('resetButton').addEventListener('click', function() {
            fetch('runFileMakerResetCount.php', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // カウントリセット後、新しいカウント値を表示
                        document.getElementById('result').textContent = data.count; // 新しいカウント値に更新
                        document.getElementById('countValue').value = data.count; // 隠しフィールドにも値を更新
                        alert('カウントがリセットされました');
                    } else {
                        alert('リセットに失敗しました: ' + data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <section>
        <ul>
            <?php foreach ($tracks as $track): ?>
                <li>
                    <?php
                    // FileMakerから取得したiframe_codeをそのまま出力
                    echo $track['fieldData']['iframe_code'];
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>

</html>