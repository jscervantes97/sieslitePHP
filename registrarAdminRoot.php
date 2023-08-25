<?php
require 'conexion/Conexion.php';
use conexion\Conexion ; 
$bd = new Conexion();
$options = [
    'cost' => 12,
];
/*
$pass = base64_encode("14141414");
$query = "INSERT INTO usuarios(nombreUsuario, contra, status, rol) VALUES('ROOT2', '".$pass."', 1, 'ADMIN');" ;
$reg = $bd->query($query) or die ('la has liado tio <br>' . $bd->error);
//echo $reg ; 
*/
$stmt = $bd->prepare("select * from usuarios ;");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$registros = $result->fetch_all();

foreach($registros as $reg){
    
    echo "pass codificado ".$reg[2]."<br>";
    echo "pass decodificado ".base64_decode($reg[2]).'<br>';
}

$bd->close() ; 
?>