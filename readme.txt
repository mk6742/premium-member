本サンプルは個人の責任においてご利用ください。
不具合などの修正は行っておりません。

[ ファイルの構成 ]
DataAPISample.fmp12 : カスタム App
  アカウント名: admin
  パスワード: 1
  で開きます

  送受信レイアウト:
    BigDtaRegister.php から引数を受け取るサンプルです
      (BigDataRegister スクリプトを使用します)

    MassiveDataReceiver.php にスクリプト結果を渡すサンプルです
      (MassiveDataReceiver スクリプトを使用します)

  QAPlatform レイアウト
    serachQAplatform.php で検索実行に使用するレコードが含まれます
      ( スクリプトは使用しません。 cURL.php の find関数(Data API の検索実行)で検索します )

  Questionnaire レイアウト
    questionnaire.php からアンケート回答を受信します
      ( AddQuestionnaire スクリプトを使用します )



init.php : FileMaker Data API 接続情報
cURL.php : ライブラリ

BigDataRegister.php : 引数を用いてカスタム App のフィールドに値を追加するサンプル
MassiveDataReceiver.php : カスタム App のフィールド内容を取得し Web ブラウザに表示するサンプル
questionnaire.php : アンケートフォーム
serachQAplatform.php : FileMaker のレコード検索
