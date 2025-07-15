<?php
error_reporting(0);

// ----- FileMaker Data API -----
require_once("cURL.php");
$curlclass = new cURLClass();

$URL    = 'https://app.nexus-fms.com';
$ID        = '';
$PW        = '';
$DB        = 'ASLESx'; // 必要に応じてカスタム App のファイル名(データベース名)を指定
$AUTH    = base64_encode($ID . ':' . $PW);
