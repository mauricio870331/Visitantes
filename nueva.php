<?php
$server = '192.168.10.1';
$database = 'NodumEP';
$username = 'consulta';
$password = 'consulta';
$db = new PDO('odbc:Driver={SQL Server}; Server=' . $server . '; Database=' . $database . '; Uid=' . $username . '; Pwd=' . $password . ';');
$query = $db->prepare('select cod_sucuremp,nom_sucuremp  from ct_sucuremp');
$query->execute();
while($row = $query->fetch()){
echo $tiquete=$row['cod_sucuremp'];   
echo $origen=$row['nom_sucuremp']; 
    
}
?>