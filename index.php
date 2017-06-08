<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <style>
    html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
    </style>
</head>
<body>
<img src="./img/test00.png" width="320"><br>
<?php
//Facebook SDK for PHP の src/ にあるファイルを
//サーバ内の適当な場所にコピーしておく
require_once("facebook.php");
 
$config = array(
    'appId'  => '178000192650303',
    'secret' => 'c23659a5a384d8195b203602a25c3fd1'
);
 
$facebook = new Facebook($config);
$loginUrl = $facebook->getLoginUrl();
echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
$userId = $facebook->getUser();
    print_r($user);
?>
<p>
<?PHP 
    if(isset($userId)){
        echo 'Login ID:' . "$userId";
echo<<<EOF
<br><img src="https://graph.facebook.com/${userId}/picture">
EOF;
    }else{
        echo 'ログインしていません';
    }
?>
    <p><a href="admin.php">[admin]</a></p>
</p>
</body>
</html>
