<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$okres = $_POST['okres'];
	$poczatek = $_POST['start'];
	$koniec = $_POST['end'];
	
	if($okres==1)
	{
		$_SESSION['data_poczatkowa'] = date("Y-m-d", strtotime("first day of this month"));
		$_SESSION['data_koncowa'] = date("Y-m-d", strtotime("today"));
	}
	if($okres==2)
	{
		$_SESSION['data_poczatkowa'] = date("Y-m-d", strtotime("first day of last month"));
		$_SESSION['data_koncowa'] = 	date("Y-m-d", strtotime("last day of last month"));	
	}
	if($okres==3)
	{
		$_SESSION['data_poczatkowa'] = date("Y-m-d", strtotime("first day of January"));
		$_SESSION['data_koncowa'] = 	date("Y-m-d", strtotime("today"));	
	}
	if($okres==4)
	{
		$_SESSION['data_poczatkowa'] = $poczatek;
		$_SESSION['data_koncowa'] = $koniec;
	}	
	
	$user_id = $_SESSION['id'];
	$data_poczatkowa = $_SESSION['data_poczatkowa'];
	$data_koncowa = $_SESSION['data_koncowa'];
	
	//przychody
	$rezultat5 = $polaczenie->query("SELECT SUM(amount) FROM incomes WHERE date_of_income BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");
	//wydatki
	$rezultat6 = $polaczenie->query("SELECT SUM(amount) FROM expenses WHERE date_of_expense BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");
	
	$_SESSION['suma_przychodow'] = array_sum($rezultat5->fetch_assoc());
	$_SESSION['suma_wydatkow'] = array_sum($rezultat6->fetch_assoc());
	
	$_SESSION['bilans'] = ($_SESSION['suma_przychodow'] - $_SESSION['suma_wydatkow']); 
	
	$polaczenie->close();
	header('Location: przegladaj-bilans.php');
	
?>	