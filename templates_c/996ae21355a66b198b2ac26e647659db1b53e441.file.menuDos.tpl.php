<?php /* Smarty version Smarty-3.1.15, created on 2016-11-16 23:00:49
         compiled from ".\templates\menuDos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25752582cd6dc85e949-71367243%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '996ae21355a66b198b2ac26e647659db1b53e441' => 
    array (
      0 => '.\\templates\\menuDos.tpl',
      1 => 1479333648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25752582cd6dc85e949-71367243',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_582cd6dc8a4e47_92461428',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582cd6dc8a4e47_92461428')) {function content_582cd6dc8a4e47_92461428($_smarty_tpl) {?><nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="inicio.php">SIOP</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="inicio.php"><img src="images/bookmark.png"> Inicio</a></li>
    </ul>
 
    <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><img src="images/mail.png"> Mensajes</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/user-29.png"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!--<li><a href="#"><img src="images/user-29.png"> Mi Perfil</a></li>
                  <li class="divider"></li>-->
                  <li><a href="logout.php"><img src="images/user-22.png">Cerrar Sesión</a></li>
                </ul>
            </li>   
            </li> 
        </ul>
  </div>
</nav><?php }} ?>
