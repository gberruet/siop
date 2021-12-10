<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
</nav>