<?php

	session_start();
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	$kwota = $_POST['kwota']; 
	$data_wydatku = $_POST['data_wydatku']; 
	$kategoria_wydatku = $_POST['wydatek'];
	$komentarz = $_POST['komentarz']; 
	$sposob_platnosci = $_POST['sposob'];
	
	$user_id = $_SESSION['id'];
	$rezultat4 = $polaczenie->query("SELECT * FROM expenses_category_assigned_to_users WHERE name='$kategoria_wydatku' AND user_id='$user_id'");
	$wiersz4 = $rezultat4->fetch_assoc();
	$expense_category_assigned_to_user_id = (int)  $wiersz4['id']; 
	
	$rezultat5 = $polaczenie->query("SELECT * FROM payment_methods_assigned_to_users WHERE name='$sposob_platnosci' AND user_id='$user_id'");
	$wiersz5 = $rezultat5->fetch_assoc();	
	$payment_method_assigned_to_user_id = (int)  $wiersz5['id']; 
	
	
	$polaczenie->query ("INSERT INTO expenses VALUES (NULL, '$user_id', '$expense_category_assigned_to_user_id', '$payment_method_assigned_to_user_id', '$kwota', '$data_wydatku', '$komentarz')");
			
	$polaczenie->close();
	header('Location: sukces.php');
	
?>	