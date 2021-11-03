<?php

session_start();

use src\Usuario;
use src\UsuarioRepositorio;

include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] != 1){
    header('Location: telaPrincipal.php');
}
else{
    ?>
<!doctype html>
<html>
<head>
<title>:SISTEMA:</title>
<meta charset="UTF-8"/>
</head>
<body bgcolor="#E0FFFF">   

<table border="1" cellpadding="0" cellspacing="0">
<tr>
<td>&nbsp;ID&nbsp;</td>
<td>&nbsp;NOME&nbsp;</td>
<td>&nbsp;LOGIN&nbsp;</td>
<td>&nbsp;NIVEL&nbsp;</td>
<td>&nbsp;SUPERIOR&nbsp;</td>
<td>&nbsp;SITUAÇÃO&nbsp;</td>
</tr>

<?php 

$id = $_GET['id'];

$Usuario = new Usuario();
$Usuario->setId($id);
$UsuarioRepositorio = new UsuarioRepositorio();
$Usuario = $UsuarioRepositorio->consultaUsuarioPorId($Usuario);
//----nivel do usuario para parecer o nome------/
if($Usuario->getNivel()==1){
    $nivel = 'Administrador';
}
else if($Usuario->getNivel()== 2){
    $nivel = 'Supervisor';
}
else if($Usuario->getNivel()== 3){
    $nivel = 'Operador';
}


echo "<td>&nbsp;".$Usuario->getId()."&nbsp;</td>";
echo "<td>&nbsp;".$Usuario->getNome()."&nbsp;</td>";
echo "<td>&nbsp;".$Usuario->getLogin()."&nbsp;</td>";
echo "<td>&nbsp;".$nivel."&nbsp;</td>";
echo "<td>&nbsp;".$Usuario->getIdSuperior()."&nbsp;</td>";
echo "<td>&nbsp;".$Usuario->getSituacao()."&nbsp;</td>";

?>
</table>
<br/> 
<a href="listaBloqueados.php">Voltar</a> 
</body>
</html>
<?php 
}
?>
