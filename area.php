<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>都道府県リスト</title>
</head>
<body>
	<?php
		$dsn ='mysql:dbname=tomodachi;host=localhost';
		//mysqlに接続命令：どのデータベースに接続？；データベースのあるサーバーの場所
		$user ='root';
		$password ='mysql';
		//http://192.168.33.10/に入る用
		$dbh = new PDO($dsn,$user,$password);
		//$dbhによって接続
		$dbh->query('SET NAMES utf8');
		//
		//SQL文による、アンケート自動保存機能の追加（上）

		$sql ='SELECT * FROM `area_table` WHERE 1';

		$stmt =$dbh->prepare($sql);
		// insert文を実行
		$stmt->execute();
		// データを全部くれというSQL文
		echo '<TABLE border="1" cellpadding="2" align="left">';
		//枠作成
		echo '<tr>';
	        	echo '<th>';
	        		echo '都道府県No.';
	        	echo '</th>';
	        	echo '<th>';
	        		echo '都道府県';
	        	echo '</th>';
	        	echo '<th>';
	        		echo '友達人数';
	        	echo '</th>';
	        echo '</tr>';

		while (1) 
		{
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			// fetch・・・データを一行取り出し、カーソルを次の行に移動する
			//次の行が何もない時はfalseが返され、break(終了)となる
			//fetch()の中は、どのようにfetchするかを示しており、決まり文句として覚えておく

			

			if($rec==false)
			{
				break;
			}

			echo '<tr>';
			echo '<td>';
			echo $rec['id'];
			// echo ' ';
			// echo '&nbsp;';
			//上記のどちらかの文を入れることで半角スペースを空けることができる
			echo '</td>';
			
			// echo $rec['area'];
			//リンク未使用

			// echo '<a href="friends.php">$rec['area']</a>';
			//リンク付け間違い例

			echo '<td>';
			echo "<a href=\"friends.php?area_id=$rec[id]\">$rec[area]</a>";
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
		//枠作成完了

		// データベースから切断
		$dbh = null;
	?>
</body>
</html>