<?php
namespace src;

include_once 'Ambiente.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class AmbienteRepositorio
{
    private $Conexao;
    private $Usuario;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Ambiente = new Ambiente();
    }
    public function CadastrarAmbiente($Ambiente) {
        $retorno= FALSE;
        $this->Ambiente = $Ambiente;
        $codigoSQL = "INSERT INTO AMBIENTE(NOME,DATA,DESCRICAO,IDUSUARIO,IDUNIDADE,SITUACAO)".
        " VALUES ('".$this->Ambiente->getNome()."','".$this->Ambiente->getData()."','".$this->Ambiente->getDescricao()."',".$this->Ambiente->getUsuario()->getId().",'".$this->Ambiente->getUnidade()->getId()."', 0)";
        
        $this->Conexao->abrirConexao();
        if ($this->Conexao->getConexao()->query($codigoSQL)) {
            $retorno = TRUE;
        } else {
            echo ("Falha no cadastro do Ambiente" . mysqli_error($this->Conexao->getConexao()));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarAmbientePorNome($Ambiente)
    {
        $this->Ambiente = $Ambiente;
        
        $codigoSQL = "SELECT * FROM AMBIENTE WHERE NOME = '" . $this->Ambiente->getNome() . "' AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ambiente->setId($linha['ID']);
            $this->Ambiente->setNome($linha['NOME']);
            $this->Ambiente->setData($linha['DATA']);
            $this->Ambiente->setDescricao($linha['DESCRICAO']);
            $this->Ambiente->setSituacao($linha['SITUACAO']);
            $this->Ambiente->setUsuario($linha['IDUSUARIO']);
            $this->Ambiente->setUnidade($linha['IDUNIDADE']);
            echo $codigoSQL;
            
        } else {
            print "Ambiente inválido";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ambiente;
    }
    public function alterarAmbiente($Ambiente){
        $retorno = FALSE;
        $this->Ambiente= $Ambiente;
        $codigoSQL = "UPDATE AMBIENTE SET ".
            " NOME = '".$this->Ambiente->getNome()."', ".
            " DESCRICAO = '".$this->Ambiente->getDescricao()."', ".
            " DATA ='".$this->Ambiente->getData()."'".
            " WHERE ID = ".$this->Ambiente->getId(). ";";
        
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão do Ambiente");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function bloquearAmbiente($Ambiente){
        $retorno = FALSE;
        
        $this->Ambiente = $Ambiente;
        
        $codigoSQL="UPDATE AMBIENTE SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Ambiente->getId()."";
 
   
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o Ambiente");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function desbloquearAmbiente($Ambiente){
        $retorno = FALSE;
        $this->Ambiente = $Ambiente;
        
        $codigoSQL = "UPDATE AMBIENTE SET".
            " SITUACAO = 0". 
        " WHERE ID = ".$this->Ambiente->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o Ambiente ");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function excluirAmbiente($Ambiente){
        $retorno = FALSE;
        $this->Ambiente =$Ambiente;
        
        $codigoSQL ="DELETE FROM AMBIENTE".
            " WHERE ID = ".$this->Ambiente->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o Ambiente");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
}
public function consultarAmbienteBloqueadoPorNome($Ambiente){
    $this->Ambiente = $Ambiente;
    
    $codigoSQL= "SELECT * FROM AMBIENTE".
        " WHERE NOME ='".$this->Ambiente->getNome()."'".
        " AND SITUACAO = 1";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
    
        $this->Ambiente->setId($linha['ID']);
        $this->Ambiente->setNome($linha['NOME']);
        $this->Ambiente->setData($linha['DATA']);
        $this->Ambiente->setDescricao($linha['DESCRICAO']);
        $this->Ambiente->setSituacao($linha['SITUACAO']);
        $this->Ambiente->setUsuario($linha['IDUSUARIO']);
        $this->Ambiente->setUnidade($linha['IDUNIDADE']);
    }
    else{
        echo "Ambiente não existe";
    }
    $this->Conexao->fecharBanco();
    return $this->Ambiente;
}

public function consultaAmbientePorId($Ambiente){
    $this->Ambiente= $Ambiente;
    
    $codigoSQL = "SELECT * FROM AMBIENTE".
        " WHERE ID = ".$this->Ambiente->getId()." ";
    
    $this->Conexao->abrirConexao();
    
    $resultado= $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $linha = mysqli_fetch_assoc($resultado);
        
        $this->Ambiente->setId($linha['ID']);
        $this->Ambiente->setNome($linha['NOME']);
        $this->Ambiente->setData($linha['DATA']);
        $this->Ambiente->setDescricao($linha['DESCRICAO']);
        $this->Ambiente->setSituacao($linha['SITUACAO']);
        
        $Unidade = new Unidade();
        $Unidade->setId($linha['IDUNIDADE']);
        
        $this->Ambiente->setUsuario($linha['IDUSUARIO']);
        $this->Ambiente->setUnidade($Unidade);
    }
    else{
        echo "Este CODIGO n�o existe";
    }
    $this->Conexao->fecharBanco();
    return $this->Ambiente;
}
public function contarAmbientes(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM AMBIENTE ";
    
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
    
public function contarTodosAmbienteBloqueado(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM AMBIENTE ".
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
    public function contarTodosAmbientesDesbloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM AMBIENTE ".
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
    public function  listaAmbientes(){
        $listaAmbientes = '';
        
        $codigoSQL ="SELECT * FROM AMBIENTE ".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Ambiente = new Ambiente();
                
                $Ambiente->setId($linha['ID']);
                $Ambiente->setNome($linha['NOME']);
                $Ambiente->setData($linha['DATA']);
                $Ambiente->setDescricao($linha['DESCRICAO']);
                $Ambiente->setSituacao($linha['SITUACAO']);
                $Ambiente->setUsuario($linha['IDUSUARIO']);
                $Ambiente->setUnidade($linha['IDUNIDADE']);
                
                $listaAmbientes[$contador] = $Ambiente;
                $contador++;
            }
        }

        $this->Conexao->fecharBanco();
        return $listaAmbientes;
    }
    
    public function  listaAmbientesBloqueados(){
        $listaAmbientes = '';
        
        $codigoSQL ="SELECT * FROM AMBIENTE".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Ambiente = new Ambiente();
                
                $Ambiente->setId($linha['ID']);
                $Ambiente->setNome($linha['NOME']);
                $Ambiente->setData($linha['DATA']);
                $Ambiente->setDescricao($linha['DESCRICAO']);
                $Ambiente->setSituacao($linha['SITUACAO']);
                $Ambiente->setUsuario($linha['IDUSUARIO']);
                $Ambiente->setUnidade($linha['IDUNIDADE']);
                
                $listaAmbientes[$contador] = $Ambiente;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAmbientes;
    }
    
    public function  listaAmbientesDesbloqueados(){
        $listaAmbiente = '';
        
        $codigoSQL ="SELECT * FROM AMBIENTE WHERE SITUACAO = 0 ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
               
                $Ambiente = new Ambiente();
                
                $Ambiente->setId($linha['ID']);
                $Ambiente->setNome($linha['NOME']);
                $Ambiente->setData($linha['DATA']);
                $Ambiente->setDescricao($linha['DESCRICAO']);
                $Ambiente->setSituacao($linha['SITUACAO']);
                $Ambiente->setUsuario($linha['IDUSUARIO']);
                $Ambiente->setUnidade($linha['IDUNIDADE']);
                
                $listaAmbiente[$contador] = $Ambiente;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAmbiente;
    }
    
    public function listarAmbientePorIdUnidade($idUnidade)
    {
        $listaAmbiente = '';
        
        $codigoSQL = "SELECT * FROM AMBIENTE WHERE IDUNIDADE = " . $idUnidade . " ORDER BY NOME;";
       
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        
        if ($numeroLinhas > 0) {
            $contador = 0;
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $Ambiente = new Ambiente();
       
                $Ambiente->setId($linha['ID']);
                $Ambiente->setNome($linha['NOME']);
                $Ambiente->setData($linha['DATA']);
                $Ambiente->setDescricao($linha['DESCRICAO']);
                $Ambiente->setSituacao($linha['SITUACAO']);
                $Ambiente->setUsuario($linha['IDUSUARIO']);
                $Ambiente->setUnidade($linha['IDUNIDADE']);
              
                
                $listaAmbiente[$contador] = $Ambiente;
                $contador ++;
            }
        }
        $this->Conexao->fecharBanco();
        
        return $listaAmbiente;
    }
    
    public function contarTodosAmbientePorIdUnidade($idUnidade){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM AMBIENTE ".
            " WHERE IDUNIDADE = $idUnidade. ";
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
    public function consultarAmbientedesbloqueadoPorNome($Ambiente){
        $this->Ambiente = $Ambiente;
        
        $codigoSQL= "SELECT * FROM AMBIENTE".
            " WHERE NOME ='".$this->Ambiente->getNome()."'".
            " AND SITUACAO = 0";
  
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ambiente->setId($linha['ID']);
            $this->Ambiente->setNome($linha['NOME']);
            $this->Ambiente->setData($linha['DATA']);
            $this->Ambiente->setDescricao($linha['DESCRICAO']);
            $this->Ambiente->setSituacao($linha['SITUACAO']);
            $this->Ambiente->setUsuario($linha['IDUSUARIO']);
            $this->Ambiente->setUnidade($linha['IDUNIDADE']);
        }
        else{
            echo "Ambiente não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Ambiente;
    }
    
    public function listarAtivoPorIdAmbiente($IdAtivo)
    {
        $listaAtivo = '';
        
        $codigoSQL = "SELECT * FROM ATIVO WHERE IDAMBIENTE = " . $IdAtivo. " ORDER BY NOME;";
        
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        
        if ($numeroLinhas > 0) {
            $contador = 0;
            while ($linha = mysqli_fetch_assoc($resultado)) {
                
                $Ambiente = new Ambiente();
                
                $Ambiente->setId($linha['ID']);
                $Ambiente->setNome($linha['NOME']);
                $Ambiente->setDescricao($linha['DESCRICAO']);
                $Ambiente->setSituacao($linha['SITUACAO']);
                $Ambiente->setUsuario($linha['IDUSUARIO']);
                
                
                $listaAtivo[$contador] = $Ambiente;
                $contador ++;
            }
        }
        $this->Conexao->fecharBanco();
        
        return $listaAtivo;
    }
            
         
    public function contarTodosAtivoPorIdAmbiente($idAmbiente){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ".
            " WHERE IDAMBIENTE = $idAmbiente. ";
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
    
}