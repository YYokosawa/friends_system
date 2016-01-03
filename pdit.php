<?php
//1.データベースに接続する
$dsn = 'mysql:dbname=tomodachi;host=localhost';
$user = 'root';
$password = 'mysql';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

if (isset($_POST['name'])){
	echo 'POST送信された！';
	
	//Update文
	$sql = "UPDATE `friends_table` SET `name` = '".$_POST['name']."',`gender` = '".$_POST['gender']."',`age` = '".$_POST['age'];
	$sql .= "' WHERE `id` = ".$_POST['id'];
	
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	//処理が全て終わった後、都道府県一覧に戻る
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/area.php');
}else{
	echo 'POST送信されてない';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>FriendsSystem</title>
</head>
<body>
	<?php
	//2.SQLで指令をだす
		$sql_friends = 'SELECT * FROM `friends_table` WHERE `id` = '.$_GET['id'];
		$stmt_friends = $dbh->prepare($sql_friends);
		$stmt_friends->execute();
		$rec_friends = $stmt_friends->fetch(PDO::FETCH_ASSOC);
		$id = $rec_friends['id'];
		$area_table_id = $rec_friends['area_table_id'];
		$name = $rec_friends['name'];
		$gender = $rec_friends['gender'];
		$age = $rec_friends['age'];
		$sql = 'SELECT * FROM `area_table`';
		//echo $sql;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
	?>
	<h2>お友達の編集</h2>

	<form method="post" >
		名前
		<input name="name" type="text" style="width:100px;height:30px;" maxlength="20" value="<?php echo $name; ?>"><br />
		出身
		<select name="area_table_id">
			<?php
				while(1){
					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($rec == false){
						break;
					}
					if ($area_table_id == $rec['id']){
						echo '<option value="'.$rec['id'].'" selected>';
					}else{
						echo '<option value="'.$rec['id'].'">';						
					}
					echo $rec['name'];
					echo '</option>';
				}
			?>
		</select><br />
		性別
		<select name="gender">
			<?php 
				if ($gender == '男'){
					echo '<option value="男" selected>男性</option>';
					echo '<option value="女">女性</option>';
				}else{
					echo '<option value="男">男性</option>';
					echo '<option value="女" selected>女性</option>';					
				}
			?>
		</select><br />
		年齢
		<input name="age" type="text" style="width:100px;height:30px;" maxlength="10" value="<?php echo $age; ?>"><br />
		<input name="id" type="hidden" value="<?php echo $id; ?>">
		<br />		
		<input type="submit" value="保存" >
	</form>
</body>
</html>
