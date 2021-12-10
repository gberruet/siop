<?php
 
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
            $con = mysql_connect('localhost','sacap', 'sacconpos');
            mysql_select_db('aulas', $con);
       
            $sql = mysql_query("SELECT * FROM mrbs_datosgenerales WHERE nombre LIKE '%".$b."%'",$con);
             
            $contar = mysql_num_rows($sql);
             
            if($contar == 0){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{
                  while($row=mysql_fetch_array($sql)){
                        $nombre = $row['nombre'];
                        $id = $row['idLocal'];
                         
                        echo '<a href=datos_generales.php?id='.$row[3].'>'.$row[0].'.'.$row[1].'.'.$row[2].'.'.$row[4].'</a><br>';    
                  }
            }
      }
       
?>