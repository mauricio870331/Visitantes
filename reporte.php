<?php
//session_start();
include ('funciones.php');
//uso de la funcion verificar_usuario()
if (verificar_usuario()){
	//si el usuario es verificado puede acceder al contenido permitido a el
	//echo "$_SESSION[usuario]<br/>";
	$nombre_usuario= @$_SESSION[usuario];

	//print "Desconectarse <a href='salir.php'/>aqui</a>";
} else {
	//si el usuario no es verificado volvera al formulario de ingreso
	header('Location:index.html');
	}
	

$cedula = $_SESSION['cedula'];
include ("funciones_mysql.php");

$conexion = new Conexion('visitantes');

	$sql = "select d.fecha fecha, 
	d.hora_ingreso hora_ingreso,
	v.apellido apellido,
	v.nombre nombre, 
	v.cedula cedula, 
	d.computador computador,
	d.video_bean video_bean, 
	d.maletin maletin, 
	d.celular celular, 
	d.cargo cargo,
	d.persona_visitada persona_visitada,
	d.motivo_visita motivo_visita, 
	d.otro otro 
	from tbl_detalle as d INNER JOIN  tbl_visitante as v ON d.cedula_visitante = v.cedula
   where d.cedula_visitante='".$cedula."' and hora_salida is null order by d.id desc limit 1 ";
   
	$resultado = $conexion->findAll2($sql);

	if (count($resultado)!=0){
	
	foreach($resultado as $valor){
	
	  $hora_ingreso = $valor->hora_ingreso;
	  $fecha = $valor->fecha;
      $nombre = $valor->nombre;
	  $apellido = utf8_decode($valor->apellido);
	  $cedula = $valor->cedula;
	  $cargo = $valor->cargo;
	  $persona_visitada = $valor->persona_visitada;
	  $dependencia = $valor->motivo_visita;
	  $computador = $valor->computador;
	  $video_bean = $valor->video_bean;
	  $maletin = $valor->maletin; 
	  $celular = $valor->celular;
	  $otro = $valor->otro;
	 
	}
	}
	date_default_timezone_set('America/Bogota');
	$ano = date("Y", strtotime($fecha)); 
	$mes = date("m", strtotime($fecha)); 
	$dia = date("d", strtotime($fecha)); 

$nombre_apellido = $nombre." ".$apellido;

$aux = explode("-",trim($dependencia));


	
	//echo $cargo;die;
	
$sql2 = "SELECT MAX(id) id FROM tbl_detalle";
$resultado2 = $conexion->findAll2($sql2);


	if(count($resultado2)>0){
	  $id = $resultado2[0]->id;
	}
	
	
$conexion->desconectar();

define('FPDF_FONTPATH', 'font/');
require('fpdf17/fpdf_js.php');
class PDF_AutoPrint extends PDF_Javascript
{
function AutoPrint($dialog=true)
{
    //Embed some JavaScript to show the print dialog or start printing immediately
    $param=($dialog ? 'true' : 'false');
    $script="print($param);";
    $this->IncludeJS($script);
}
}

$pdf=new PDF_AutoPrint();
$pdf->Open();



$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(189, 123, '', 1);
$pdf->Text(65,22,'CONTROL DE VISITANTES');
$pdf->Text(145,22,'No.');
$pdf->Cell(200, 18,$pdf->Image('fpdf17/logo.png',10,5,40), 20,20,'L');
$pdf->Line(10,27,199,27);
$pdf->SetFont('Arial','B', 12);
$pdf->Text(15,38,'FECHA:');
$pdf->SetXY(35,30);
$pdf->Cell(12,8,$dia,1,1,'C');  //fecha dia 

$pdf->SetXY(138,29);
$pdf->Cell(30,5,$hora_ingreso,0,1,'L');

$pdf->SetXY(47,30);
$pdf->Cell(12,8,$mes,1,1,'C');// Fecha mes
$pdf->SetXY(59,30);
$pdf->Cell(13,8,$ano,1,1,'C'); //Fecha ano
$pdf->Text(95,33,'HORA DE ENTRADA:');
$pdf->Text(95,40,'HORA DE SALIDA:');
$pdf->SetXY(10,42);
$pdf->Cell(94,8,'NOMBRE DEL VISITANTE',1,1,'C');

$pdf->Cell(94,9,$nombre_apellido,1,1,'C');
 
$pdf->SetXY(104,42);
$pdf->Cell(95,8,'CEDULA No.',1,1,'C');
$pdf->SetXY(104,50);
$pdf->Cell(95,9,$cedula,1,1,'C');

