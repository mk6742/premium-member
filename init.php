<?php
error_reporting(0);

// ----- FileMaker Data API -----
require_once("cURL.php");
$curlclass = new cURLClass();

$URL    = 'https://app.nexus-fms.com';
$ID        = 'masaaki.kera';
$PW        = '8011628';
$DB        = 'ASLESx'; // 必要に応じてカスタム App のファイル名(データベース名)を指定
$AUTH    = base64_encode($ID . ':' . $PW);
