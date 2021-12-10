<?php /* Smarty version Smarty-3.1.15, created on 2019-03-13 22:50:35
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190485c89893b6925a9-58806613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1552516900,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190485c89893b6925a9-58806613',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msjError' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5c89893b7a8047_41050775',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c89893b7a8047_41050775')) {function content_5c89893b7a8047_41050775($_smarty_tpl) {?><!DOCTYPE html>
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
											<?php echo $_smarty_tpl->tpl_vars['msjError']->value;?>

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
					V.25.03.18
				</div>
			</div>
		</div>
	</footer>
</body>
	<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	<!-- Compiled and minified JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</html><?php }} ?>
