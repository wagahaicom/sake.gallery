<?PHP
#共通設定======================================================================
#error表示設定
ini_set( 'display_errors', 0 );
date_default_timezone_set('Asia/Tokyo');
#SQL接続設定
$SQL_server = "mysql116.phy.lolipop.lan";
$SQL_db = "LAA0414089-sake";
$SQL_usr = "LAA0414089";
$SQL_pass = "sakesake";

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Your page title</title>

<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
    <style type="text/css">
      <!--
        #suggest {
          position: absolute;
          background-color: #FFFFFF;
          border: 1px solid #CCCCFF;
          width: 100%;
          margin-top: -70px;
        }
        #suggest div {
          padding: 1px;
          display: block;
          width: 400px;
          overflow: hidden;
          white-space: nowrap;
        }
        #suggest div.select{
          color: #FFFFFF;
          background-color: #3366FF;
        }
        #suggest div.over{
          background-color: #99CCFF;
        }
        #suggest strong{
          font-weight: bold;
        }
        body{
          margin:10px; 
        }
/* ラジオボタンは非表示にする */
input[type=radio] {
  display: none; 
}
/* チェックされた時のスタイル */
input[type="radio"]:checked + label {
  background: #0063A4;
  color: #FFF; 
  background-image: url("/img/rdo2.png");
  background-repeat: no-repeat;
}
/* マウスオーバーしたときのスタイル */
.label:hover {
  background-color: #E2EDF9; 
}
/* lableのスタイル */
.label {
  color: #000;
  border: #dddddd solid 2px;
  display: block;
  height: 45px;
  line-height: 45px;
  padding-left: 40px; /* 背景画像の分だけ少し右へ */
  padding-right: 15px;
  cursor: pointer; 
  background-image: url("/img/rdo1.png");
  background-repeat: no-repeat;
}
ul li{
  float: left;
  list-style: none;
  padding: 5px;

}
ul{
    margin-top: 0px;
}
        -->
    </style>
</head>

<body>
<p><a href="test.php">投稿</a></p>
<table border="1">
<?PHP
#共通設定======================================================================
#error表示設定
ini_set( 'display_errors', 0 );
date_default_timezone_set('Asia/Tokyo');
#SQL接続設定
$SQL_server = "mysql116.phy.lolipop.lan";
$SQL_db = "LAA0414089-sake";
$SQL_usr = "LAA0414089";
$SQL_pass = "sakesake";

#共通関数======================================================================
#DB格納用エンコード
function DB_ENCODE($text) {
    $text = htmlspecialchars($text, ENT_QUOTES);
    return $text;
}
function DB_DECODE($text) {
    $text = htmlspecialchars_decode($text, ENT_QUOTES);
    return $text;
}
function HTML_ENCODE($text) {
    $text = htmlspecialchars($text, ENT_QUOTES);
    //$text = str_replace('&', '&amp;', "$text");
    $text = str_replace("\r\n", '<br>', "$text");
    return $text;
}

    //writer情報取り出し
$query= <<<EOF
SELECT * FROM sake;
EOF;
$mysqli = new mysqli("$SQL_server", "$SQL_usr", "$SQL_pass", "$SQL_db");
if ($mysqli->connect_errno){echo "Failed to connect to MySQL: " . $mysqli->connect_error;}
$mysqli->set_charset("utf8"); // 文字化け防止
$result = $mysqli->query("$query"); // クエリの発行
echo '<tr>
    <th>タイトル</th>
    <th>味覚1</th>
    <th>味覚2</th>
    <th>味覚3</th>
    </tr>';

while( $row = $result->fetch_assoc() ) {
echo '<tr><td>';
    echo $row['title'];
echo '</td><td>';
    echo $row['t1'];
echo '</td><td>';
    echo $row['t2'];
echo '</td><td>';
    echo $row['t3'];
echo '</td></tr>';  
}
  
$result->close(); // 結果セットを開放
$mysqli->close();

?>
</table>
</body>
</html>