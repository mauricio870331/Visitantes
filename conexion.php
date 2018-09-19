<?php
$server = '192.168.10.1';
           // Connect to MSSQL
       		  $link = mssql_connect($server, 'consulta', 'consulta');

          mssql_select_db("NodumEP",$link);
		   mssql_close($link);

?>