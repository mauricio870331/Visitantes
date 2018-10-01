<?php
  if (isset($_POST['q'])){
      $q = @$_POST['q'];
      $delimiter = explode('-', $q);
      $aux =  trim($delimiter[0]);     
      $wsdl = "http://localhost:6161/WSExpal/Expal?WSDL";
        $mensaje = array("opc" => $aux);
        $cliente = new SoapClient($wsdl);
        $response = $cliente->__call('PersonasVisitada', array("parameters" => $mensaje));       
        $array = json_decode($response->return);      

      echo "<select name='personal' id='personal' style='width: 130px;font-size: 14px;'>" ;
      echo "<option value='0'>Seleccione</option>";

     for ($i = 0; $i < count($array); $i++) {
          echo "<option>", trim(utf8_decode($array[$i]->cod_seccion))." - ".trim(utf8_decode($array[$i]->desc_seccion)), "</option>";}
      echo "</select>";

      
  }

?>
