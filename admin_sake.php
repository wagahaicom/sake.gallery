<?PHP
session_start();
//Facebook SDK for PHP の src/ にあるファイルを
//サーバ内の適当な場所にコピーしておく
//40文字
require_once("facebook.php");
 
$config = array(
    'appId'  => '178000192650303',
    'secret' => 'c23659a5a384d8195b203602a25c3fd1'
);
 
$facebook = new Facebook($config);
$loginUrl = $facebook->getLoginUrl();
$userId = $facebook->getUser();

if($userId == '667115796800131'){
        $_SESSION[‘name’] = 'masunari';
}elseif($userId == '1117996754921890'){
        $_SESSION[‘name’] = 'hide';
}else{
    header('Location: /');
    exit;
}
?><!DOCTYPE html>
<html>
<head>
<title>sake.gallery管理画面</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <h4>sake.gallery AdminSystem</h4>
<?PHP echo $_SESSION[‘name’]; ?>さん、ようこそ

    
<ul>
    <li><a href="">酒名管理</a></li>
    <li><a href="">酒造管理</a></li>
    <li><a href="">会員管理</a></li>
    </ul>
</body>
</html>
