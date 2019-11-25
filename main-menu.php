<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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
			<div id="cytat">Internetowa aplikacja do zarządzania finansami!</div>
		</div>
	</header>
	
		<nav class="navbar navbar-expand-md bg-wlasne navbar-dark justify-content-center">
		  <div class="container-fluid">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
						<span class="navbar-toggler-icon "></span>
					</button>
					
					<div class="collapse navbar-collapse justify-content-center" id="mainmenu">
						<ul class="navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" href="main-menu.php"><i class="icon-menu-outline"></i>Start  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="dodaj-przychod.php"><i class="icon-money-1"></i>Dodaj Przychód  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="dodaj-wydatek.php"><i class="icon-shopping-bag"></i>Dodaj Wydatek  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="przegladaj-bilans.php"><i class="icon-chart-line"></i>Bilans  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="ustawienia.php"><i class="icon-cogs"></i>Ustawienia  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link"><span style="color: #5cb85c"><i class="icon-user-1"></i>
									<?php
										echo $_SESSION['user'];
									?></span>
								</a>
							</li>							
							<li class="nav-item">
								<a class="nav-link" href="wyloguj.php"><i class="icon-logout"></i>Wyloguj się   </a> 
							</li>
						</ul>
					</div>
			</div>	
		</nav>
		
		<main>
			<section>
				<div class="artykul-main">
					<article>
						<h1>Tutaj jakis artykul wprowadzajacy albo porady</h1>
							<p> 
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vel ligula sed metus luctus lobortis. Aliquam porta neque eu diam tristique, ac eleifend eros tempus. Maecenas rutrum velit eget turpis bibendum ullamcorper eget sit amet lectus. Integer id varius mi, fermentum dignissim lorem. Praesent vitae nisi eu est condimentum eleifend nec ut est. Duis vel ante vitae ex tristique accumsan. Mauris massa turpis, facilisis sed ultrices at, fermentum et arcu. Donec interdum ac lectus eu convallis.

							Nullam vehicula mauris tortor, vitae varius augue dignissim vitae. Donec ex libero, imperdiet in porta et, rutrum faucibus ligula. Vestibulum placerat quis erat tempus ullamcorper. Aenean eget metus et augue dictum iaculis. Nullam eu turpis ornare, venenatis orci vitae, posuere arcu. Vivamus nunc felis, rutrum vitae elementum id, viverra tempus felis. Phasellus elit diam, congue ut urna quis, tristique semper nunc. Sed tempor erat a interdum viverra. Proin ut posuere mauris, ac pharetra massa. In tincidunt justo eu enim interdum, sed euismod diam dignissim. Cras bibendum venenatis est ut luctus. Maecenas odio eros, aliquam id orci vel, lacinia venenatis odio. 
							</p>
					</article>	
					<article>
						<h1> Tutaj w artykule jakas grafika albo zdjecie</h1>
							<p> 
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vel ligula sed metus luctus lobortis. Aliquam porta neque eu diam tristique, ac eleifend eros tempus. Maecenas rutrum velit eget turpis bibendum ullamcorper eget sit amet lectus. Integer id varius mi, fermentum dignissim lorem. Praesent vitae nisi eu est condimentum eleifend nec ut est. Duis vel ante vitae ex tristique accumsan. Mauris massa turpis, facilisis sed ultrices at, fermentum et arcu. Donec interdum ac lectus eu convallis.
							</p>
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