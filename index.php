<?php

	session_start();
	
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: main-menu.php');
		exit();
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
	<link rel="stylesheet" href="style3.css"> 
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

			</div>	
		</nav>
		
				
		<main>
				<div class="logowanie" style="margin-bottom: 30px;">
					<article>
									<a href="logowanie.php"><input type="button" style="background-color: #5cb85c; color: white" value="Zaloguj się!"></a>
					</article>	
					<article>
									<br>
									<a href="rejestracja.php"><input type="button" style="background-color: #FF8800; color: white" value="Rejestracja"></a>
					</article>
						<?php
							if(isset($_SESSION['blad']))
							{
								echo $_SESSION['blad'];
							}	
						?>
				</div>	
				
				<div class="artykul-main">
					<article>
						<h2><b>Zaprowadź porządek w swoich finansach!</h2>
						<br>
						<h4><b>Czy wiesz, że...?</b></h4>
						<div>
						<br>
						<li>Paląc paczkę papierosów dziennie, puszczasz z dymem około 6000 PLN rocznie!</li><br>
						<li>Kubek kawy na wynos pięć razy w tygodniu to koszt okolo 150-200 PLN w miesiącu. Dla większości z nas, jest to wciąż spory procent przychodu. </li><br>
						<li>Bywa, że płacimy regularnie za subskrypcje usług, z których nie korzystamy.</li><br>
						<li>Mobilny internet bez limitu może kosztować 40 PLN na miesiąc. Może też  kosztować dwa razy więcej - tylko po co?</li><br>
						<li>Czeka na Ciebie nagroda pieniężna, jeżeli prześlesz na naszego emaila zdjęcie Billa Gatesa noszącego pasek Gucci! ;)</li></b>
						</div>
					</article>
					<article>
						<p><br>
	Oczywiście nie chodzi o to, żeby w życiu odmawiać sobie mniejszych lub większych przyjemności. Zawsze jednak warto być świadomym konsumentem i mieć swoje finanse pod kontrolą. Jeżeli borykasz się z ciągłym brakiem gotówki lub długami ten serwis jest miejscem dla Ciebie! Jeżeli natomiast uważasz, że radzisz sobie świetnie - zostań i spróbuj coś jeszcze zoptymalizować - satysfakcja gwarantowana!
	<br><br>
Czasami wystarczy spojrzenie na zestawienie swoich przychodów i wydatków w danym okresie,  aby dojść do zaskakujących wniosków. Misją aplikacji jest, aby przeprowadzone przez Ciebie analizy, zaowocowały systematycznym zwiększaniem poziomu Twoich oszczędności, pomogły wyrobić dobre nawyki związane z pieniędzmi oraz porzucić te złe, których może nie jesteś jeszcze świadomy. <b>ZAPRASZAMY!</b>
						</p>
					</article>
				</div>				
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