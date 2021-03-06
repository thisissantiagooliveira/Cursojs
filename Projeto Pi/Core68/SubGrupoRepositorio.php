<?php
namespace src;

include_once ' src/SubGrupo.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class SubGrupoRepositorio
{
    
    private $Conexao;
    private $SubGrupo;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->SubGrupo = new SubGrupo();
    }
    public function CadastrarSubGrupo($SubGrupo) {
        $retorno= FALSE;
        $this-> SubGrupo = $SubGrupo;
        $codigoSQL = "INSERT INTO SUBGRUPO(NOME,IDUSUARIO,IDGRUPO,SITUACAO)";
        " VALUES ('".$this->SubGrupo->getNome()."','". $this->SubGrupo->getUsuario()->getId().",'".$this->SubGrupo->getGrupo()."', 0)";
        
        
        $this->Conexao->abrirConexao();
        if ($this->Conexao->getConexao()->query($codigoSQL)) {
            $retorno = TRUE;
        } else {
            echo ("Falha no cadastro do SubGrupo" .
                mysqli_error($this->Conexao->getConexao()));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
    
    public function consultarSubGrupoPorNome($SubGrupo)
    {
        $this->SubGrupo = $SubGrupo;
        
        $codigoSQL = "SELECT * FROM SUBGRUPO  WHERE NOME = '".$this->SubGrupo->getNome()."' AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->SubGrupo->setId($linha['ID']);
            $this->SubGrupo->setNome($linha['NOME']);
            $this->SubGrupo->setGrupo($linha['IDGRUPO']);
            $this->SubGrupo->setSituacao($linha['SITUACAO']);
            $this->SubGrupo->setUsuario($linha['IDUSUARIO']);
            
        } else {
            print "SubGrupo inválido";
        }
        $this->Conexao->fecharBanco();
        
        return $this->SubGrupo;
    }
    
    public function alterarSubGrupo($SubGrupo){
        $retorno = FALSE;
        $this->SubGrupo= $SubGrupo;
        $codigoSQL = "UPDATE SUBGRUPO  SET ".
            " NOME = '".$this->SubGrupo->getNome()."', ".
            " WHERE ID = ".$this->SubGrupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão do SubGrupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function bloquearSubGrupo($SubGrupo){
        $retorno = FALSE;
        
        $this->SubGrupo = $SubGrupo;
        
        $codigoSQL="UPDATE SUBGRUPO  SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->SubGrupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o SubGrupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function desbloquearSubGrupo($SubGrupo){
        $retorno = FALSE;
        $this->SubGrupo = SubGrupo;
        
        $codigoSQL = "UPDATE SubGrupo SET".
            " SITUACAO = 0 WHERE ID = ".$this->SubGrupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o SubGrupo ");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function excluirSubGrupo($SubGrupo){
        $retorno = FALSE;
        $this->SubGrupo =$SubGrupo;
        
        $codigoSQL ="DELETE FROM SUBGRUPO ".
            " WHERE ID = ".$this->SubGrupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o SubGrupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarSubGrupoBloqueadoPorNome($SubGrupo){
        $this->SUBGRUPO  = $SubGrupo;
        
        $codigoSQL= "SELECT * FROM SUBGRUPO ".
            " WHERE NOME ='".$this->SubGrupo->getNome()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $this->SubGrupo->setId($linha['ID']);
            $this->SubGrupo->setNome($linha['NOME']);
            $this->SubGrupo->setSituacao($linha['SITUACAO']);
            $this->SubGrupo->setUsuario($linha['USUARIO']);
            
        } else {
            print "SubGrupo não existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Grupo;
    }
    public function consultaSubGrupoPorId($SubGrupo){
        $this->SUBGRUPO  = $SubGrupo;
        
        $codigoSQL = "SELECT * FROM SubGrupo".
            " WHERE ID = ".$this->SubGrupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            if($nLinha > 0){
                $linha = mysqli_fetch_assoc($resultado);
                $this->SubGrupo->setId($linha['ID']);
                $this->SubGrupo->setNome($linha['NOME']);
                $this->SubGrupo->setSituacao($linha['SITUACAO']);
                $this->SubGrupo->setUsuario($linha['USUARIO']);
                
            } else {
                print "SubGrupo não existe";
            }
            $this->Conexao->fecharBanco();
            
            return $this->SubGrupo;
        }
        
    }
    public function contarSubGrupo(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM SUBGRUPO  ";
        
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
    public function contarTodosSubGrupoBloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM SUBGRUPO  ".
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
    public function contarTodosSubGruposDesbloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM SUBGRUPO ".
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
    public function  listaSubGrupos(){
        $listaSubGrupos = '';
        
        $codigoSQL ="SELECT * FROM SubGrupo".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $SubGrupo = new SubGrupo();
                
                $this->SubGrupo->setId($linha['ID']);
                $this->SubGrupo->setNome($linha['NOME']);
                $this->SubGrupo->setSituacao($linha['SITUACAO']);
                $this->SubGrupo->setUsuario($linha['USUARIO']);
                
                $listaSubGrupos[$contador] = $SubGrupo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaSubGrupos;
    }
    
    public function  listaSubGruposBloqueados(){
        $listaSubGrupos = '';
        
        $codigoSQL ="SELECT * FROM SubGrupo".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $SubGrupo = new SubGrupo();
                
                $this->SubGrupo->setId($linha['ID']);
                $this->SubGrupo->setNome($linha['NOME']);
                $this->SubGrupo->setSituacao($linha['SITUACAO']);
                $this->SubGrupo->setUsuario($linha['USUARIO']);
                
                $listaSubGrupos[$contador] = $SubGrupo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaSubGrupos;
    }
    
    public function  listaSubGruposDesbloqueados(){
        $listaSubGrupos = '';
        
        $codigoSQL ="SELECT * FROM SUBGRUPO WHERE SITUACAO = 0 ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $SubGrupo = new SubGrupo();
                
                $this->SubGrupo->setId($linha['ID']);
                $this->SubGrupo->setNome($linha['NOME']);
                $this->SubGrupo->setSituacao($linha['SITUACAO']);
                $this->SubGrupo->setUsuario($linha['USUARIO']);
                
                $listaSubGrupos[$contador] = $SubGrupo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaSubGrupos;
    }
    
    
}
