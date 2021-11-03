<?php
namespace src;

include_once 'Cargo.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class CargoRepositorio 
{
    private $Conexao;
    private $Usuario;

public function __construct()
{
    $this->Conexao = new Conexao();
    $this->Cargo = new Cargo();
}

public function CadastrarCargo($Cargo) {
    $retorno= FALSE;
    
    $this->Cargo = $Cargo;
    $codigoSQL = "INSERT INTO CARGO(NOME,IDUSUARIO,SITUACAO)".
    " VALUES ('".$this->Cargo->getNome()."',".$this->Cargo->getUsuario()->getId().", 0)";
   
    $this->Conexao->abrirConexao();
    if ($this->Conexao->getConexao()->query($codigoSQL)) {
        $retorno = TRUE;
    } else {
        echo ("Falha no cadastro do Cargo" . mysqli_error($this->Conexao->getConexao()));
    }
    $this->Conexao->fecharBanco();
    return $retorno;
    
}
public function consultarCargoPorNome($Cargo)
{
    $this->Cargo = $Cargo;
    
    $codigoSQL = "SELECT * FROM CARGO WHERE NOME = '".$this->Cargo->getNome()."' AND SITUACAO = 0";

 
    $this->Conexao->abrirConexao();
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $numeroLinhas = mysqli_num_rows($resultado);
    if ($numeroLinhas > 0) {
        $linha = mysqli_fetch_assoc($resultado);
        
        $this->Cargo->setId($linha['ID']);
        $this->Cargo->setNome($linha['NOME']);
        $this->Cargo->setUsuario($linha['IDUSUARIO']);
        $this->Cargo->setSituacao($linha['SITUACAO']);
  
    } else {
        echo "Cargo inválido";
    }
    $this->Conexao->fecharBanco();
    
    return $this->Cargo;
}
    public function alterarCargo($Cargo){
    $retorno = FALSE;
    
    $this->Cargo= $Cargo;
    $codigoSQL = "UPDATE CARGO SET ".
        " NOME = '".$this->Cargo->getNome()."', ".
        " IDUSUARIO =".$this->Cargo->getUsuario()->getId() ." ".
        " WHERE ID = ".$this->Cargo->getId()." ";
    
    $this->Conexao->abrirConexao();
    if($this->Conexao->getConexao()->query($codigoSQL)){
        $retorno = TRUE;
    }
    else{
        echo("Falha na alteracão do Cargo");
    }
    $this->Conexao->fecharBanco();
    return $retorno;
}
    public function bloquearCargo($Cargo){
    $retorno = FALSE;
    
    $this->Cargo = $Cargo;
    
    $codigoSQL="UPDATE CARGO SET".
        " SITUACAO= 1".
        " WHERE ID = ".$this->Cargo->getId()." ";
    
    $this->Conexao->abrirConexao();
    if($this->Conexao->getConexao()->query($codigoSQL)){
        $retorno = TRUE;
    }
    else{
        echo("Falha ao tentar Bloquear o Cargo");
    }
    $this->Conexao->fecharBanco();
    return $retorno;
}
public function desbloquearCargo($Cargo){
    $retorno = FALSE;
    $this->Cargo = $Cargo;
    
    $codigoSQL = "UPDATE CARGO SET".
        " SITUACAO = 0".
        " WHERE ID = ".$this->Cargo->getId()." ";
    
    $this->Conexao->abrirConexao();
    if($this->Conexao->getConexao()->query($codigoSQL)){
        $retorno = TRUE;
    }
    else{
        echo("Falha ao tentar Desbloquear o Cargo ");
    }
    $this->Conexao->fecharBanco();
    return $retorno;
}

public function excluirCargo($Cargo){
    $retorno = FALSE;
    $this->Cargo =$Cargo;
    
    $codigoSQL ="DELETE FROM CARGO".
        " WHERE ID = ".$this->Cargo->getId()." ";
    
    $this->Conexao->abrirConexao();
    if($this->Conexao->getConexao()->query($codigoSQL)){
        $retorno = TRUE;
    }
    else{
        echo("Falha ao tentar Excluir o Cargo");
    }
    $this->Conexao->fecharBanco();
    return $retorno;
}
public function consultarCargoBloqueadoPorNome($Cargo){
    $this->Cargo = $Cargo;
    
    $codigoSQL= "SELECT * FROM CARGO".
        " WHERE NOME ='".$this->Cargo->getNome()."' ".
        " AND SITUACAO = 1";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $this->Cargo->setId($linha['ID']);
        $this->Cargo->setNome($linha['NOME']);
        $this->Cargo->setUsuario($linha['IDUSUARIO']);
        $this->Cargo->setSituacao($linha['SITUACAO']);
        
    }
    else{
        echo "Cargo não existe";
    }
    $this->Conexao->fecharBanco();
    return $this->Cargo;
    
}

