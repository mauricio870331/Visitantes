<?php
  if (isset($_POST['q'])){
      $q = @$_POST['q'];
      $delimiter = explode('-', $q);
      $aux =  trim($delimiter[1]);
      $and = "";

      if ($aux == "GEST") {
          $and = " UNION SELECT c.nombre_completo, cat.descrip FROM ct_RHPersonas c ,ct_RHTrabajador trab, ct_RHCategoriaTr cat 
            where trab.cod_persona = c.cod_persona  and trab.cod_cate_tr = 128 
       and cat.cod_cate_tr = trab.cod_cate_tr and c.cod_persona = '1144054436' 
       and cat.cod_emp ='Expresop'";
      }

      if ($aux == "GERE") {
          $and = " UNION SELECT 'NAYRA SALOME PARRA MENDOZA','SECRETARIA DOCTOR JORGE'";
      }

      $server = '192.168.10.1';
      $database = 'NodumEP';
      $username = 'consulta';
      $password = 'consulta';
      $consulta = "select empleado.nombre_completo,categoria.descrip from v_RHTrabajador as empleado, ct_RHCategoriaTr as categoria
                     where empleado.cod_emp = 'Expresop' and empleado.cod_sucursal = '76892'
                     and empleado.cod_seccion ='".$aux."' and empleado.estado_trab = 'ACTIVO' and empleado.cod_cate_tr = categoria.cod_cate_tr 
                     and categoria.cod_emp ='Expresop'".$and." order by 1";

      $db = new PDO('odbc:Driver={SQL Server}; Server=' . $server . '; Database=' . $database . '; Uid=' . $username . '; Pwd=' . $password . ';');
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $query = $db->prepare($consulta);
      $query->execute();

      echo "<select name='personal' id='personal' style='width: 130px;font-size: 14px;'>" ;
      echo "<option value='0'>Seleccione</option>";

      while($row = $query->fetch()){
          echo "<option>", trim(utf8_decode($row['nombre_completo']))." - ".trim(utf8_decode($row['descrip'])), "</option>";}
      echo "</select>";

      $db=null;
  }

?>
