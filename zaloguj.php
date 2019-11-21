<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: pierwszy-screen.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE email='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['password']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['user'] = $wiersz['username'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: main-menu.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło! Jeżeli nie posiadasz konta w serwisie, zarejestruj się.</span>';
					header('Location: pierwszy-screen.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło! Jeżeli nie posiadasz konta w serwisie, zarejestruj się.</span>';
				header('Location: pierwszy-screen.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>