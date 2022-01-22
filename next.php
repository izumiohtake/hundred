<?php
session_start();
require('dbconnect.php');

if($_POST['on']){
header('Location: index.php');exit();
}
//投稿を取得する
//$posts=$db->query('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');

 $id = $_GET['summit_id'];
 echo'eeeee';
print_r($id);
 //die;

 //$record='INSERT INTO test(id,summit) VALUES (:id,:summit)';
 $record='INSERT INTO test(summit) VALUES ('.$id.')';
 // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
 $stmt = $db->prepare($record); //挿入する値は空のまま、SQL実行の準備をする
 $params = array( ':summit' => $id); // 挿入する値を配列に格納する
 $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

echo "<p>summit: ".$id."</p>";

 echo '<p>DBに登録しました。</p>'; // 登録完了のメッセージ
 //header('Location:test.php');exit();
 ?>




