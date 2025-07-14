<?php
  require_once('init.php');

  $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
  $work = htmlspecialchars($_POST['work'], ENT_QUOTES);
  $holiday = htmlspecialchars($_POST['holiday'], ENT_QUOTES);
  $relax = htmlspecialchars($_POST['relax'], ENT_QUOTES);

  if($name and $work and $holiday and $relax){
    $TOKEN = $curlclass->login($URL, $DB, $AUTH);

    $LAYOUT = 'Questionnaire';
    $SCRIPT = 'AddQuestionnaire';
    $SCRIPTPARAM = $name . ',' . $work . ',' . $holiday . ',' . $relax;
    $result   = $curlclass->script($URL, $DB, $LAYOUT, $TOKEN, $SCRIPT, $SCRIPTPARAM);
  
    $result = $curlclass->logout($URL , $DB, $TOKEN);
  
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケートフォーム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-select, .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="form-title">アンケートフォーム</h2>
        <form action="questionnaire.php" method="post">
            <!-- 名前 -->
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <!-- 職業 -->
            <div class="mb-3">
                <label for="work" class="form-label">職業</label>
                <input type="text" class="form-control" id="work" name="work" required>
            </div>
            
            <!-- 休日の過ごし方 -->
            <div class="mb-3">
                <label for="holiday" class="form-label">休日の過ごし方</label>
                <select class="form-select" id="holiday" name="holiday" required>
                    <option value="" disabled selected>選択してください</option>
                    <option value="読書">読書</option>
                    <option value="運動">運動</option>
                    <option value="旅行">旅行</option>
                    <option value="映画鑑賞">映画鑑賞</option>
                    <option value="友人と過ごす">友人と過ごす</option>
                </select>
            </div>
            
            <!-- ストレス解消法 -->
            <div class="mb-3">
                <label for="relax" class="form-label">ストレス解消法</label>
                <select class="form-select" id="relax" name="relax" required>
                    <option value="" disabled selected>選択してください</option>
                    <option value="音楽を聴く">音楽を聴く</option>
                    <option value="散歩">散歩</option>
                    <option value="マッサージ">マッサージ</option>
                    <option value="趣味に没頭する">趣味に没頭する</option>
                    <option value="リラクゼーション">リラクゼーション</option>
                </select>
            </div>
            
            <!-- 送信ボタン -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">送信</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
