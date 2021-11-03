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

if(!isset($_SESSION['logou']) || $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if ($_SESSION['nivel']==3){
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
$data = $_GET['data'];
$descricao = $_GET['descricao'];
$codigobarra = $_GET['codigobarra'];
$idStatus = $_GET['idStatus'];
$idAmbiente = $_GET['idAmbiente'];
$idSugbrupo = $_GET['idSugbrupo'];
$id = $_GET['id'];
$idusu = $_SESSION['id'];


$Usuario = new Usuario();
$Usuario->setId(strip_tags(trim($idusu)));

$Ambiente = new Ambiente();
$Ambiente->setId(strip_tags(trim($idAmbiente)));

$SubGrupo = new SubGrupo();
$SubGrupo->setId(strip_tags(trim($idSugbrupo)));

$Ativo = new Ativo();
$Ativo->setId($id);
$Ativo->setNome($nome);
$Ativo->setData($data);
$Ativo->setUsuario($Usuario);
$Ativo->setAmbiente($Ambiente);
$Ativo->setSubGrupo($SubGrupo);
$Ativo->setDescricao($descricao);
$Ativo->setStatus($idStatus);
$Ativo->setCodigobarra($codigobarra);

$AtivoRepositorio = new AtivoRepositorio();
$retorno = $AtivoRepositorio->alterarAtivo($Ativo);

if($retorno == TRUE){
    echo "As Informações desse Ativo Foram Alterado com sucesso";
}
else {
    echo "Falha nas Alteração do Ativo";
}

?>
<br/> 
<a href="telaPrincipal.php">Voltar</a>
</body>
</html> 
  
<?php  
}
?>
