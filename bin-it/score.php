<?php 
	/*$con = mysql_connect('localhost','goldenxi_hua01','Pgr_604');
	$db = mysql_select_db('goldenxi_html5_mini',$con);*/

	$con = mysql_connect('localhost','root','');
	$db = mysql_select_db('score',$con);

	if(!$con)
		die('Could not connect:' . mysql_error());
	
	if(isset($_REQUEST['reg_flag']) && $_REQUEST['reg_flag']==1){
		$user_name = $_REQUEST['user_name'];
		$user_score = $_REQUEST['user_score'];
		$query1 = "INSERT INTO tbl_score (user_name,user_score) VALUES ('$user_name', '$user_score')";
		mysql_query($query1);
	}
	
	if(isset($_REQUEST['board_flag']) && $_REQUEST['board_flag']==1){
		$query = 'SELECT * FROM tbl_score ORDER BY user_score DESC LIMIT 10';
		$result = mysql_query($query);

		$arr = array();
		while($row = mysql_fetch_assoc($result)){
			$arr[] = array(
				'id'	=>	$row['id'],
				'name'	=>	$row['user_name'],
				'score'	=>	$row['user_score'],
			);
		}
		echo json_encode($arr);
	}
	
	if(isset($_POST['chk_flag']) && $_POST['chk_flag']==1){
		$query = "SELECT MIN(user_score) as min_score FROM (SELECT * FROM tbl_score ORDER BY user_score DESC LIMIT 10) AS sql_1";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		echo $row[0];
	}
	mysql_close($con);
?>