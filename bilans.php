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
	
	//zapytanie o przychody z pomiedzy zadanych dat
	//zapytanie o wydatki z pomiedzy zadanych dat
	// roznica w bilansie plus komentarz
	
			
	$polaczenie->close();
	
?>	