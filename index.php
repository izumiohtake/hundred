<?php
session_start();
require('dbconnect.php');

if(isset($_SESSION['id']) && $_SESSION['time'] +3600 > time()) {

  //ログインしている
  $_SESSION['time'] = time();

  $members=$db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member=$members->fetch();
}else{
  //ログインしていない
  header('Location: login.php');exit();
}

 //投稿を記録する
 if(!empty($_POST)){
   if($_POST['message'] != ''){
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_post_id=?, created=NOW()');
    if( $_POST['reply_post_id'] == ''){
      $_POST['reply_post_id'] = -1;
    }
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));
    //echo"kk";die;
    echo $member['id'].':'.$_POST['message'].':'.$_POST['reply_post_id'].'<br/>';
    print_r($message);
    //echo"kk";die;
     header('Location: .php');exit();
   }
 } 

//echo 'bb '.$post['reply_post_id']; die;
$page=$_REQUEST['page'];
if($page==''){
 $page=1;
}
$page=max($page,1);

//最終ページを取得する
$counts=$db->query('SELECT COUNT(*) AS cnt FROM posts');
$cnt=$counts->fetch();
$maxPage=ceil($cnt['cnt']/5);
$page=min($page,$maxPage);

$start=($page - 1)*5;
//$start=max(0,$start);

 //投稿を取得する
$posts=$db->prepare('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id 
ORDER BY p.created DESC LIMIT ?,5');

$posts->bindParam(1,$start,PDO::PARAM_INT);
$posts->execute();

//返信の場合
if(isset($_REQUEST['res'])){
  
  $response=$db->prepare('SELECT m.name,m.picture,p.* FROM members m,
  posts p WHERE m.id=p.member_id AND p.id=?  ORDER BY p.created DESC');
  
  $response->execute(array($_REQUEST['res']));
  
  $table=$response->fetch();
  $message='@'.$table['name'].''.$table['message'];
}
 

//htmlspecialcharsのショートカット                 エラーエラーエラーエラーエラーエラー
function htmlspecialchars($value){
  return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
}

//本文内のURLにリンクを設定します
function makeLink($value){
  return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)",
  '<a href="\1\2">\1\2</a>',$value);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<link rel='stylesheet' href="style.css">
<title>山トーク</title>
</head>
<body>
<h1>みんなで山話し</h1>
<div id="wrap">
<div id="head">
  </div>
  <div id="content">
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
    <form action="" method="post">
<dl>
<dt><?php echo h($member['name']);?>さん、メッセージをどうぞ</dt>
<dd>
<textarea name="message" cols="50" rows="5">
<?php echo h($message);?></textarea>

<input type="hidden" name="reply_post_id" value="<?php echo 
h($_REQUEST['res']);?>"/>
 
 <!--echo"kk";die;!-->
</dd>
</dl>
<div>
<p>
<input type="submit" value="投稿する"/>
</p>
</div>
</form>
<!--echo"kk";die;!-->
<?php
foreach ($posts as $post):
//配列（作成した配列の変数名）　$posts=$db->prepare('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id 
//キー×　値◯　$post
 //echo"kk";die;
?>

<div class="msg">
<img src="member_picture/<?php echo h($post['picture']);?>" width="48" height="48" alt="<?php echo h($post['name']);?>"/>
<p><?php echo makeLink(h($post['message']));?><span class="name">(<?php echo h($post['name']);?>)</span></p>
[<a href="index.php?res=<?php echo h($post['id']);?>">Re</a>]</p>
<p class="day"><a href="view.php?id=<?php echo h($post['id']);?>">
<?php echo h($post['created']);?></p>

<?php
//echo 'bb '.$post['reply_post_id']; die;
if ($post['reply_post_id'] > 0):
?>
<a href="view.php?id=<?php echo h($post['reply_post_id']); ?>">
返信元のメッセージ</a>
<?php
endif;
?>
<?php
if ($_SESSION['id'] == $post['member_id']):
?>
[<a href="delete.php?id=<?php echo h($post['id']); 
?>"
style="color: #F33;">削除</a>]
<?php
endif;
?>
</p>
</div>
<?php
endforeach;
?>
</div>
<ul class="padding">
<?php
if ($page > 1 ){
?>
<li><a href="index.php?page=<?php print($page - 1);?>">前のページへ</a></li>
<?php 
}else{
?>  
  <li>前のページへ</li>
<?php
}
?>
<?php
if ($page<$maxPage){
?>
<li><a href="index.php?page=<?php print($page + 1);?>">次のページへ</a></li>
<?php
}else{
?>
<li>次のページへ</li> 
<?php
}
?> 
</ul>
</div>
</div>
<p>&laquo;<a href="data.php">ホーム一覧に戻る</a></p>
</body>
</html>