<?php
  require_once('init.php');

  $LAYOUT = '送受信';
  $SCRIPT = 'MassiveDataReceiver';

  // ----- FileMaker Data API code ------
  $TOKEN = $curlclass->login($URL, $DB, $AUTH); // 接続

  $result   = $curlclass->script($URL, $DB, $LAYOUT, $TOKEN, $SCRIPT, $SCRIPTPARAM);
  var_dump($result);

  $result = $curlclass->logout($URL , $DB, $TOKEN); // 切断
  exit();
?>
