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
 
<?php
$members=$db->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($_SESSION['id']));
$member=$members->fetch();
//echo 'nnn';
//var_dump($member);

echo htmlspecialchars($member['name']);?>さん、現在◯座登頂

<?php

$all = $db->query('SELECT mnt_name FROM mountains');
echo"<table border='1'class='targetTable'>";

//for($i=0;$i<100;$i++){
// if($i%10==0){
//  echo"<tr>";
$counter = 0;
$table_string = '';  
while($row = $all->fetch()){
if($counter == 0){ $table_string .= "<tr>"; }

$table_string .= "<td><button id=’button’ onclick=”alert('おめでとうございます!')”>登頂</button>
<a href='https://ja.wikipedia.org/wiki/".$row[mnt_name]."'>".$row[mnt_name]."</h2></a> </td>";
$counter++;
if($counter == 10){ 
  $table_string .= "</tr>";
  $counter = 0;
}
//if($i%10==0){
//echo"</tr>";
}
 echo $table_string;
 echo"</tr></table>";
?><br>

<tr>

<!--<form action="test.php" method="post">-->
<button id='button' type='submit' name='on' value=''> 
<div id="text-button"><a id="tex" href="next.php">登録</a></div>
</button> 

</div>
<h2 id="text">山名</h2>
</tr>





 <div class="box1">
  <a href="summit.php">登山履歴へ</a></div>
 <div class="box1">
  <a href="index.php">トーク画面へ</a></div><br><br>
 <div class="box2">
  	<a href="logout.php">ログアウト</a></div>
    
  <script type="text/javascript" src="home.js"></script>
</body>
</html>

