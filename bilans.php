<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$okres = $_POST['okres'];
	if($_POST['okres'] == 0)
	{
		$okres = $_SESSION['opcja_domyslna'];
	}
	
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
	
	$_SESSION['przychody_tablica']=array(array('Task','Hours per Day'));

	while ($wiersz7 = $rezultat7->fetch_assoc())
	{
		$numer_kategori_przychodow = (int)$wiersz7['income_category_assigned_to_user_id'];
		$kategoria = $polaczenie->query("SELECT * FROM incomes_category_assigned_to_users WHERE id = '$numer_kategori_przychodow' AND user_id = '$user_id'");
		$wiersz9 = $kategoria->fetch_assoc();
		$kategorie_przychodow= '<b>'.$wiersz9['name'].' : </b>'.$wiersz7['SUM(amount)'].'<br>';
		$_SESSION['przychody_kategorie']  .=$kategorie_przychodow;	
		array_push($_SESSION['przychody_tablica'],$wiersz9['name'],$wiersz7['SUM(amount)']);	
	}
	
//print_r($_SESSION['przychody_tablica']);
echo $_SESSION['przychody_tablica'][0][1];
echo '<br>';
echo $_SESSION['przychody_tablica'][0][0];
echo '<br>';
echo $_SESSION['przychody_tablica'][1][0];
echo '<br>';
echo $_SESSION['przychody_tablica'][1][1];
echo '<br>';
print_r($_SESSION['przychody_tablica']);
	
	while ($wiersz8 = $rezultat8->fetch_assoc())
	{
		$numer_kategori_wydatkow = (int)$wiersz8['expense_category_assigned_to_user_id'];
		$kategoria = $polaczenie->query("SELECT * FROM expenses_category_assigned_to_users WHERE id = '$numer_kategori_wydatkow' AND user_id = '$user_id'");
		$wiersz10 = $kategoria->fetch_assoc();
		$kategorie_wydatkow= '<b>'.$wiersz10['name'].' : </b>'.$wiersz8['SUM(amount)'].'<br>';
		$_SESSION['wydatki_kategorie']  .=$kategorie_wydatkow;	
	}
	
	
	
	$polaczenie->close();
	header('Location: przegladaj-bilans.php');
	
?>	