 <?php
session_start();

include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';

use src\Usuario;
use src\UsuarioRepositorio;

if($_SERVER['HTTP_REFERER']!= "http://localhost/eclipse1/Sistemaex/index.php"){
    
    header('Location: index.php');
}
else{
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    if($login == "" || $senha == ""){
        echo("Digite Login e/ou Senha"."<br/>");
    }
    else{
       $Usuario = new Usuario();
       $Usuario->setLogin($login);
       $Usuario->setSenha($senha);

       $UsuarioRepositorio = new UsuarioRepositorio();
       $Usuario = $UsuarioRepositorio->autenticarUsuario($Usuario);
       
       $_SESSION['logou'] = TRUE;
       $_SESSION['id'] = $Usuario->getId();
       $_SESSION['nivel'] = $Usuario->getNivel();
       $_SESSION['nome'] = $Usuario->getNome();
       $_SESSION['login'] = $Usuario->getLogin();
       $_SESSION['idSuperior'] = $Usuario->getIdSuperior();
       $_SESSION['situacao'] = $Usuario->getSituacao();
       
       header('Location: telaPrincipal.php');
       
    }
}

?>