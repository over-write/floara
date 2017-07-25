<?php

$user = 'admin';
$pass = 'pass';
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Private Page"');
    header('HTTP/1.0 401 Unauthorized');
    die("ログインするためには正しい入力情報が必要です");
} else {
    if ($_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) {
        header('WWW-Authenticate: Basic realm="Private Page"');
        header('HTTP/1.0 401 Unauthorized');
        die("入力情報が一致しません");
    }
}

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

if(isset($_POST["init"])) {
    $link = mysqli_connect($server, $username, $password, $db);
    $result = mysqli_query($link, "update page set body = '<tr><th>エリア</th><th>店名</th><th>開店時間</th></tr><tr><td>東京</td><td>かつ屋</td><td style=\"text-align: center\">10時〜22時</td></tr><tr><td>名古屋</td><td>吉野家</td><td style=\"text-align: center\">24時間営業</td></tr><tr><td>大阪</td><td>ゴーゴーカレー</td><td style=\"text-align: center\">9時〜24時</td></tr><tr><td>神戸</td><td>らんぷ亭</td><td style=\"text-align: center\">24時間営業</td></tr>'");
}

if(isset($_POST["table-data"])){

    $link = mysqli_connect($server, $username, $password, $db);
    $result = mysqli_query($link, "update page set body ='" . $_POST["table-data"] ."'");
    echo "保存しました";
    exit;
}else{
    // If arrives here, is a valid user.
    include("./index.php");
}