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

$date_add = @$_POST['date_add'];

echo $date_add;

# メイン処理START======================================================================
if(isset($date_add)){
$title = DB_ENCODE(@$_POST['title']);
$comment = DB_ENCODE(@$_POST['comment']);
$t1 = DB_ENCODE(@$_POST['t1']);
$t2 = DB_ENCODE(@$_POST['t2']);
$amami = DB_ENCODE(@$_POST['amami']);
$umami = DB_ENCODE(@$_POST['umami']);
$sanmi = DB_ENCODE(@$_POST['sanmi']);
$kaori = DB_ENCODE(@$_POST['kaori']);
$s1 = DB_ENCODE(@$_POST['s1']);
$s2 = DB_ENCODE(@$_POST['s2']);
$s3 = DB_ENCODE(@$_POST['s3']);
$s4 = DB_ENCODE(@$_POST['s4']);
$s5 = DB_ENCODE(@$_POST['s5']);
$s6 = DB_ENCODE(@$_POST['s6']);

//画像保存
if (is_uploaded_file($_FILES['img1']['tmp_name'])){
    //move_uploaded_file($_FILES['img_main']['tmp_name'], "../../image/article/${id}_main.jpg");
    $fp = fopen($_FILES["img1"]["tmp_name"], "r");
    $imgdat = fread($fp, filesize($_FILES["img1"]["tmp_name"]));
    fclose($fp);
  $imgdat = addslashes($imgdat);
$img_sql = <<<EOF
    `img1` = '${imgdat}' ,
EOF;
}else{
  $img_sql ='';
}

$query= <<<EOF
INSERT INTO  `LAA0414089-sake`.`sake` (
`id` ,
`title`,
`comment`,
`t1`,
`t2`,
`amami`,
`umami`,
`sanmi`,
`kaori`,
`option1`,
`option2`,
`option3`,
`option4`,
`option5`,
`option6`,
`img1`,
`date_add`
)
VALUES (
NULL ,  
'${title}',
'${comment}',
'${t1}',
'${t2}',
'${amami}',
'${umami}',
'${sanmi}',
'${kaori}',
'${s1}',
'${s2}',
'${s3}',
'${s4}',
'${s5}',
'${s6}',
'${imgdat}',
'${date_add}'
);
EOF;
  $mysqli = new mysqli("$SQL_server", "$SQL_usr", "$SQL_pass", "$SQL_db");
  if ($mysqli->connect_errno){echo "Failed to connect to MySQL: " . $mysqli->connect_error;}
  $mysqli->set_charset("utf8"); // 文字化け防止
  $result = $mysqli->query("$query"); // クエリの発行
  //$result->close(); // 結果セットを開放
  $mysqli->close();
  $message = '<p>データ追加完了</p>';
}
# メイン処理END======================================================================

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


<?PHP
   if(isset($date_add)){
       $date_add = "$date_add";
   }else{
       $date_add = date('Y-m-d\TH:i');
   }
    if(checkdate($date_add)){
    echo"日付　OK";
   }else{
        echo"日付NG";
    }
