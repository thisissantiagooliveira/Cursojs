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
<title>Sistema</title>
<meta charset="UTF-8"/>
</head>
<?php echo($_SESSION['nome']);?>

<?php 
if($_SESSION['nivel'] == 1){
?>    
<a href="cadastrarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a>
<a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Usuario</a>
<a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a>
<a href="bloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a>
<a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a>
<a href="excluirUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Excluir Usuarios</a>

<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>

	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 2){
?>
<a href="cadastrarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a>
<a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Usuario</a>
<a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a>
<a href="bloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a>
<a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a>

<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>

	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 3){
?>
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>
	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 

}
?>
<?php 

$Usuario = new Usuario();
$UsuarioRepositorio = new UsuarioRepositorio();

$quant = $UsuarioRepositorio->contarTodosUsuariosBloqueado();

$listaUsuario= $UsuarioRepositorio->listaUsuariosBloqueados();

?> 
<?php 

$Usuario = new Usuario();
$UsuarioRepositorio = new UsuarioRepositorio();

$quant = $UsuarioRepositorio->contarTodosUsuariosBloqueado();

$listaUsuario= $UsuarioRepositorio->listaUsuariosBloqueados();

?> 
<?php 

$Usuario = new Usuario();
$UsuarioRepositorio = new UsuarioRepositorio();

$quant = $UsuarioRepositorio->contarTodosUsuariosBloqueado();

$listaUsuario= $UsuarioRepositorio->listaUsuariosBloqueados();

?> 
<?php 

$Usuario = new Usuario();
$UsuarioRepositorio = new UsuarioRepositorio();

$quant = $UsuarioRepositorio->contarTodosUsuariosDesbloqueado();

$listaUsuario= $UsuarioRepositorio->listaUsuariosDesbloqueados();

?> 
<h3>Lista de Usuarios</h3>
<table border="1" cellpadding="0" cellspacing="0">
<tr>
<td>&nbsp;ID&nbsp;</td>
<td>&nbsp;NOME&nbsp;</td>
<td>&nbsp;LOGIN&nbsp;</td>
<td>&nbsp;NIVEL&nbsp;</td>
<td>&nbsp;SUPERIOR&nbsp;</td>
<td>&nbsp;SITUA????O&nbsp;</td>
</tr>
<?php 
$contador = 0;

while($contador < $quant){
    
    $Usuario = $listaUsuario[$contador];
    if($Usuario->getSituacao() == 1){
        $cor = "style='color:#696969';";
        $img = "img\bloq1.png";
    }
    else{
        $cor ="style='color:#000000';";
        $img = "img\desblo1.png";
    }
    
    if($Usuario->getNivel()==1){
     $nivel = 'Administrador';
    }
    else if($Usuario->getNivel()== 2){
        $nivel = 'Supervisor';
    }
    else if($Usuario->getNivel()== 3){
        $nivel = 'Operador';
    }
    
    if($Usuario->getIdSuperior()==1){
        $superior = 'Administrador';
    }
    else if($Usuario->getIdSuperior()== 2){
        $superior = 'Supervisor';
    }
    else if($Usuario->getIdSuperior()== 3){
        $superior = 'Operador';
    }
    echo "<tr ".$cor.">";
    echo "<td>&nbsp;".$Usuario->getId()."</td>";
    echo "<td>&nbsp;<a href='infoDesbloqueado.php?id=".$Usuario->getId().
                                    "'>".$Usuario->getNome()."</a>&nbsp;</td>";
    echo "<td>&nbsp;".$Usuario->getLogin()."&nbsp;</td>";
    echo "<td>&nbsp;".$nivel."&nbsp;</td>";
    echo "<td>&nbsp;".$superior."&nbsp;</td>";
    echo "<td>&nbsp;<img src='".$img."'width='15'>&nbsp;".
              "<img src='img\apag.png' width='15'>&nbsp;".
              "<img src='img\config.png' width='15'></td>";
    echo "</tr>";
    
    $contador++;
}

?>
</table>
<br/> 
<a href="telaPrincipal.php">Voltar</a> 
</body>
</html>   
<?php 
}
?> 