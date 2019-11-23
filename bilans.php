<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$okres = $_POST['okres']; 
	if($okres==1)
	{
		$data_poczatkowa = date("Y-m-d", strtotime("first day of this month"));
		$data_koncowa = date("Y-m-d", strtotime("today"));
	}
	if($okres==2)
	{
		$data_poczatkowa = date("Y-m-d", strtotime("first day of last month"));
		$data_koncowa = 	date("Y-m-d", strtotime("last day of last month"));	
	}
	if($okres==3)
	{
		$data_poczatkowa = date("Y-m-d", strtotime("first day of January"));
		$data_koncowa = 	date("Y-m-d", strtotime("today"));	
	}
	if($okres==4)
	{
		;
	}	
	
	$user_id = $_SESSION['id'];
	
	//przychody
	$rezultat5 = $polaczenie->query("SELECT SUM(amount) FROM incomes WHERE date_of_income BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");
	//wydatki
	$rezultat6 = $polaczenie->query("SELECT SUM(amount) FROM expenses WHERE date_of_expense BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");
	
	$_SESSION['suma_przychodow'] = array_sum($rezultat5->fetch_assoc());
	$_SESSION['suma_wydatkow'] = array_sum($rezultat6->fetch_assoc());
	
	$_SESSION['bilans'] = abs($_SESSION['suma_przychodow'] - $_SESSION['suma_wydatkow']); 
	
	// wszystko wydarzy sie na tej stronie i zostanie odeslane do strony z bilansem
	
			
	$polaczenie->close();
	header('Location: przegladaj-bilans.php');
	
?>	