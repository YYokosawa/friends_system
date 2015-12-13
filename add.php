<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>友達リスト追加</title>
</head>
<body>


	<form method="post" action="add.php">
			<h2>友達情報を入れてね！！</h2><br /><br />

			<h3>名前　*必須情報</h3>
			<input name="code" type="text" style="width:100px"><br />
			<h3>性別　*必須情報</h3>
			<input type="radio" name="sex" value="1" checked>男
			<input type="radio" name="sex" value="2" >女
			<br />
			<h3>年齢　*必須情報</h3>
			<input name="code" type="text" style="width:50px"><br />

			<h3>出身地　*必須情報</h3>
			<select name="area_id">
				<!-- 	<option value="0" selected>選択して下さい</option>
					<option value="1">北海道</option>
					<option value="2">青森県</option>
					<option value="3">岩手県</option>
					<option value="4">宮城県</option>
					<option value="5">秋田県</option>
					<option value="6">山形県</option>
					<option value="7">福島県</option>
					<option value="8">茨城県</option>
					<option value="9">栃木県</option>
					<option value="10">群馬県</option>
					<option value="11">埼玉県</option>
					<option value="12">千葉県</option>
					<option value="13">東京都</option>
					<option value="14">神奈川県</option>
					<option value="15">新潟県</option>
					<option value="16">富山県</option>
					<option value="17">石川県</option>
					<option value="18">福井県</option>
					<option value="19">山梨県</option>
					<option value="20">長野県</option>
					<option value="21">岐阜県</option>
					<option value="22">静岡県</option>
					<option value="23">愛知県</option>
					<option value="24">三重県</option>
					<option value="25">滋賀県</option>
					<option value="26">京都府</option>
					<option value="27">大阪府</option>
					<option value="28">兵庫県</option>
					<option value="29">奈良県</option>
					<option value="30">和歌山県</option>
					<option value="31">鳥取県</option>
					<option value="32">島根県</option>
					<option value="33">岡山県</option>
					<option value="34">広島県</option>
					<option value="35">山口県</option>
					<option value="36">徳島県</option>
					<option value="37">香川県</option>
					<option value="38">愛媛県</option>
					<option value="39">高知県</option>
					<option value="40">福岡県</option>
					<option value="41">佐賀県</option>
					<option value="42">長崎県</option>
					<option value="43">熊本県</option>
					<option value="44">大分県</option>
					<option value="45">宮崎県</option>
					<option value="46">鹿児島県</option>
					<option value="47">沖縄県</option>

					手書きでの選択フォームの入力の場合
 -->
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
 				
			</select><br />
			<!-- 都道府県選択フォーム終了 -->

			<h3>趣味</h3>
			<input name="code" type="text" style="width:200px"><br />
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

		// XSS(クロスサイトスクリプティング)でのいたずら防止


			// echo '<a href="index.html"><br />戻る</a>';　戻っても入力文が消える
			// クリックしてもページを新しく開いてしまうため、当然フォームも真っ白になる
			if($nickname=='' || $sex=='' || $age=='' || $area_id=='')
			{
				echo'<br />';
				echo'未記入の必須項目があります！';
				echo'<form>';
				echo'<input type="button" onclick="history.back()" value="戻る">';
				echo'</form>';
			}
			else
			{
				echo'<br />';

				echo $area_id.'の友達を登録しました！';

				echo '名前';
				echo $nickname.'<br />';
				echo '性別';
				echo $sex.'<br />';
				echo '年齢';
				echo $age.'<br />';
				echo '趣味';
				echo $hobby.'<br />';
				echo '登録日';
				echo $created.'<br />';

				// echo'<form method="post" action="friends.php">';
				// echo'<input name="nickname" type="hidden" value="'.$nickname.'">';
				// echo'<input name="email" type="hidden" value="'.$email.'">';
				// echo'<input name="goiken" type="hidden" value="'.$goiken.'">';
				echo'<input type="button" onclick="history.back()" value="戻る">';
				echo"<a href=\"friends.php?area_id=$rec[area_id]\"><input type="submit" value="OK"></a>";
				// echo'</form>';
			}





			


		$sql ='INSERT INTO `frinends_table`(`area_id`,`nickname`,`sex`,`age`,`hobby`,`created`)VALUES("'.$area_id.'","'.$nickname.'","'.$sex.'","'.$age.'","'.$hobby.'",now())';
		//var_dump($sql);

		//テーブル名とフィールド名を``で囲うのが正解（ないと、場合によってはエラーが出る可能性もある）
		$stmt =$dbh->prepare($sql);
		//insert文を実行
		$stmt->execute();

		//データベースから切断
		$dbh = null;


	?>
	<?php
			if (isset($_POST['moji'])){
				//echo 'hello!'.$_POST['moji']; //関数未使用時表示
				echo hello($_POST['moji']);
			}

			//引数として渡された文字の頭にhello!をつけて
			//返り値として渡してあげる関数を作成（定義）せよ
			//関数名はhelloにして下さい

			function hello($moji){
				return 'hello'.$moji;	//関数使用時表示	
			}
		?>

		<a href="add.php"><input type="submit" value="OK!"></a>
</body>
</html>