<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if((!isset($_SESSION['data_poczatkowa'])) && (!isset($_SESSION['data_poczatkowa'])))
	{
				$_SESSION['opcja_domyslna'] = 1;
				header('Location: bilans.php');		
	}
	
	
	

	//unset($_SESSION['data_koncowa']);
	//unset($_SESSION['data_poczatkowa']);
	//unset($_SESSION['suma_wydatkow']);	
	
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
	<link rel="stylesheet" href="style2.css"> 	
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
								<a class="nav-link" href="main-menu.php"><i class="icon-menu-outline"></i>Start  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="dodaj-przychod.php"><i class="icon-money-1"></i>Dodaj Przychód  </a> 
							</li>
							<li class="nav-item">
								<a class="nav-link" href="dodaj-wydatek.php"><i class="icon-shopping-bag"></i>Dodaj Wydatek  </a> 
							</li>
							<li class="nav-item active">
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
			<section class="artykul-main-bilans">
				<div class="container">
					<h1>Przegladaj bilans</h1><br>

						<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Wybierz okres
								</button>
							 <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							 <form action="bilans.php" method="post">
								<button class="dropdown-item" type="submit" name="okres" value="1">Bieżący miesiąc</button>
								<button class="dropdown-item" type="submit" name="okres" value="2">Poprzedni miesiąc</button>
								<button class="dropdown-item" type="submit" name="okres" value="3">Bieżący rok</button>
								<button class="dropdown-item btn btn-primary" type="button" name="okres" data-toggle="modal" data-target="#modal-daty">Okres niestandardowy</button>
								</form>
							 </div>
						</div>

<!-- Modal -->
						<div class="modal fade" id="modal-daty" tabindex="-1" role="dialog" aria-labelledby="modal-daty" aria-hidden="true">
							 <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Wybierz daty</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
								  </div>
								  <form action="bilans.php" method="post">
								  <div class="modal-body">
										<label>Data początkowa <input type="date" name="start"  value="YYYY-MM-DD"></label>
										<label>Data końcowa <input type="date" name="end"  value="YYYY-MM-DD"></label>
								  </div>								  
								  <div class="modal-footer">								  
									<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
									<button type="submit" value="4" name="okres" class="btn btn-success">Wybierz</button>
									</form>
								</div>
								</div>
							 </div>
						</div>
						
			<div>	<br>	
				<div class="row">			
					<div class="col-md-6">
						<div class = "tile1">
						<h4><b>Przychody</b></h4>
							<p>
							
							<?php
							
							if(isset($_SESSION['data_poczatkowa']))
							{
								echo 'Od: '.$_SESSION['data_poczatkowa'];
							}
							if(isset($_SESSION['data_koncowa']))
							{
								echo '<br>Do: '.$_SESSION['data_koncowa'];
							}
							if(isset($_SESSION['przychody_kategorie']))
							{
								echo  '<br><br>'.$_SESSION['przychody_kategorie'];
								unset ($_SESSION['przychody_kategorie']);
							}			
							if(isset($_SESSION['suma_przychodow']))
							{
								echo  '<br><br><b>'.number_format($_SESSION['suma_przychodow'], 2).'</b>';
								unset ($_SESSION['suma_przychodow']);
							}
							?>							
							</p>
							
						</div>
					</div>
					<div class="col-md-6">
						<div class = "tile1">
						<h4><b>Wydatki</b></h4> 
							<p>
							<?php
							if(isset($_SESSION['data_poczatkowa']))
							{
								echo 'Od: '.$_SESSION['data_poczatkowa'];
							}
							if(isset($_SESSION['data_koncowa']))
							{
								echo '<br>Do: '.$_SESSION['data_koncowa'];
							}
							if(isset($_SESSION['wydatki_kategorie']))
							{
								echo  '<br><br>'.$_SESSION['wydatki_kategorie'];
								unset ($_SESSION['wydatki_kategorie']);
							}								
							if(isset($_SESSION['suma_wydatkow']))
							{
								echo  '<br><br><b>'.number_format($_SESSION['suma_wydatkow'], 2).'</b>';
								unset ($_SESSION['suma_wydatkow']);
							}
							unset ($_SESSION['data_poczatkowa']);
							unset ($_SESSION['data_koncowa']);							
							?>
							</p>
														<div id="piechart" align="center"></div>
														<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
														<script type="text/javascript">
														google.charts.load('current', {'packages':['corechart']});
														google.charts.setOnLoadCallback(drawChart);
														function drawChart() {
														  var data = google.visualization.arrayToDataTable([
															['Kategoria', 'Kwota'],
															<?php																						
																	$dlugosc = count($_SESSION['wydatki_tablica']);
																	for($i=1; $i<=$dlugosc-1; $i++)
																	{
																		echo"['".$_SESSION['wydatki_tablica'][$i]."', ".$_SESSION['wydatki_tablica'][$i+1]."],";
																	$i++;
																	}														
															?>
														]);
														  var options = {'title':'', 'width':300, 'height':250};
														  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
														  chart.draw(data, options);
														}
														</script>														
						</div>
					</div>
						
					<div class="col-sm-12">
						<div class = "tile2">
						<h4><b>Podsumowanie</b></h4>
							<p>
							<?php
							if(isset($_SESSION['bilans']))
							{
							if($_SESSION['bilans'] >= 0)
							{
								echo  '<br><b><span style="color: #5cb85c">+'.number_format($_SESSION['bilans'], 2).'</span></b>';
								echo '<br><span style="color: #5cb85c">Gratulacje. Świetnie zarządzasz finansami!</span>';
							}
							if($_SESSION['bilans'] < 0)
							{
								echo  '<br><b><span style="color: red">'.number_format($_SESSION['bilans'], 2).'</span></b>';
								echo '<br><span style="color: red">Uważaj, wpadasz w długi!</span>';
							}		
								unset ($_SESSION['bilans']);
							}		
							unset ($_SESSION['data_poczatkowa']);
							unset ($_SESSION['data_koncowa']);							
							?>							
							</p>
						</div>
					</div>
				</div>	
			</div>	
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