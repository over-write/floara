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


if(isset($_POST["table-data"])){
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = mysqli_connect($server, $username, $password, $db);
    $result = mysqli_query($link, "update page set body ='" . $_POST["table-data"] ."'");
    echo "保存しました";
    exit;
}else{
    // If arrives here, is a valid user.
    include("./index.php");
}