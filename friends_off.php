<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>友達リスト</title>
</head>
<body>
	<?php
		$dsn ='mysql:dbname=tomodachi;host=localhost';
		// mysqlに接続命令：どのデータベースに接続？；データベースのあるサーバーの場所
		$user ='root';
		$password ='';
		//http://192.168.33.10/に入る

		$dbh = new PDO($dsn,$user,$password);
		//$dbhによって接続
		$dbh->query('SET NAMES utf8');


		$sql ='SELECT * FROM `area_table` WHERE `id` = ?';
		$date[] = $_GET['area_id'];
		//$_GET['area_id']・・・GET送信　と言う方法
		//area.phpの	 echo "<a href=\"friends.php?area_id=$rec[id]\">$rec[area]</a>";
		//によってidをarea_idと言う名前で送っている。

		$stmt =$dbh->prepare($sql);
		$stmt->execute($date);
		//($date)で18行目	$date[] = $_GET['area_id'];のデータをもらっている

		while (1) 
		{
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);

			if($rec==false)
			{
				break;
			}

			echo $rec['area'].'の友達';

			echo '<br />';
		// var_dump($_GET['area_id']);
		}
		$dbh = null;
	?>

	<?php
		$dsn ='mysql:dbname=tomodachi;host=localhost';
		// mysqlに接続命令：どのデータベースに接続？；データベースのあるサーバーの場所
		$user ='root';
		$password ='';
		//http://192.168.33.10/に入る

		$dbh = new PDO($dsn,$user,$password);
		//$dbhによって接続
		$dbh->query('SET NAMES utf8');
		//SQL文による、アンケート自動保存機能の追加（上）

		//sql文作成
		$sql = 'SELECT * FROM `friends_table` WHERE `nickname` =?';
		$date[] = $nickname;
		
		//sql文実行
		$stmt = $dbh->prepare($sql);
		// insert文を実行
		$stmt->execute($date);
		// データを全部くれというSQL文

		//実行結果として得られたデータを表示
		while (1) 
		{
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);

			if($rec==false)
			{
				break;
			}
			echo $rec['code'];
			echo ' ';
			echo '&nbsp;';
			echo $rec['nickname'];

			echo '<br />';
		// var_dump($_GET['area_id']);
		}
		
		// データベースから切断
		$dbh = null;
		// SQL文による、アンケート自動保存機能の追加（下）
	?>
</body>
</html>