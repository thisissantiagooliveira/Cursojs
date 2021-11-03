<?php

session_start();

use src\Funcionario;
use src\FuncionarioRepositorio;

include_once 'src/Funcionario.php';
include_once 'src/FuncionarioRepositorio.php';

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
<body>
<?php echo($_SESSION['nome']);?> <a href="sairSistema.php">Sair</a>

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

$Funcionario = new Funcionario();
$FuncionarioRepositorio = new FuncionarioRepositorio();

$quant = $FuncionarioRepositorio->contarTodosFuncionarios();

$listaFuncionaro= $FuncionarioRepositorio->listaFuncionarios();

?> 
<h3>Lista de Funcionario</h3>
<table border="1" cellpadding="0" cellspacing="0">
<tr>
<td>&nbsp;ID&nbsp;</td>
<td>&nbsp;NOME&nbsp;</td>
<td>&nbsp;DATA CADASTRO&nbsp;</td>
<td>&nbsp;TURNO&nbsp;</td>
<td>&nbsp;CARGO&nbsp;</td>
<td>&nbsp;UNIDADE&nbsp;</td>
<td>&nbsp;SUPERIOR&nbsp;</td>
<td>&nbsp;USUARIO QUE CADASTROU&nbsp;</td>
<td>&nbsp;SITUAÇÃO&nbsp;</td>
</tr>
<?php 
$contador = 0;

while($contador < $quant){
    
    $Funcionario = $listaFuncionaro[$contador];
    if($Funcionario->getSituacao() == 1){
        $cor = "style='color:#696969';";
        $img = "img\bloq1.png";
    }
    else{
        $cor ="style='color:#000000';";
        $img = "img\desblo1.png";
    }
    
    if($Funcionario->getTurno()== 1){
        $Turno = 'Manhã';
    }
    else if($Funcionario->getTurno()== 2){
        $Turno = 'Tarde';
    }
    else if($Funcionario->getTurno()== 3){
        $Turno = 'Noite';
    }
    echo "<tr ".$cor.">";
    echo "<td>&nbsp;".$Funcionario->getId()."</td>";
    echo "<td>&nbsp;".$Funcionario->getNome()."</td>";
    echo "<td>&nbsp;".$Funcionario->getData()."&nbsp;</td>";
    echo "<td>&nbsp;".$Turno."&nbsp;</td>";
    echo "<td>&nbsp;<a href='infoCargo.php?id=".$Funcionario->getId().
    "'>".$Funcionario->getCargo()."</a>&nbsp;</td>";
    echo "<td>&nbsp;<a href='infoUnidade.php?id=".$Funcionario->getId().
    "'>".$Funcionario->getUnidade()."</a>&nbsp;</td>";
    echo "<td>&nbsp;<a href='infoUsuario.php?id=".$Funcionario->getId().
    "'>".$Funcionario->getSuperior()."</a>&nbsp;</td>";
    echo "<td>&nbsp;<a href='infoUsuario.php?id=".$Funcionario->getId().
    "'>".$Funcionario->getUsuario()."</a>&nbsp;</td>";
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