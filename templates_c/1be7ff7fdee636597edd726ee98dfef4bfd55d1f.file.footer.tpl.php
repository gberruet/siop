<?php /* Smarty version Smarty-3.1.15, created on 2016-11-16 19:07:01
         compiled from ".\templates\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28926582ca04508aac5-87397054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1be7ff7fdee636597edd726ee98dfef4bfd55d1f' => 
    array (
      0 => '.\\templates\\footer.tpl',
      1 => 1467675133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28926582ca04508aac5-87397054',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_582ca0450a21c5_88737444',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582ca0450a21c5_88737444')) {function content_582ca0450a21c5_88737444($_smarty_tpl) {?> <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script>
    $(document).ready(function(){
                                
        var consulta;
                                                                          
         //hacemos focus al campo de búsqueda
        //$("#busqueda").focus();
                                                                                                    
        //comprobamos si se pulsa una tecla
        $("#busqueda").keyup(function(e){
                                     
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#busqueda").val();
                                                                           
              //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){                                                    
                          $("#resultado").empty();
                          $("#resultado").append(data);
                                                             
                    }
              });
                                                                                  
                                                                           
        });
                                                                   
});
    </script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php }} ?>
