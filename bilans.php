<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$okres = $_POST['okres'];
	
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
		$poczatek = $_POST['start'];
		$koniec = $_POST['end'];
		$_SESSION['data_poczatkowa'] = $poczatek;
		$_SESSION['data_koncowa'] = $koniec;
	}	
	
	$user_id = $_SESSION['id'];
	$data_poczatkowa = $_SESSION['data_poczatkowa'];
	$data_koncowa = $_SESSION['data_koncowa'];
	
	//przychody suma
	$rezultat5 = $polaczenie->query("SELECT SUM(amount) FROM incomes WHERE date_of_income BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");
	//wydatki suma
	$rezultat6 = $polaczenie->query("SELECT SUM(amount) FROM expenses WHERE date_of_expense BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id'");

	$_SESSION['suma_przychodow'] = array_sum($rezultat5->fetch_assoc());
	$_SESSION['suma_wydatkow'] = array_sum($rezultat6->fetch_assoc());
	$_SESSION['bilans'] = ($_SESSION['suma_przychodow'] - $_SESSION['suma_wydatkow']); 
	
	//przychody kategorie
	$rezultat7 = $polaczenie->query("SELECT *, SUM(amount) FROM incomes WHERE date_of_income BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id' GROUP BY income_category_assigned_to_user_id");
	//wydatki kategorie
	$rezultat8 = $polaczenie->query("SELECT *, SUM(amount) FROM expenses WHERE date_of_expense BETWEEN '$data_poczatkowa' AND '$data_koncowa' AND user_id = '$user_id' GROUP BY expense_category_assigned_to_user_id");
	
	while ($wiersz7 = $rezultat7->fetch_assoc())
	{
		$kategorie_przychodow= '<b>'.$wiersz7['income_category_assigned_to_user_id'].' : </b>'.$wiersz7['amount'].'<br>';
		$_SESSION['przychody_kategorie']  .=$kategorie_przychodow;	
	}
	
	while ($wiersz8 = $rezultat8->fetch_assoc())
	{
		$kategorie_wydatkow= '<b>'.$wiersz8['expense_category_assigned_to_user_id'].' : </b>'.$wiersz8['amount'].'<br>';
		$_SESSION['wydatki_kategorie']  .=$kategorie_wydatkow;	
	}
	
	
	
	$polaczenie->close();
	header('Location: przegladaj-bilans.php');
	
?>	