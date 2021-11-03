<?php
use src\Usuario;
use src\Cargo;
use src\Funcionario;
use src\Unidade;
use src\FuncionarioRepositorio;
use src\UnidadeRepositorio;
use src\CargoRepositorio;
use src\UsuarioRepositorio;

session_start();

include_once 'src/Usuario.php';
include_once 'src/Cargo.php';
include_once 'src/Unidade.php';
include_once 'src/Funcionario.php';
include_once 'src/FuncionarioRepositorio.php';
include_once 'src/UnidadeRepositorio.php';
include_once 'src/CargoRepositorio.php';
include_once 'src/UsuarioRepositorio.php';

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] == 3){
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
$nome = $_GET['nome'];
$id = $_SESSION['id'];

$Usuario = new Usuario();
$Usuario->setId(strip_tags(trim($id)));

$Funcionario = new Funcionario();
$Funcionario->setNome($nome);
$Funcionario->setUsuario($Usuario);





$FuncionarioRepositorio = new FuncionarioRepositorio();

if ($nome != ""){
    $Funcionario = $FuncionarioRepositorio->consultarFuncionarioBloqueadoPorNome($Funcionario);
}

if($Funcionario->getNome() == ""){
    
    echo "Funcionario não encontrado";
}
else{
    
}
?>

<h3>Desbloquear a Funcionario do Sistema</h3>
<form action="desbloquearFuncionario3.php" method="get">
<label>Nome: </label>
<input readonly type="text" name="nome" size="25" value="<?php echo $Funcionario->getNome(); ?>"><br/><br/>
<label>Data cadastro: </label>
<input readonly type="text" name="data" size="25" value="<?php echo $Funcionario->getData(); ?>"><br/><br/>

<label>Turno:</label>
<select name="turno" disabled="disabled">
<option>Selecionar Turno</option>
<option value="1" <?php If($Funcionario->getTurno() == 1){
    echo "selected"; }?>>Manhã</option>

<option value="2" <?php if($Funcionario->getTurno() == 2){
    echo "selected";}?>>Tarde</option>

<option value="3" <?php if($Funcionario->getTurno() == 3){
    echo "selected";}?>>Noite</option>
</select><br/><br/>

<label>Superior:</label>
<select name="idSuperior" disabled="disabled">
<option>Selecionar o Superior</option>
 <?php 
 
 $Usuario = new Usuario();
 $UsuarioRepositorio = new UsuarioRepositorio();
 
 $listaUsuario = $UsuarioRepositorio->listaUsuariosDesbloqueados();
 
 $quant = $UsuarioRepositorio->contarTodosUsuariosDesbloqueado();
 
 $contador = 0;
 
while($contador < $quant){
    
    $selected= "";
    $UsuarioAtual= $listaUsuario[$contador];
   if($Funcionario->getSuperior() == $UsuarioAtual->getId()){
        $selected="selected";
    }
    
    echo "<option value='".
        $UsuarioAtual->getId()."' ".$selected.">".
        $UsuarioAtual->getNome()."</option>";
    
        $contador++;
}
 ?>
</select><br/><br/>
<label>Cargo:</label>
<select name="idCargo" disabled="disabled">
<option>Selecionar o Cargo</option>

 <?php 
 
 $Cargo = new Cargo();
 $CargoRepositorio = new CargoRepositorio();
 
 $listaCargo = $CargoRepositorio->listaCargosDesbloqueados();
 
 $quant1 = $CargoRepositorio->contarTodosCargoDesbloqueado();
 
 $contado = 0;
 
while($contado < $quant1){

    $selected= "";
    $CargoAtual= $listaCargo[$contado];
    if($Funcionario->getCargo() == $CargoAtual->getId()){
        $selected="selected";
    }
    
    echo "<option value='".
        $CargoAtual->getId()."' ".$selected.">".
        $CargoAtual->getNome()."</option>";
    
        $contado++;
}
 ?>
</select><br/><br/>

<label>Unidade:</label>
<select name="idUnidade" disabled="disabled">
<option>Selecionar o Unidade</option>
 <?php 
 
 $Unidade = new Unidade();
 $UnidadeRepositorio = new UnidadeRepositorio();
 
 $listaUnidade = $UnidadeRepositorio->listaUnidadesDesbloqueadas();
 
 $quant2 = $UnidadeRepositorio->contarTodasUnidadesDesbloqueada();
 
 $Contador = 0;

while($Contador < $quant2){
    
    $selected= "";
    $UnidadeAtual= $listaUnidade[$Contador];
   if($Funcionario->getUnidade() == $UnidadeAtual->getId()){
        $selected="selected";
    }
    
    echo "<option value='".
        $UnidadeAtual->getId()."' ".$selected.">".
        $UnidadeAtual->getNome()."</option>";
    
        $Contador++;
}
 ?>
</select><br/><br/>

<input type="hidden" name="idusu" value="<?php echo $Funcionario->getUsuario();?>">
<input type="hidden" name="situacao" value="<?php echo $Funcionario->getSituacao();?>">
<input type="hidden" name="id" value="<?php echo $Funcionario->getId()?>" >
<input type="submit" value="Desbloquear"/>
</form>
</body>
</html>   
<?php 
}
?> 

