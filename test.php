<?php
session_start(); 
error_reporting(E_ALL);
require('dbconnect.php');

if(isset($_SESSION['id']) && $_SESSION['time'] +3600 > time()) {

  //ログインしている
$_SESSION['time'] = time();

}else{
  //ログインしていない
  header('Location: login.php');exit();
}  
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<link rel='stylesheet' href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<title>ホーム</title>
</head>
<body>

<table border="1" class='targetTable'>

<tr>
<td>
<!--<form action="test.php" method="post">-->
<button id='button' type='submit' name='on' value=''> 
<div id="text-button"><a id="tex" href="next.php?summit_id=9">登録</a></div>
</button> 
</div>
<?php
//コロンと名前を使ったクエリの場合
$stmt = $db->prepare("SELECT summit FROM test where id = :id and summit = :summit and per_id = :per and mou_id = :mou");
//セットする変数を定義
$val = 5;
$val2 = 0;
$val3 = 1;
$val4 = 9;
//第二引数に変数をセットする
$stmt->bindParam("id",$val);
$stmt->bindParam("summit",$va2);
$stmt->bindParam("per_id",$va3);
$stmt->bindParam("summit",$va4);
//結果表示
$stmt->execute();
$result = $stmt->fetch();
echo "summit = ".$result['summit'].PHP_EOL;
//以降は変数の中身を変えてexecuteを実行するだけなので

?>
<?php
$all = $db->query('SELECT mnt_id FROM mountains');
print_r($all);
?>

<h2 id="text">山名</h2>
</tr>
</table>
</td>  


<!--<script type="text/javascript" src="home.js"></script>-->
</body>
</html>
       



