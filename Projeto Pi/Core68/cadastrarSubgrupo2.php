<?php
session_start();

include_once 'src/SubGrupo.php';
include_once 'src/SubGrupoRepositorio.php';
include_once 'src/Grupo.php';
include_once 'src/GrupoRepositorio.php';
include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';

use src\SubGrupo;
use src\SubGrupoRepositorio;
use src\Grupo;
use src\GrupoRepositorio;
use src\Usuario;
use src\UsuarioRepositorio;

if(!isset($_SESSION['logou']) || $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if ($_SESSION['nivel'] == 3){
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
<a href="cadastrarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Unidade</a>
<a href="consultarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Unidade</a>
<a href="alterarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Unidade</a>
<a href="bloquearUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Unidade</a>
<a href="desbloquearUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Unidade</a>

<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>

	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaUnidade.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todas Unidades</a>
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
<a href="excluirUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Excluir Usuarios</a>
<a href="cadastrarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Unidade</a>
<a href="consultarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Unidade</a>
<a href="alterarUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Unidade</a>
<a href="bloquearUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Unidade</a>
<a href="desbloquearUnidade.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Unidade</a>

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
$nome = $_GET['Nome'];
$idGrupo = $_GET['idGrupo'];
$id = $_SESSION['id'];

$Usuario = new Usuario();
$Usuario->setId(strip_tags(trim($id)));

$Grupo = new Grupo();
$Grupo->setId(strip_tags(trim($idGrupo)));

$SubGrupo = new SubGrupo();
$SubGrupo->setNome($nome);
$SubGrupo->setGrupo($Grupo);
$SubGrupo->setUsuario($Usuario);

$SubGrupoRepositorio = new SubGrupoRepositorio();

if($SubGrupo->getNome() == " "){
    
    echo "Digite o nome";
}
else{
    
    "NOME: ".$SubGrupo->getNome();
    "IDGRUPO: ".$SubGrupo->getGrupo()->getId();
    "SITUACAO: ".$SubGrupo->getSituacao();
   
    $retorno =
    $SubGrupo = $SubGrupoRepositorio->CadastrarSubGrupo($SubGrupo);
    
    if($retorno == TRUE){
        echo "Cadastro efetuado com sucesso";
    }
    else{
        echo "Erro no Cadastro";
    }
}

?>
<br/> 
<a href="telaPrincipal.php">Voltar</a>
</body>
</html> 
  
<?php  
}
?>

