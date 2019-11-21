<?php

	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: pierwszy-screen.php');
		exit();		
	}
	
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
	$login = $_POST['login'];
	$haslo = $_POST['password'];

	$sql = "SELECT * FROM users WHERE email='$login' AND password ='$haslo'"; 
	
	if($rezultat = @$polaczenie->query($sql))
	{
		$ilu_userow = $rezultat->num_rows;	
		if($ilu_userow>0)
		{
			$_SESSION['zalogowany'] = true;
			
			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['id'] = $wiersz['id'];
			$_SESSION['user'] = $wiersz['username'];
			
			unset($_SESSION['blad']);
			$rezultat->free_result(); 
			header('Location: main-menu.php');

		}
		else
		{
			$_SESSION['blad'] = '<span style="color: red">Nieprawidłowy login lub hasło! Zarejestruj się jeżeli nie posiadasz konta w serwisie.</span>';
			header('Location: pierwszy-screen.php');
		}
	}
		
	$polaczenie->close();
		
	}


	
?>