$pdf->Line(10,59,199,59);
$pdf->SetXY(59,58);
$pdf->Cell(95,8,'EQUIPO O ELEMENTOS QUE PORTA',0,1,'C');
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(45,8,'COMPUTADOR PORTATIL',0,1,'C');
$pdf->Cell(21,5,'CELULAR',0,1,'C');
$pdf->Cell(15,7,'OTRO:',0,1,'C');
$pdf->Cell(98,-32,'SI',0,1,'C');
$pdf->Cell(126,32,'NO',0,1,'C');

if($computador == 0){
$pdf->SetXY(77,67); // Cuadro del no de computador
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',77,64,7),0,1,'C');
}
else{
$pdf->SetXY(62,67);// Cuadro del si de computador
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',62,64,7),1,1,'C');
}

$pdf->SetXY(62,67);// Cuadro del si de computador
$pdf->Cell(4,4,'',1,1,'C');
$pdf->SetXY(77,67); // Cuadro del no de computador
$pdf->Cell(4,4,'',1,1,'C');



$pdf->Cell(200,-2,'VIDEO BEAM',0,1,'C');
$pdf->Cell(218,15,'MALETA O PROTAFOLIO',0,1,'C');
$pdf->Cell(270,-28,'SI',0,1,'C');
$pdf->Cell(270,41,'SI',0,1,'C');

if($video_bean==1){
$pdf->SetXY(148,67); //Si del video bean, cuador de texto
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',148,64,7),1,1,'C');
}
else
{
$pdf->SetXY(177,66);  // Cuadro de texto del NO de video bean
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',177,63,7),1,1,'C');
}

$pdf->SetXY(148,67); //Si del video bean, cuador de texto
$pdf->Cell(4,4,'',1,1,'C');

if($maletin == 1){
$pdf->SetXY(148,74 ); //Cuadro de texto maleta o protafolio
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',148,71,7),1,1,'C');
}
else{
$pdf->SetXY(177,74); //cuadro de texto del no de maletin
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',177,71,7),1,1,'C');
}

$pdf->SetXY(148,74 ); //Cuadro de texto maleta o protafolio
$pdf->Cell(4,4,'',1,1,'C');

$pdf->Cell(325,-3,'NO',0,1,'C');//NO del vieo bean y maleta
$pdf->Cell(325,-11,'NO',0,1,'C');

$pdf->SetXY(177,74); //cuadro de texto del no de maletin
$pdf->Cell(4,4,'',1,1,'C');

$pdf->SetXY(177,66);  // Cuadro de texto del NO de video bean
$pdf->Cell(4,4,'',1,1,'C');

$pdf->Cell(98,12,'SI',0,1,'C'); // Si del celular

if($celular == 1){
$pdf->SetXY(62,73);       //SI del celular
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',62,70,7),1,1,'C');
}
else{
$pdf->SetXY(77,73);  //Cuadro de texto de NO del celular
$pdf->Cell(4,4,$pdf->Image('fpdf17/check.png',77,70,7),1,1,'C');
}


$pdf->SetXY(62,73);       //SI del celular
$pdf->Cell(4,4,'',1,1,'C');


$pdf->Cell(126,-3,'NO',0,1,'C');

$pdf->SetXY(77,73);  //Cuadro de texto de NO del celular
$pdf->Cell(4,4,'',1,1,'C');

$pdf->Line(10,85,199,85);


$pdf->Cell(186,20,'VISITANTES',0,1,'C');
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(200, 90	,$pdf->Image('fpdf17/controlvisitantes.png',35,89,135), 20,20,'C');

$pdf->Line(10,110,199,110);

$pdf->SetFont('Arial','B', 12);
$pdf->Cell(60,-147,'FIRMA DEL VISITANTE:',0,1,'C');
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(25,160,'CARGO:',0,1,'C');


$pdf->Cell(36,-150,'DEPENDENCIA:',0,1,'C');
$pdf->Cell(200,139,'PERSONA VISITADA',0,1,'C');
$pdf->Cell(23,-117,'FIRMA:',0,1,'C');
$pdf->Line(10,117,199,117);

$pdf->Cell(185,127,'Nota: Para la devolucion de su documento de identidad, es necesario la firma de la persona visitada.',0,1,'C');
$pdf->Cell(190,-119,'IMPORTANTE LEER EL INSTRUCTIVO',0,1,'C');


$pdf->SetXY(50,40);
$pdf->Cell(25,160,$cargo,0,1,'C');

$pdf->SetXY(40,45);
$pdf->Cell(40,160,$aux[1],0,1,'C'); //Dependencia

$pdf->SetXY(90,45);
$pdf->Cell(45,160,$persona_visitada,0,1,'C');

$pdf->SetXY(27,77);
$pdf->Cell(100,10,$otro,0,1,'L'); 

$pdf->SetXY(155,15);
$pdf->Cell(43,10,$id,0,1,'C'); 

$pdf->Ln(7);
$pdf->SetFont('Arial', 'I', 12);

$pdf->AutoPrint(true);
$pdf->Output();

?>