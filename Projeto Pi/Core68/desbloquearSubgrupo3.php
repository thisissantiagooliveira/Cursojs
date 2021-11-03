<?php
session_start();


include_once 'src/SubGrupo.php';
include_once 'src/SubGrupoRepositorio.php';
include_once 'src/Grupo.php';
include_once 'src/GrupoRepositorio.php';

use src\SubGrupo;
use src\SubGrupoRepositorio;
use src\Grupo;
use src\GrupoRepositorio;

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] == 3){
    header('Location: telaPrincipal.php');
}
else{
   
    $Grupo = new Grupo();
    
    $GrupoRepositorio = new GrupoRepositorio();
    
    $listaGrupo =
    $GrupoRepositorio->listaGruposDesbloqueados();
    
    $quant =
    $GrupoRepositorio->contarTodosGruposDesbloqueado();
    
    $contador = 0;
    
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


$id = $_GET['id'];

$SubGrupo  = new SubGrupo();
$SubGrupo->setId($id);
$SubGrupoRepositorio = new SubGrupoRepositorio();

$SubGrupo = $SubGrupoRepositorio->consultaSubGrupoPorId($SubGrupo);



?>


<h3>Consulta das informações do SubGrupo</h3>
<form action="desbloquearSubgrupo4.php" method="get">
<label>ID: </label>
<input readonly type="text" name="id" size="25" value="<?php echo $SubGrupo->getId(); ?>"><br/><br/>

<label>Nome: </label>
<input  type="text" name="nome" size="25" value="<?php echo $SubGrupo->getNome(); ?>"><br/><br/>

<input type="hidden" name="situacao" value="<?php echo $SubGrupo->getSituacao()?>" >
<input type="hidden" name="id" value="<?php echo $SubGrupo->getId()?>" >

<label>Grupo:</label><select name="idGrupo">

<?php                                                                               
while($contador < $quant){                                                          
                                                                                    
    $Grupo = $listaGrupo[$contador];                                            
                                                                                    
    echo "<option value='".$Grupo->getId()."'>".$Grupo->getNome()."</option>" ; 
    $contador++;                                                                    
}   

?> 
</select><br/><br/>        
<input type="submit" value="desbloquear"/>
</form>
</body>
</html> 

<?php 

}
?>


