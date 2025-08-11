<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
} else {
    // GETでアクセスされたらログイン画面に戻すだけ
    header('Location: index.php');
    exit;
}
