<?php
  require_once('init.php');

  if(!empty($_POST['question'])){
    $question = htmlspecialchars( $_POST['question'], ENT_QUOTES);
    $POSTFIELDS = '{"query": [{"質問":"' . $question . '"}]}';
  } else {
    $POSTFIELDS = '';
  }

  $LAYOUT = 'QAplatform';

  // ----- FileMaker Data API code ------
if(!empty($POSTFIELDS)){
  $TOKEN = $curlclass->login($URL, $DB, $AUTH); // 接続

  $result   = $curlclass->find($URL, $DB, $LAYOUT, $TOKEN, $POSTFIELDS); // 検索
  $LIST = $result['response']['data']; // 変数 $ITEMLIST に商品データを追加

  $result = $curlclass->logout($URL , $DB, $TOKEN); // 切断
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>アンケート結果</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-3">タイトル</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <div>
    <form method="post" action="serachQAplatform.php">
    <input type="text" name="question" value="<?php echo $question; ?>">
    <button tyle="submit">検索</button>
    </form>
    </div>
    <table class="table table-striped-columns">
      <tr class="table-primary">
        <th>質問</th>
        <th>回答</th>
      </tr>
<?php
  // データから部品を取り出して表示(レコード分繰返)
  foreach($LIST as $value){
    echo '<tr>';
    echo '<td>' . $value['fieldData']['質問'] . '</td>';
    echo '<td>' . $value['fieldData']['回答'] . '</td>';
    echo '</tr>';
  }
?>
        <div class="col">
            <div class="card">
            </div>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

