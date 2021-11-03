<?php

session_start();

use src\Unidade;
use src\UnidadeRepositorio;

include_once 'src/Unidade.php';
include_once 'src/UnidadeRepositorio.php';

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] != 1){
    header('Location: telaPrincipal.php');
}
else{
    ?>
<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CORE</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1" href="index.php"><font color='#F05F40'>Tela inicial </font></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
         
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
           
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <h5>BOA NOITE <?php echo($_SESSION['nome']);?></h5> 
          </a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="alterarPerfil.php">Alterar perfil</a>
            <a class="dropdown-item" href="alterarSenha.php">Alterar Senha</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

<div id="wrapper">
<?php 
if($_SESSION['nivel'] == 1){
?>    
<div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="telaPrincipal.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel de Controle</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cadastro</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Cadastrar:</h6>
            <a class="dropdown-item" href="cadastrarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="CadastrarAmbiente.php">Ambiente</a>
            <a class="dropdown-item" href="cadastrarCargo.php">Cargo</a>
            <a class="dropdown-item" href="cadastrarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="cadastrarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="cadastrarSubgrupo.php">SubGrupo</a>
            <a class="dropdown-item" href="CadastrarAtivo.php">Ativo</a>
			<a class="dropdown-item" href="cadastrarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="Movimentacao.php">Movimentação</a>
          
          </div>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Alterar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Alterações:</h6>
            <a class="dropdown-item" href="alterarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="alterarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="alterarAtivo.php">Ativo</a>
            <a class="dropdown-item" href="alterarPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="alterarAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="alterarCargo.php">Cargo</a>
			<a class="dropdown-item" href="alterarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="alterarSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="alterarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="forgot-password.html">Movimentação</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Consultar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Consultas:</h6>
            <a class="dropdown-item" href="consultarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="consultarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="ConsultarAtivo.php">Ativo</a>
            <a class="dropdown-item" href="consultarPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="consultarAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="consultarCargo.php">Cargo</a>
			<a class="dropdown-item" href="consultarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="consultarSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="consultarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="Consultamovimentacao.php">Movimentação</a>
          
          </div>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bloquear</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Bloqueios:</h6>
            <a class="dropdown-item" href="bloquearUnidade.php">Unidade</a>
            <a class="dropdown-item" href="bloquearFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="bloquearativo.php">Ativo</a>
            <a class="dropdown-item" href="bloquearPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="bloquearAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="bloquearCargo.php">Cargo</a>
			<a class="dropdown-item" href="bloquearGrupo.php">Grupo</a>
			<a class="dropdown-item" href="bloquearSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="bloquearUsuario.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Desbloquear</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Desbloqueios:</h6>
            <a class="dropdown-item" href="desbloquearUnidade.php">Unidade</a>
            <a class="dropdown-item" href="desbloquearFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="desbloquearativo.php">Ativo</a>
            <a class="dropdown-item" href="desbloquearPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="desbloquearAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="desbloquearCargo.php">Cargo</a>
			<a class="dropdown-item" href="desbloquearGrupo.php">Grupo</a>
			<a class="dropdown-item" href="desbloquearSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="desbloquearUsuario.php">Usuario</a>
          
          </div>
        </li>
		<a class="navbar-brand mr-1"><font color='#F05F40'>Relatorios</font></a>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Todos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Liste todos:</h6>
            <a class="dropdown-item" href="listaUnidade.php">Unidade</a>
            <a class="dropdown-item" href="listaTodosFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="listaTodoAtivo.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargos.php">Cargo</a>
			<a class="dropdown-item" href="listaTodosGrupo.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="listaTodos.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>lista Bloquados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos bloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesBloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionariosBloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoBloqueados.php">Ativo</a>
			<a class="dropdown-item" href="bloquearPorCodigoBarra.php">Codigo de Barras</a>
			<a class="dropdown-item" href="listaAmbienteBloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosBloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoBloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupoBloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaBloqueados.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Desbloqueados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos Desbloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesDesbloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionarioDesbloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoDesbloqueados.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbienteDesbloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosDesbloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoDesbloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupodesbloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaDesbloqueados.php">Usuario</a>
          
          </div>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Listas Por</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Listar Por:</h6>
            <a class="dropdown-item" href="listaPorNivel.php">Nivel de Usuario</a>
            <a class="dropdown-item" href="listaPorSuperior.php">Superior Usuario</a>
            <a class="dropdown-item" href="listaAtivosconcerto.php">Ativos No conserto</a>
			<a class="dropdown-item" href="listaAtivoTransferencia.php">Ativo Transferencias</a>
			<a class="dropdown-item" href="listaAtivodevolucao.php">Ativo Devolução</a>
			<a class="dropdown-item" href="listaAtivodoacao.php">Ativo Doação</a>
			<a class="dropdown-item" href="listaAtivoBaixa.php">Ativo Baixa</a>
			<a class="dropdown-item" href="listaAtivoemuso.php">Ativo em Uso</a>
          
          </div>
        </li>
        
      </ul>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 2){
?>
<div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="telaPrincipal.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel de Controle</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cadastro</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Cadastrar:</h6>
            <a class="dropdown-item" href="cadastrarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="CadastrarAmbiente.php">Ambiente</a>
            <a class="dropdown-item" href="cadastrarCargo.php">Cargo</a>
            <a class="dropdown-item" href="cadastrarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="cadastrarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="cadastrarSubgrupo.php">SubGrupo</a>
            <a class="dropdown-item" href="CadastrarAtivo.php">Ativo</a>
			<a class="dropdown-item" href="cadastrarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="Movimentacao.php">Movimentação</a>
          
          </div>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Alterar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Alterações:</h6>
            <a class="dropdown-item" href="alterarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="alterarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="alterarAtivo.php">Ativo</a>
            <a class="dropdown-item" href="alterarPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="alterarAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="alterarCargo.php">Cargo</a>
			<a class="dropdown-item" href="alterarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="alterarSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="alterarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="forgot-password.html">Movimentação</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Consultar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Consultas:</h6>
            <a class="dropdown-item" href="consultarUnidade.php">Unidade</a>
            <a class="dropdown-item" href="consultarFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="ConsultarAtivo.php">Ativo</a>
            <a class="dropdown-item" href="consultarPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="consultarAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="consultarCargo.php">Cargo</a>
			<a class="dropdown-item" href="consultarGrupo.php">Grupo</a>
			<a class="dropdown-item" href="consultarSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="consultarUsuario.php">Usuario</a>
			<a class="dropdown-item" href="Consultamovimentacao.php">Movimentação</a>
          
          </div>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bloquear</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Bloqueios:</h6>
            <a class="dropdown-item" href="bloquearUnidade.php">Unidade</a>
            <a class="dropdown-item" href="bloquearFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="bloquearativo.php">Ativo</a>
            <a class="dropdown-item" href="bloquearPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="bloquearAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="bloquearCargo.php">Cargo</a>
			<a class="dropdown-item" href="bloquearGrupo.php">Grupo</a>
			<a class="dropdown-item" href="bloquearSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="bloquearUsuario.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Desbloquear</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Desbloqueios:</h6>
            <a class="dropdown-item" href="desbloquearUnidade.php">Unidade</a>
            <a class="dropdown-item" href="desbloquearFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="desbloquearativo.php">Ativo</a>
            <a class="dropdown-item" href="desbloquearPorCodigoBarra.php">Ativo Por Codigo de Barras</a>
			<a class="dropdown-item" href="desbloquearAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="desbloquearCargo.php">Cargo</a>
			<a class="dropdown-item" href="desbloquearGrupo.php">Grupo</a>
			<a class="dropdown-item" href="desbloquearSubgrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="desbloquearUsuario.php">Usuario</a>
          
          </div>
        </li>
		<a class="navbar-brand mr-1"><font color='#F05F40'>Relatorios</font></a>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Todos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Liste todos:</h6>
            <a class="dropdown-item" href="listaUnidade.php">Unidade</a>
            <a class="dropdown-item" href="listaTodosFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="listaTodoAtivo.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargos.php">Cargo</a>
			<a class="dropdown-item" href="listaTodosGrupo.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="listaTodos.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>lista Bloquados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos bloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesBloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionariosBloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoBloqueados.php">Ativo</a>
			<a class="dropdown-item" href="bloquearPorCodigoBarra.php">Codigo de Barras</a>
			<a class="dropdown-item" href="listaAmbienteBloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosBloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoBloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupoBloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaBloqueados.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Desbloqueados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos Desbloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesDesbloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionarioDesbloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoDesbloqueados.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbienteDesbloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosDesbloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoDesbloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupodesbloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaDesbloqueados.php">Usuario</a>
          
          </div>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Listas Por</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Listar Por:</h6>
            <a class="dropdown-item" href="listaPorNivel.php">Nivel de Usuario</a>
            <a class="dropdown-item" href="listaPorSuperior.php">Superior Usuario</a>
            <a class="dropdown-item" href="listaAtivosconcerto.php">Ativos No conserto</a>
			<a class="dropdown-item" href="listaAtivoTransferencia.php">Ativo Transferencias</a>
			<a class="dropdown-item" href="listaAtivodevolucao.php">Ativo Devolução</a>
			<a class="dropdown-item" href="listaAtivodoacao.php">Ativo Doação</a>
			<a class="dropdown-item" href="listaAtivoBaixa.php">Ativo Baixa</a>
			<a class="dropdown-item" href="listaAtivoemuso.php">Ativo em Uso</a>
          
          </div>
        </li>
        
      </ul>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 3){
?>
<div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="telaPrincipal.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel de Controle</span>
          </a>
        </li>
		<a class="navbar-brand mr-1"><font color='#F05F40'>Relatorios</font></a>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Todos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Liste todos:</h6>
            <a class="dropdown-item" href="listaUnidade.php">Unidade</a>
            <a class="dropdown-item" href="listaTodosFuncionario.php">Funcionario</a>
            <a class="dropdown-item" href="listaTodoAtivo.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbiente.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargos.php">Cargo</a>
			<a class="dropdown-item" href="listaTodosGrupo.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupo.php">SubGrupo</a>
			<a class="dropdown-item" href="listaTodos.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>lista Bloquados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos bloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesBloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionariosBloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoBloqueados.php">Ativo</a>
			<a class="dropdown-item" href="bloquearPorCodigoBarra.php">Codigo de Barras</a>
			<a class="dropdown-item" href="listaAmbienteBloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosBloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoBloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupoBloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaBloqueados.php">Usuario</a>
          
          </div>
        </li>
		
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Lista Desbloqueados</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Todos Desbloqueados:</h6>
            <a class="dropdown-item" href="listaUnidadesDesbloqueadas.php">Unidade</a>
            <a class="dropdown-item" href="listaFuncionarioDesbloqueados.php">Funcionario</a>
            <a class="dropdown-item" href="listaAtivoDesbloqueados.php">Ativo</a>
			<a class="dropdown-item" href="listaAmbienteDesbloqueado.php">Ambiente</a>
			<a class="dropdown-item" href="listaCargosDesbloqueados.php">Cargo</a>
			<a class="dropdown-item" href="listaGrupoDesbloqueados.php">Grupo</a>
			<a class="dropdown-item" href="listaSubGrupodesbloqueado.php">SubGrupo</a>
			<a class="dropdown-item" href="listaDesbloqueados.php">Usuario</a>
          
          </div>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Listas Por</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Listar Por:</h6>
            <a class="dropdown-item" href="listaPorNivel.php">Nivel de Usuario</a>
            <a class="dropdown-item" href="listaPorSuperior.php">Superior Usuario</a>
            <a class="dropdown-item" href="listaAtivosconcerto.php">Ativos No conserto</a>
			<a class="dropdown-item" href="listaAtivoTransferencia.php">Ativo Transferencias</a>
			<a class="dropdown-item" href="listaAtivodevolucao.php">Ativo Devolução</a>
			<a class="dropdown-item" href="listaAtivodoacao.php">Ativo Doação</a>
			<a class="dropdown-item" href="listaAtivoBaixa.php">Ativo Baixa</a>
			<a class="dropdown-item" href="listaAtivoemuso.php">Ativo em Uso</a>
          
          </div>
        </li>
        
      </ul>

<?php 

}
?>

      <div id="content-wrapper">

        <div class="container-fluid">


          <!-- DataTables Example -->
          <div class="card mb-3">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<?php 

$Unidade = new Unidade();
$UnidadeRepositorio = new UnidadeRepositorio();

$quant = $UnidadeRepositorio->contarTodasUnidades();

$listaUnidade= $UnidadeRepositorio->listaUnidades();

?> 
<h3>Lista de Unidades</h3>
<table border="1" cellpadding="0" cellspacing="0">    
<tr>

<td>&nbsp;NOME&nbsp;</td>
</tr>
<?php 
$contador = 0;

while($contador < $quant){
    
    $Unidade = $listaUnidade[$contador];
    if($Unidade->getSituacao() == 1){
        $cor = "style='color:#696969';";
        $img = "img\bloq1.png";
    }
    else{
        $cor ="style='color:#000000';";
        $img = "img\desblo1.png";
    }      
    echo "<tr ".$cor.">";
    echo "<td>&nbsp;<a href='alterarAtivo2.php?id=".$Unidade->getId().
    "'>".$Unidade->getNome()."</a>&nbsp;</td>";
    
    echo "</tr>";
    
    $contador++;
}

?>
</table>
<br/> 
<a href="telaPrincipal.php">Voltar</a> 
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Todos os Direitos reservados 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">pronto para sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Logout" abaixo se você estiver pronto para terminar sua sessão atual.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><font color='#F05F40'>Cancelar</font></button>
            <a class="btn btn-primary" href="index.php"><font color='#F05F40'>Logout</font></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

</html>
  
<?php  
}
?>
