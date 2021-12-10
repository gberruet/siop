<!DOCTYPE html>
<html>
<head>
	<title>SIOP</title>
	<!-- Compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Montserrat" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="css/app.css">

  	<meta name="viewport" content="widht=device-widht, initial-scale=1.0, user-scalable=no" />
  	<meta charset="utf-8" />
</head>
<body>
	<section id="main-container">
		<div class="container">
			<div class="row">
				<div class="col s10 push-s1">
					<div class="row">
						<div class="col m5 hide-on-small-only">
							<img class="iphone" src="images/siop.png">
						</div>
						<div class="col s12 m7">
							<div class="row">
								<div class="signup-box">
									<h1 class="platzigram">SIOP</h1>
									<form class="signup-form" action="verificarLogin.php" method="POST">
										<h2>Sistema de Inventario, Obras y Proyectos</h2>
										<div class="divider"></div>
										<div class="section">
											<input type="text" name="user" placeholder="Nombre de Usuario" required=""></input>
											<input type="password" name="password" placeholder="Contraseña" required></input>
											{$msjError}
											<button class="btn waves-effect waves-light btn-signup" type="submit">Entrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col s12 l3 push-l6">
					Facultad de Arquitectura y Urbanismo - UNLP<br>
					V.13.03.19
				</div>
			</div>
		</div>
	</footer>
</body>
	<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	<!-- Compiled and minified JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</html>