public function consultarCargoDesbloqueadoPorNome($Cargo){
    $this->Cargo = $Cargo;
    
    $codigoSQL= "SELECT * FROM CARGO".
        " WHERE NOME ='".$this->Cargo->getNome()."' ".
        " AND SITUACAO = 0";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $this->Cargo->setId($linha['ID']);
        $this->Cargo->setNome($linha['NOME']);
        $this->Cargo->setUsuario($linha['IDUSUARIO']);
        $this->Cargo->setSituacao($linha['SITUACAO']);
        
    }
    else{
        echo "Cargo não existe";
    }
    $this->Conexao->fecharBanco();
    return $this->Cargo;
    
}





public function consultaCargoPorId($Cargo){
    $this->Cargo= $Cargo;
    
    $codigoSQL = "SELECT * FROM CARGO".
        " WHERE ID = ".$this->Cargo->getId()." ";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $this->Cargo->setId($linha['ID']);
        $this->Cargo->setNome($linha['NOME']);
        $this->Cargo->setUsuario($linha['USUARIO']);
        $this->Cargo->setSituacao($linha['SITUACAO']);
        
    }
    else{
        echo "Cargo não existe";
    }
    $this->Conexao->fecharBanco();
    return $this->Cargo;
    
}

public function contarCargos(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM CARGO ";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $quant = $linha['QUANTIDADE'];
        
    }
    
    $this->Conexao->fecharBanco();
    return $quant;
}
public function contarTodosCargoBloqueado(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM CARGO ".
        " WHERE SITUACAO = 1";
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $quant = $linha['QUANTIDADE'];
        
    }
    
    $this->Conexao->fecharBanco();
    return $quant;
    
}
public function contarTodosCargoDesbloqueado(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM CARGO ".
        " WHERE SITUACAO = 0";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $quant = $linha['QUANTIDADE'];
        
    }
    
    $this->Conexao->fecharBanco();
    return $quant;
}
public function  listaCargo(){
    $listaCargos = '';
    
    $codigoSQL ="SELECT * FROM CARGO ".
        " ORDER BY ID";
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $Cargo = new Cargo();
            
            $Cargo->setId($linha['ID']);
            $Cargo->setNome($linha['NOME']);
            $Cargo->setUsuario($linha['IDUSUARIO']);
            $Cargo->setSituacao($linha['SITUACAO']);
            
            $listaCargos[$contador] = $Cargo;
            $contador++;
        }
    }
    
    $this->Conexao->fecharBanco();
    return $listaCargos;
    
}
    public function  listaCargosBloqueados(){
        $listaCargos = '';
        
        $codigoSQL ="SELECT * FROM CARGO".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Cargo = new Cargo();
                
                $Cargo->setId($linha['ID']);
                $Cargo->setNome($linha['NOME']);
                $Cargo->setUsuario($linha['IDUSUARIO']);
                $Cargo->setSituacao($linha['SITUACAO']);
                
                $listaCargos[$contador] = $Cargo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaCargos;
    }
    public function  listaCargosDesbloqueados(){
        $listaCargos = '';
       
        $codigoSQL ="SELECT * FROM CARGO WHERE SITUACAO = 0 ORDER BY NOME ";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $Cargo = new Cargo();
                
                $Cargo->setId($linha['ID']);
                $Cargo->setNome($linha['NOME']);
                $Cargo->setUsuario($linha['IDUSUARIO']);
                $Cargo->setSituacao($linha['SITUACAO']);
                
                $listaCargos[$contador] = $Cargo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaCargos;
    }
    
}