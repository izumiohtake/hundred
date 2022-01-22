<?php
session_start();
require('dbconnect.php');



//投稿を取得する
//$posts=$db->query('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
//$mnt=$db->prepare('SELECT y.mnt_name, d.summit FROM mountains y, date d WHERE ORDER BY d.summit DESC');
// $mnt->execute(array($_REQUEST['id'])); 
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>登頂履歴</title>
<link rel='stylesheet' href="style.css"/>
</head>

<body>

<h1>登頂履歴</h1>


<p>&laquo;<a href="data.php">ホーム一覧へ戻る</a></p>

<a href="https://ja.wikipedia.org/wiki/<?php 
$each=$db->prepare('SELECT mnt_name  FROM mountains');
$each->execute(array($_REQUEST['mnt_name'])); 
$cada=$each->fetch();
echo $cada;
?> ">onono</a>

</body>
</html>