//日付が入っていない場合は現在日時に変更
echo "$message";    
?>
<p><a href="test_list.php">list</a></p>
<form class="pure-form" action="test.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999999" />
  <input type="datetime-local" name="date_add" min="2017-01-01T00:00" max="2050-12-31T23:59" class="pure-input-1" value="<?PHP echo "$date_add";?>">
  <input type="file" id="file" name="img1">
  <fieldset class="pure-group">
  <input type="text" id="text" class="pure-input-1" placeholder="銘柄" autocomplete="off" name="title">

  <textarea class="pure-input-1" placeholder="コメント" name="comment"></textarea>
  <div id="suggest" style="display:none;"></div>
  </fieldset>


  <table class="pure-table pure-table-bordered pure-input-1">
      <tbody>
          <tr>
              <td>
              <select name="t1">
                <option>甘味</option>
                <option>ドライ</option>
                <option>コク</option>
                <option>端麗</option>
                <option>酸</option>
                <option>フレッシュ</option>
                <option>まろやか</option>
                <option>吟醸香</option>
                <option>発泡</option>
                <option>熟成</option>

              </select>
            <select name="t2">
                <option>甘味</option>
                <option>ドライ</option>
                <option>コク</option>
                <option>端麗</option>
                <option>酸</option>
                <option>フレッシュ</option>
                <option>まろやか</option>
                <option>吟醸香</option>
                <option>発泡</option>
                <option>熟成</option>

              </select>
              <select name="t3">
                <option>純米大吟醸</option>
                <option>純米吟醸</option>
                <option>特別純米</option>
                <option>純米</option>
                <option>大吟醸</option>
                <option>吟醸</option>
                <option>特別本醸造</option>
                <option>本醸造</option>
                <option>普通</option>
              </select>
              </td>
          </tr>
      </tbody>
  </table>
  <br>
  <table class="pure-table pure-table-bordered pure-input-1">
      <thead>
          <tr>
              <td>&nbsp;</td>
              <td>?</td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>甘味</td>
              <td colspan="6"><input type="range" name="amami" class="pure-input-1" min="0" max="5" ></td>
          </tr>
          <tr>
              <td>旨味</td>
              <td colspan="6"><input type="range" name="umami" class="pure-input-1" min="0" max="5"></td>
          </tr>
          <tr>
              <td>酸味</td>
              <td colspan="6"><input type="range" name="sanmi" class="pure-input-1" min="0" max="5"></td>
          </tr>
          <tr>
              <td>香り</td>
              <td colspan="6"><input type="range" name="kaori" class="pure-input-1" min="0" max="5"></td>
          </tr>
      </tbody>
  </table>
  <br>
  <table class="pure-table pure-table-bordered pure-input-1">
    <thead>
        <tr>
            <th>火入れ</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s1" id="s1_1" value="生酒" />
                  <label for="s1_1" class="label">生酒</label></li>
                <li><input type="radio" name="s1" id="s1_2" value="火入れ" />
                  <label for="s1_2" class="label">火入れ</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
    <thead>
        <tr>
            <th>ろ過</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s2" id="s2_1" value="無ろ過" />
                  <label for="s2_1" class="label">無ろ過</label></li>
                <li><input type="radio" name="s2" id="s2_2" value="おりがらみ" />
                  <label for="s2_2" class="label">おりがらみ</label></li>
                  <li><input type="radio" name="s2" id="s2_3" value="うすにごり" />
                  <label for="s2_3" class="label">うすにごり</label></li>
                  <li><input type="radio" name="s2" id="s2_4" value="にごり" />
                  <label for="s2_4" class="label">にごり</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
      <thead>
        <tr>
            <th>加水</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s3" id="s3_1" value="原酒" />
                  <label for="s3_1" class="label">原酒</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
    <thead>
        <tr>
            <th>季節</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s4" id="s4_1" value="しぼりたて" />
                  <label for="s4_1" class="label">しぼりたて</label></li>
                <li><input type="radio" name="s4" id="s4_2" value="新種" />
                  <label for="s4_2" class="label">新種</label></li>
                  <li><input type="radio" name="s4" id="s4_3" value="ひやおろし" />
                  <label for="s4_3" class="label">ひやおろし</label></li>
                  <li><input type="radio" name="s4" id="s4_4" value="あきあがり" />
                  <label for="s4_4" class="label">あきあがり</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
      <thead>
        <tr>
            <th>造り</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s5" id="s5_1" value="山廃" />
                  <label for="s5_1" class="label">山廃</label></li>
                <li><input type="radio" name="s5" id="s5_2" value="生酛" />
                  <label for="s5_2" class="label">生酛</label></li>
                  <li><input type="radio" name="s5" id="s5_3" value="菩薩酛" />
                  <label for="s5_3" class="label">菩薩酛</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
      <thead>
        <tr>
            <th>搾り</th>
        </tr>
    </thead>
      <tbody>
          <tr>
              <td>
              <ul>
                <li><input type="radio" name="s6" id="s6_1" value="荒走り" />
                  <label for="s6_1" class="label">荒走り</label></li>
                <li><input type="radio" name="s6" id="s6_2" value="中取り" />
                  <label for="s6_2" class="label">中取り</label></li>
                  <li><input type="radio" name="s6" id="s6_3" value="責め" />
                  <label for="s6_3" class="label">責め</label></li>
                  <li><input type="radio" name="s6" id="s6_4" value="袋吊り" />
                  <label for="s6_4" class="label">袋吊り</label></li>
                  <li><input type="radio" name="s6" id="s6_5" value="斗瓶取り" />
                  <label for="s6_5" class="label">斗瓶取り</label></li>
                  <li><input type="radio" name="s6" id="s6_6" value="斗瓶囲い" />
                  <label for="s6_6" class="label">斗瓶囲い</label></li>
                  <li><input type="radio" name="s6" id="s6_7" value="槽しぼり" />
                  <label for="s6_7" class="label">槽しぼり</label></li>
              </ul>
              </td>
          </tr>
      </tbody>
  </table>


  <button type="submit" class="pure-button pure-input-1 pure-button-primary">投稿</button>

</form>

  <script src="/js/suggest.js"></script>
  <script src="/js/list.js"></script>
  <script>
  <!--
  // wondowのonloadイベントでSuggestを生成
  // (listは、list.js内で定義している)
  var start = function(){new Suggest.Local("text", "suggest", list, {dispMax: 10, highlight: true});};
  window.addEventListener ?
  window.addEventListener('load', start, false) :
  window.attachEvent('onload', start);
  //-->
  </script>
</body>
</html>