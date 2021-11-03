<?php
namespace src;

include_once 'Unidade.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class UnidadeRepositorio
{
    
    private $Conexao;
    private $Usuario;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Unidade = new Unidade();
    }
    public function  cadastrarUnidade($Unidade){
        $retorno = FALSE;
        $this->Unidade = $Unidade;
        $codigoSQL = "INSERT INTO UNIDADE(NOME,DATA,SIGLA,IDUSUARIO,ENDERECO,SITUACAO)".
            " VALUES ('".$this->Unidade->getNome()."','".$this->Unidade->getData()."','".$this->Unidade->getSigla()."',".$this->Unidade->getUsuario()->getId().",'".$this->Unidade->getEndereco()."', 0)";
        
        $this->Conexao->abrirConexao();
        if( $this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha no cadastro do unidade".mysqli_error($this->Conexao->getConexao()));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
    public function consultarUnidadePorNome($Unidade)
    {
        $this->Unidade = $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE WHERE NOME = '" . $this->Unidade->getNome() . "' AND SITUACAO = 0";
     
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
        } else {
            print "Unidade inválida";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Unidade;
    }
    public function consultarUnidadePorSigla($Unidade)
    {
        $this->Unidade = $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE WHERE SIGLA = '" . $this->Unidade->getSigla() . "' AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            
        } else {
            print "Unidade inválida";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Unidade;
    }
    public function alterarUnidade($Unidade){
        $retorno = FALSE;
        $this->Unidade= $Unidade;
        $codigoSQL = "UPDATE UNIDADE SET ".
            " NOME = '".$this->Unidade->getNome()."', ".
            " SIGLA = '".$this->Unidade->getSigla()."', ".
            " ENDERECO = '".$this->Unidade->getEndereco()."', ".
            " DATA = '".$this->Unidade->getData()."', ".
            " IDUSUARIO =".$this->Unidade->getUsuario()->getId() ." ".
            " WHERE ID = ".$this->Unidade->getId()." ";

        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão da Unidade");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function  existeUnidade($Unidade){
        $retorno = FALSE;
        $this->Unidade = $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE".
            " WHERE NOME  = '" . $this->Unidade->getNome()."','".
            " WHERE SIGLA = '".$this->Unidade->getSigla()."',".
            " AND ID = ".$this->Unidade->getId();
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $retorno = TRUE;
            
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function bloquearUnidade($Unidade){
        $retorno = FALSE;
        
        $this->Unidade = $Unidade;
        
        $codigoSQL="UPDATE UNIDADE SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Unidade->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear a Unidade");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function desbloquearUnidade($Unidade){
        $retorno = FALSE;
        $this->Unidade = $Unidade;
        
        $codigoSQL = "UPDATE UNIDADE SET".
            " SITUACAO = 0 WHERE ID = ".$this->Unidade->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear a Unidade");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function excluirUnidade($Unidade){
        $retorno = FALSE;
        $this->Unidade =$Unidade;
        
        $codigoSQL ="DELETE FROM UNIDADE".
            " WHERE ID = ".$this->Unidade->getId()." ";
        echo $codigoSQL;
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir a Unidade");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarUnidadeBloqueadoPorNome($Unidade){
        $this->Unidade = $Unidade;
        
        $codigoSQL= "SELECT * FROM UNIDADE".
            " WHERE NOME ='".$this->Unidade->getNome()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
            
        }
        else{
            echo "Unidade não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Unidade;
    }
    
    
    public function consultarUnidadeDesbloqueadoPorNome($Unidade){
        $this->Unidade = $Unidade;
        
        $codigoSQL= "SELECT * FROM UNIDADE".
            " WHERE NOME ='".$this->Unidade->getNome()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
            
        }
        else{
            echo "Unidade não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Unidade;
    }
    
    public function consultaUnidadePorId($Unidade){
        $this->Unidade= $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE".
            " WHERE ID = ".$this->Unidade->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
        
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
        }
        else{
            echo "Este CODIGO n�o existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Unidade;
    }
    public function  consultarUnidadeBloqueadoPorSigla($Unidade){
        $this->Unidade = $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE".
            " WHERE SIGLA = '".$this->Unidade->getSigla()."' ".
            "AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
            
        } else {
            echo "Esta Sigla não existe ";
        }
        $this->Conexao->fecharBanco();
        return $this->Unidade;
    }
    
    public function  consultarUnidadeDesbloqueadoPorSigla($Unidade){
        $this->Unidade = $Unidade;
        
        $codigoSQL = "SELECT * FROM UNIDADE".
            " WHERE SIGLA = '".$this->Unidade->getSigla()."' ".
            "AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Unidade->setId($linha['ID']);
            $this->Unidade->setNome($linha['NOME']);
            $this->Unidade->setSigla($linha['SIGLA']);
            $this->Unidade->setEndereco($linha['ENDERECO']);
            $this->Unidade->setData($linha['DATA']);
            $this->Unidade->setSituacao($linha['SITUACAO']);
            $this->Unidade->setUsuario($linha['IDUSUARIO']);
            
        } else {
            echo "Esta Sigla não existe ";
        }
        $this->Conexao->fecharBanco();
        return $this->Unidade;
    }
    
    
    
    public function contarTodasUnidades(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM UNIDADE ";

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
    public function contarTodasUnidadesBloqueada(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM UNIDADE ".
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
    public function contarTodasUnidadesDesbloqueada(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM UNIDADE ".
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
    public function  listaUnidades(){
        $listaUnidades = '';
        
        $codigoSQL ="SELECT * FROM UNIDADE ".
            " ORDER BY ID";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Unidade = new Unidade();
                
                
                $Unidade->setId($linha['ID']);
                $Unidade->setNome($linha['NOME']);
                $Unidade->setSigla($linha['SIGLA']);
                $Unidade->setEndereco($linha['ENDERECO']);
                $Unidade->setData($linha['DATA']);
                $Unidade->setUsuario($linha['IDUSUARIO']);
                $Unidade->setSituacao($linha['SITUACAO']);
               
                $listaUnidades[$contador] = $Unidade;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUnidades;
    }
    public function  listaUnidadesBloqueadas(){
        $listaUnidades = '';
        
        $codigoSQL ="SELECT * FROM UNIDADE".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Unidade = new Unidade();
                
                
                $Unidade->setId($linha['ID']);
                $Unidade->setNome($linha['NOME']);
                $Unidade->setSigla($linha['SIGLA']);
                $Unidade->setEndereco($linha['ENDERECO']);
                $Unidade->setData($linha['DATA']);
                $Unidade->setSituacao($linha['SITUACAO']);
                $Unidade->setUsuario($linha['IDUSUARIO']);
                
                $listaUnidades[$contador] = $Unidade;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUnidades;
    }
    public function  listaUnidadesDesbloqueadas(){
        $listaUnidades = '';
        
        $codigoSQL ="SELECT * FROM UNIDADE WHERE SITUACAO = 0 ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Unidade = new Unidade();
                
                $Unidade->setId($linha['ID']);
                $Unidade->setNome($linha['NOME']);
                $Unidade->setSigla($linha['SIGLA']);
                $Unidade->setEndereco($linha['ENDERECO']);
                $Unidade->setData($linha['DATA']);
                $Unidade->setSituacao($linha['SITUACAO']);
                $Unidade->setUsuario($linha['IDUSUARIO']);
                
                $listaUnidades[$contador] = $Unidade;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUnidades;
    }
    
    
}
