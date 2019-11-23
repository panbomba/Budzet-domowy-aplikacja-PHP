<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$kwota = $_POST['kwota']; 
	$data_przychodu = $_POST['data_przychodu']; 
	$kategoria_przychodu = $_POST['przychod'];
	$komentarz = $_POST['komentarz']; 
	
	$user_id = $_SESSION['id'];
	$rezultat3 = $polaczenie->query("SELECT * FROM incomes_category_assigned_to_users WHERE name='$kategoria_przychodu' AND user_id='$user_id'");
	$wiersz3 = $rezultat3->fetch_assoc();
	$income_category_assigned_to_user_id = (int)  $wiersz3['id']; 
	
	$polaczenie->query ("INSERT INTO incomes VALUES (NULL, '$user_id', '$income_category_assigned_to_user_id', '$kwota', '$data_przychodu', '$komentarz')");
			
	$polaczenie->close();
	header('Location: sukces.php');
	
	//informacja ze dodano pomyslnie i powrot do strony dodawania przychodu
?>	