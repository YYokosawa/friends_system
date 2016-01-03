<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>友達リスト追加</title>
</head>
<body>


	<form method="post" action="add.php">
			友達情報を入れてね！！<br />

			名前　 *必須情報
			<input name="nickname" type="text" style="width:100px"><br /><br />
			性別　 *必須情報
			<input type="radio" name="sex" value="1" checked>男
			<input type="radio" name="sex" value="2" >女
			<br /><br />
			年齢　 *必須情報
			<input name="age" type="text" style="width:50px"><br /><br />

			出身地　 *必須情報
			<!-- 都道府県選択フォーム開始 -->
			<select name="area_id">
				

					<?php
						$dsn ='mysql:dbname=tomodachi;host=localhost';
						//mysqlに接続命令：どのデータベースに接続？；データベースのあるサーバーの場所
						$user ='root';
						$password ='mysql';
						//xamppでは、指定がない場合は上記になる
						$dbh = new PDO($dsn,$user,$password);
						//$dbhによって接続
						$dbh->query('SET NAMES utf8');
						$sql = 'SELECT * FROM `area_table` WHERE 1';
						$stmt = $dbh->prepare($sql);
						$stmt->execute();
						//データベースの情報を全部入れる

							while (1) 
							{
							$rec = $stmt->fetch(PDO::FETCH_ASSOC);

								if($rec==false)
								{
									break;
								}
								echo '<option value="'.$rec['id'].'">'.$rec['area'].'</option>';

							}
							$dbh = null;

					?>
					<!-- while文でデータベースから呼び出し、繰り返し情報表示　今回は都道府県リストの呼び出し -->
 				
			</select><br /><br />
			<!-- 都道府県選択フォーム終了 -->

			趣味
			<input name="hobby" type="text" style="width:200px"><br />

			<input type="submit" value="OK!">

	</form>


	<?php
		$dsn ='mysql:dbname=tomodachi;host=localhost';
		//mysqlに接続命令：どのデータベースに接続？；データベースのあるサーバーの場所
		$user ='root';
		$password ='mysql';

		$dbh = new PDO($dsn,$user,$password);
		//$dbhによって接続
		$dbh->query('SET NAMES utf8');

		$nickname=$_POST['nickname'];
		$sex=$_POST['sex'];
		$age=$_POST['age'];
		$area_id=$_POST['area_id'];
		$hobby=$_POST['hobby'];
		

		$nickname=htmlspecialchars($nickname);
		$age=htmlspecialchars($age);
		$area_id=htmlspecialchars($area_id);
		$hobby=htmlspecialchars($hobby);

		var_dump($nickname);
		var_dump($age);
		var_dump($area_id);
		var_dump($sex);



		// XSS(クロスサイトスクリプティング)でのいたずら防止


				$sql ="INSERT INTO `tomodachi`.`friends_table`(`id`,`area_id`,`nickname`,`sex`,`age`,`hobby`,`created`)";
				$sql .="VALUES (NULL,'".$area_id."', '".$nickname."', '".$sex."', '".$age."','".$hobby."',now());";
	
				var_dump($sql);

				//テーブル名とフィールド名を``で囲うのが正解（ないと、場合によってはエラーが出る可能性もある）
				$stmt =$dbh->prepare($sql);
				//insert文を実行
				$stmt->execute();


				//データベースから切断
				$dbh = null;

				header('Location: http://'.$_SERVER['HTTP_HOST'].'/area.php');

				// echo'<br />';

				// echo $area_id.'の友達を登録しました！';

				// echo '名前';
				// echo $nickname.'<br />';
				// echo '性別';
				// echo $sex.'<br />';
				// echo '年齢';
				// echo $age.'<br />';
				// echo '趣味';
				// echo $hobby.'<br />';
				// echo '登録日';
				// echo $created.'<br />';

				// echo'<form method="post" action="friends.php">';
				// echo'<input name="nickname" type="hidden" value="'.$nickname.'">';
				// echo'<input name="email" type="hidden" value="'.$email.'">';
				// echo'<input name="goiken" type="hidden" value="'.$goiken.'">';
				// echo'<input type="button" onclick="history.back()" value="戻る">';
				// echo'<input type="submit" value="OK">';
				// echo'</form>';

			// echo '<a href="index.html"><br />戻る</a>';　戻っても入力文が消える
			// クリックしてもページを新しく開いてしまうため、当然フォームも真っ白になる
			// if($nickname=='' || $sex=='' || $age=='' || $area_id=='')
			// {
			// 	echo'<br />';
			// 	echo'未記入の必須項目があります！';
			// 	echo'<form>';
			// 	echo'<input type="button" onclick="history.back()" value="戻る">';
			// 	echo'</form>';
			// }
			// else
			// {

			// }

	?>
	<form method="post" action="">
	</form>

</body>
</html>