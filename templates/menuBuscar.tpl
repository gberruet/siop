    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <!-- El logotipo y el icono que despliega el menú se agrupan
           para mostrarlos mejor en los dispositivos móviles -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Desplegar navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
     
      <!-- Agrupar los enlaces de navegación, los formularios y cualquier
           otro elemento que se pueda ocultar al minimizar la barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-left">
          <li style="padding-right: 0px;"><a href="inicio.php"><img src="images/bookmark.png">Inicio</a></li>
          <li style="padding-right: 0px"><a href="agregarPuesto.php"><img src="images/file.png">Agregar Nuevo</a></li>
          <li style="padding-right: 0px"><a href="agregarUsuario.php"><img src="images/user-40.png">Usuarios</a></li>
          <li style="padding-right: 0px"><a href="abmEdificio.php"><img src="images/archive.png">Edificios</a></li>
          <li style="padding-right: 0px"><a href="abmSector.php"><img src="images/archive.png">Sectores</a></li>
          <li style="padding-right: 0px"><a href="abmPuesto.php"><img src="images/archive.png">Puestos</a></li>
          <li><a href="calendario" target="_blank"><img src="images/calendario.png"></i>Calendario</a></li>
          <div class="col-xs-2" style="padding-top: 10px;"><input type="text" id="busqueda" class="form-control" placeholder="Buscar..."></div>
        </ul>

        <!-- BOTÓN MENSAJES Y PERFIL -->
        <ul class="nav navbar-nav navbar-right">
          <!--<li><a href="#"><img src="images/mail.png">Mensajes</a></li>-->
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/user-29.png"><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!--<li><a href="#"><img src="images/user-29.png">Mi Perfil</a></li>
                <li class="divider"></li>-->
                <li><a href="logout.php"><img src="images/user-22.png">Cerrar Sesión</a></li>
              </ul>
            </li>   
          </li> 
        </ul>

        <!-- SELECTS PARA FILTRO --> 
        <form class="navbar-form navbar-left" enctype="multipart/form-data" action="filtro.php" method="POST" >  
          <table>
            <tr>
              <td class="success" colspan="23">
                <select name="edificio" class="form-control" required>
                  <option value="">--SELECCIONAR EDIFICIO--</option>
                  {foreach item=item from=$datosEdificios}
                    <option value="{$item.idEdificio}">{$item.idEdificio} - {$item.nombre}</option>
                  {/foreach}
                </select>
              </td>
              <td class="warning" colspan="23">
                <select name="sector" class="form-control">
                  <option value="">--SELECCIONAR SECTOR--</option>
                  {foreach item=item from=$datosSectores}
                    <option value="{$item.idSector}">{$item.idSector} - {$item.nombre}</option>
                  {/foreach}
                </select>
              </td>
              <td class="danger" colspan="23">
                <select name="puesto" class="form-control">
                  <option value="">--SELECCIONAR PUESTO--</option>
                  {foreach item=item from=$datosPuestos}
                    <option value="{$item.idPuesto}">{$item.idPuesto} - {$item.nombre}</option>
                  {/foreach}
                </select>
              </td>
              <td>
                <div>
                  <button type="submit" class="btn btn-primary navbar-btn">Filtrar</button>
                </div>
              </td>
            </tr>
          </table>  
       </form>      
      </div>
    </nav>