function cargarDocumento(){
var xmlhttp;
var n=document.getElementById('cedula').value;


if(n==''){
document.getElementById("nombre").innerHTML="";
document.getElementById("apellido").innerHTML="";
document.getElementById("hora_ingreso").innerHTML="";
document.getElementById("hora_salida").innerHTML="";

return;
}


if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200){
data = xmlhttp.responseText.split("||");

document.getElementById("nombre").innerHTML = data[0];
document.getElementById("apellido").innerHTML = data[1];
document.getElementById("hora_ingreso").innerHTML = data[2];

}

}
xmlhttp.open("POST","proc.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xmlhttp.send("q="+n);

}
