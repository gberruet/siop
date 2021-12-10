<?php

// Titulo
//$smarty->assign('tituloTitle','Sistema Siop');


// Logo
//$smarty->assign('logo','<img src="images/logoFau.jpg" alt="Logo FAU" class="logo">');


/* MENU PRINCIPAL */
// HAY 5 TIPOS DE MENU DIFERENTE QUE VARIA SEGUN EL PRIVILEGIO QUE TENGA EL USUARIO EN EL SISTEMA

// (1) MENU SUPER ADMINISTRADOR
$smarty->assign('menuAdministrador',
'<ul id="menu">
<nav class="navbar navbar-default" role="navigation">
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
    <a class="navbar-brand" href="#">SIOP</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Inicio</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Administración<b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="agregarUsuario.php">Agregar Usuario</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Informes <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Aulas</a></li>
          <li><a href="#">Pabellones</a></li>
          <li><a href="#">Notas</a></li>
          <li class="divider"></li>
          <li><a href="#">Facturaci&oacute;n</a></li>
          <li class="divider"></li>
          <li><a href="#">Calendario</a></li>
        </ul>
      </li>
    </ul>
 
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Buscar">
      </div>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Mensajes</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Usuario <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Mi Perfil</a></li>
          <li class="divider"></li>
          <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>');
/* ---------------------------------------------------------------------------------------------- */

$anioActual= date("Y");

// Footer
//$smarty->assign('footer','Facultad de Arquitectura y Urbanismo | La Plata | Buenos Aires <br> &copy; '.$anioActual.' Dise&ntilde;o y Programaci&oacute;n: Literalist Web<br>V.10.03.16');
?>