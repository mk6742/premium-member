<?php
require_once("init.php");
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($id) && !empty($password)) {
        $AUTH = base64_encode("$id:$password");
        $token = $curlclass->login($URL, $DB, $AUTH);

        if ($token) {
            // t_保障用ID に一致するレコードがあるか確認
            $LAYOUT = '顧客マスタ';
            $postFields = json_encode([
                'query' => [['t_保障用ID' => $id]],
                'limit' => 1
            ]);
            $result = $curlclass->find($URL, $DB, $LAYOUT, $token, $postFields);

            // レコードが1件でも見つかったか判定
            if (
                isset($result['response']['data'][0]['fieldData']) &&
                ($result['response']['data'][0]['fieldData']['t_保障用ID'] ?? '') === $id
            ) {
                $premiumID = $result['response']['data'][0]['fieldData']['t_保障用ID'];

                $_SESSION['user'] = [
                    'id' => $id,
                    'auth' => $AUTH,
                    'token' => $token,
                    't_保障用ID' => $premiumID
                ];

                header("Location: customer.php");
                exit;
            } else {
                $error = "ログインに失敗しました。顧客情報が見つかりません。";
            }
        } else {
            $error = "ログインに失敗しました。アカウント名またはパスワードが正しくありません。";
        }
    } else {
        $error = "アカウント名とパスワードを入力してください。";
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="p-login">
        <div class="p-login__panel">
            <div class="p-login__panel__heading">
                <p>Renoviaプレミアム会員</p>
                <h1>Login</h1>
            </div>
            <form method="POST">
                <label>
                    <span>ユーザーID</span>
                    <input type="text" name="id" required>
                </label>
                <label>
                    <span>パスワード</span>
                    <div class="password-wrap">
                        <input type="password" name="password" required>
                        <i id="eye" class="fa-solid fa-eye"></i>

                        <script>
                            let eye = document.getElementById("eye");
                            eye.addEventListener('click', function() {
                                if (this.previousElementSibling.getAttribute('type') == 'password') {
                                    this.previousElementSibling.setAttribute('type', 'text');
                                    this.classList.toggle('fa-eye');
                                    this.classList.toggle('fa-eye-slash');
                                } else {
                                    this.previousElementSibling.setAttribute('type', 'password');
                                    this.classList.toggle('fa-eye');
                                    this.classList.toggle('fa-eye-slash');
                                }
                            })
                        </script>
                    </div>
                </label>
                <button type="submit">Login</button>
            </form>
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>