<?php
session_start();
include_once 'src/Ativo.php';
include_once 'src/AtivoRepositorio.php';
include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';
include_once 'src/Ambiente.php';
include_once 'src/AmbienteRepositorio.php';
include_once 'src/SubGrupo.php';
include_once 'src/SubGrupoRepositorio.php';

use src\Ativo;
use src\AtivoRepositorio;
use src\Usuario;
use src\UsuarioRepositorio;
use src\Ambiente;
use src\AmbienteRepositorio;
use src\SubGrupo;
use src\SubGrupoRepositorio;

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] == 3){
    header('Location: telaPrincipal.php');
}
else{
    
    $Ambiente = new Ambiente();
    
    $AmbienteRepositorio = new AmbienteRepositorio();
    
    $listaAmbiente =
    $AmbienteRepositorio->listaAmbintesDesbloqueados();
    
    $quant1 =
    $AmbienteRepositorio->contarTodosAmbientesDesbloqueado();
    
    $Contador = 0;
    
    $SubGrupo = new SubGrupo();
    
    $SubGrupoRepositorio = new SubGrupoRepositorio();
    
    $listaSubGrupo =
    $SubGrupoRepositorio->listaSubGruposDesbloqueados();
    
    $quant2 =
    $SubGrupoRepositorio->contarTodosSubGruposDesbloqueado();
    
    $contado = 0;
    
    
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

$codigobarra = $_GET['codigobarra'];

$Ativo = new Ativo();
$Ativo->setCodigobarra($codigobarra);
$AtivoRepositorio = new AtivoRepositorio();

$Ativo = $AtivoRepositorio->consultaAtivoPorCodigoBarra($Ativo);


?>


<h3>Alterar das informações do Ativo</h3>
<form action="alterarPorCodigoBarra3.php" method="get">

<label>Nome: </label>
<input  type="text" name="nome" size="25" value="<?php echo $Ativo->getNome(); ?>"><br/><br/>

<label>Data: </label>
<input  type="text" name="data" size="25" value="<?php echo $Ativo->getData(); ?>"><br/><br/>

<label>Descricao: </label>
<input  type="text" name="descricao" size="25" value="<?php echo $Ativo->getDescricao(); ?>"><br/><br/>

<label>Codigo de barras: </label>
<input  type="text" name="codigobarra" size="25" value="<?php echo $Ativo->getCodigobarra(); ?>"><br/><br/>

<label>Status:</label>
<select name="idStatus">
<option>Selecionar Status</option>
<option value="1" <?php If($Ativo->getStatus() == 1){
    echo "selected"; }?>>EM USO</option>

<option value="2" <?php if($Ativo->getStatus() == 2){
    echo "selected";}?>>MANUTEÇÂO</option>

<option value="3" <?php if($Ativo->getStatus() == 3){
    echo "selected";}?>>BAIXA</option>
  
  <option value="4" <?php if($Ativo->getStatus() == 4){
    echo "selected";}?>>TRANSFERIDO</option>    
</select><br/><br/>

<label>Ambiente:</label><select name="idAmbiente">

<?php                                                                               
while($Contador < $quant1){                                                          
                                                                                    
    $Ambiente = $listaAmbiente[$Contador];                                            
                                                                                    
    echo "<option value='".$Ambiente->getId()."'>".$Ambiente->getNome()."</option>" ; 
    $Contador++;                                                                    
}   

?> 
</select><br/><br/>  


<label>SubGrupo:</label><select name="idSugbrupo">

<?php                                                                               
while($contado < $quant2){                                                          
                                                                                    
    $SubGrupo = $listaSubGrupo[$contado];                                            
                                                                                    
    echo "<option value='".$SubGrupo->getId()."'>".$SubGrupo->getNome()."</option>" ; 
    $contado++;                                                                    
}   



?> 
</select><br/><br/> 

<input type="hidden" name="id" value="<?php echo $Ativo->getUsuario();?>">
<input type="hidden" name="id" value="<?php echo $Ativo->getId()?>" >      
<input type="submit" value="Alterar"/>
</form>
</body>
</html> 

<?php 

}
?>