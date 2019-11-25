<?php

	session_start();
	
	if(isset($_POST['email']))
	{
		$wszystko_OK=true;
		
		$username = $_POST['username'];
		
		if ((strlen($username)<3) || (strlen($username)>50))
		{
			$wszystko_OK=false;
			$_SESSION['e_username']="Nazwa użytkownika powinna zawierać pomiędzy  3 a 50 znaków!";
		}
		
		//if(ctype_alnum($username)==false)
		//{
		//	$wszystko_OK=false;
		//	$_SESSION['e_username']="Nazwa użytkownika powinna sie składać tylko z liter i cyfr";
		//}		
		
		$email = $_POST['email'];
		$emailsafe = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($emailsafe, FILTER_VALIDATE_EMAIL)==false) || ($emailsafe!=$email))
		{
			$wszystko_OK=false;	
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";			
		}
		
		$haslo1 = $_POST['password'];
		$haslo2 = $_POST['password2'];
		
		if((strlen($haslo1)<8) || (strlen($haslo1)>255))
		{
			$wszystko_OK=false;	
			$_SESSION['e_password']="Hasło powinno mieć conajmniej 8 znaków!";					
		}
		
		if($haslo1!=$haslo2)
		{
			$wszystko_OK=false;	
			$_SESSION['e_password']="Podane hasła są różne!";						
		}
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//zabezpieczenie przed duplikacja loginu
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//sprawdzenie bazy
				$rezultat = $polaczenie->query("SELECT * FROM users WHERE email='$email'");
				$wiersz = $rezultat->fetch_assoc();
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;	
					$_SESSION['e_email']="Uzytkownik o takim adresie email jest juz zarejestrowany!";						
				}
				if($wszystko_OK==true)
				{
					//wszystkie testy sie powiodly
					//echo "Udana walidacja!"; exit();
					
					if(($polaczenie->query("INSERT INTO users VALUES (NULL, '$username', '$haslo_hash', '$email')"))) 
					{
						$rezultat2 = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
						$wiersz2 = $rezultat2->fetch_assoc();
						$new_user_id = (int) $wiersz2['id'];
						$polaczenie->query ("INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT  '$new_user_id' AS user_id, `name` FROM expenses_category_default");
						$polaczenie->query ("INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT  '$new_user_id' AS user_id, `name` FROM incomes_category_default");
						$polaczenie->query ("INSERT INTO payment_methods_assigned_to_users (user_id, name) SELECT  '$new_user_id' AS user_id, `name` FROM payment_methods_default");
						$_SESSION['udanarejestracja']=true;
						
						header('Location: logowanie.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color: red;">Błąd serwera!</span>';
			//echo '<br>Informacja dev: '.$e;
		}		
	}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<title>***Ogarnij swoje finanse! Prosta w obsłudze aplikacja internetowa pomagająca kontrolować Twoje przychody i wydatki!***</title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="*Aplikacja internetowa moje finanse*" />
	<meta name="keywords" content="budżet, finanse, pieniądze" />
	<meta http-equiv="X-UA-Compatible"  content="IE=edge" />
	<meta name="author" content="Maciej Bombik" />
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css"> 
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:700,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

	<header>
		<div id="logo-strony">
			moje finan$e<i class="icon-money"></i>
				<br>
			<div id="cytat"><i>Internetowa aplikacja do zarządzania finansami!</i></div>
		</div>
	</header>
	
		<nav class="navbar navbar-expand-md bg-wlasne navbar-dark justify-content-center">
		  <div class="container-fluid">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
						<span class="navbar-toggler-icon "></span>
					</button>
					
					<div class="collapse navbar-collapse justify-content-center" id="mainmenu">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-menu-outline"></i>Start  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-money-1"></i>Dodaj Przychód  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-shopping-bag"></i>Dodaj Wydatek  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-chart-line"></i>Bilans  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-cogs"></i>Ustawienia  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#"><i class="icon-logout"></i>Wyloguj się   </a> 
							</li>
						</ul>
					</div>
			</div>	
		</nav>
		
			<section>
				<div class="logowanie">
					<article>
						<p> <span style="color: tomato">Opcje menu dostępne są dla zalogowanych użytkowników. </span></p>
					</article>
				</div>		
			</section>
		
		<main>
			<section>
				<div class="rejestracja">
					<article>
						<h1>Rejestracja</h1>
							<form action="rejestracja.php" method="post">
								Imię <br>
								<input type="text" name="username">
								<?php
								
									if (isset($_SESSION['e_username']))
									{
										echo '<div><span style="color: tomato">'.$_SESSION['e_username'].'</span></div>';
										unset($_SESSION['e_username']);
									}
								
								?>
								<br><br>
								e-mail <br>
								<input type="email" name="email">
								<?php
								
									if (isset($_SESSION['e_email']))
									{
										echo '<div><span style="color: tomato">'.$_SESSION['e_email'].'</span></div>';
										unset($_SESSION['e_email']);
									}
								
								?>								
								<br><br>
								Hasło <br>
								<input type="password" name="password">
								<?php
								
									if (isset($_SESSION['e_password']))
									{
										echo '<div><span style="color: tomato">'.$_SESSION['e_password'].'</span></div>';
										unset($_SESSION['e_password']);
									}
								
								?>									
								<br><br>
								Powtórz hasło <br>
								<input type="password" name="password2">
								<br><br>								
								<input type="submit" style="background-color: #5cb85c; color: white" value="Zarejestruj się!">
								<br><br>		
								<a href="index.php"><input type="button" style="color: black" value="Powrót"></a>
							</form>								
					</article>	
				</div>
			</section>
		</main>
		
		<footer class="fixed-bottom">
				<div id="stopka">
					moje finan$e<i class="icon-money"></i> 2019 &copy; Maciej Bombik  <i class="icon-mail-alt"></i> maciej.bombik.programista@gmail.com
				</div>
		</footer>	
		
		
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>		


</body>