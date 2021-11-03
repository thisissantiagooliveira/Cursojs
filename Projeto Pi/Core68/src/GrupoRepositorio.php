<?php
namespace src;

include_once 'Grupo.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class GrupoRepositorio
{
    
    private $Conexao;
    private $Grupo;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Grupo = new Grupo();
    }
    public function CadastrarGrupo($Grupo) {
        $retorno= FALSE;
        $this-> Grupo = $Grupo;
        $codigoSQL = "INSERT INTO GRUPO(NOME,IDUSUARIO,SITUACAO)".
        " VALUES ('".$this->Grupo->getNome()."',".$this->Grupo->getUsuario()->getId().", 0)";
        

        $this->Conexao->abrirConexao();
        if ($this->Conexao->getConexao()->query($codigoSQL)) {
            $retorno = TRUE;
        } else {
            echo ("Falha no cadastro do Grupo" . 
                mysqli_error($this->Conexao->getConexao()));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
    
    public function consultarCargoPorNome($Grupo)
    {
        $this->Grupo = $Grupo;
        
        $codigoSQL = "SELECT * FROM GRUPO WHERE NOME = '".$this->Grupo->getNome()."' AND SITUACAO = 0";
       
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Grupo->setId($linha['ID']);
            $this->Grupo->setNome($linha['NOME']);
            $this->Grupo->setSituacao($linha['SITUACAO']);
            $this->Grupo->setUsuario($linha['IDUSUARIO']);
            
        } else {
            print "Grupo inválido";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Grupo;
    }
    
    public function alterarGrupo($Grupo){
        $retorno = FALSE;
        $this->Grupo= $Grupo;
        $codigoSQL = "UPDATE GRUPO SET ".
            " NOME = '".$this->Grupo->getNome()."', ".
            " IDUSUARIO =".$this->Grupo->getUsuario()->getId() ." ".
            " WHERE ID = ".$this->Grupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão do Grupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function bloquearGrupo($Grupo){
        $retorno = FALSE;
        
        $this->Grupo = $Grupo;
        
        $codigoSQL="UPDATE GRUPO SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Grupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o Grupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function desbloquearGrupo($Grupo){
        $retorno = FALSE;
        $this->Grupo = $Grupo;
        
        $codigoSQL = "UPDATE GRUPO SET".
            " SITUACAO = 0 WHERE ID = ".$this->Grupo->getId()." ";
       
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o Grupo ");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function excluirGrupo($Grupo){
        $retorno = FALSE;
        $this->Grupo =$Grupo;
        
        $codigoSQL ="DELETE FROM GRUPO".
            " WHERE ID = ".$this->Grupo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o Grupo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarGrupoBloqueadoPorNome($Grupo){
        $this->Grupo = $Grupo;
        
        $codigoSQL= "SELECT * FROM GRUPO".
            " WHERE NOME ='".$this->Grupo->getNome()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $this->Grupo->setId($linha['ID']);
            $this->Grupo->setNome($linha['NOME']);
            $this->Grupo->setSituacao($linha['SITUACAO']);
            $this->Grupo->setUsuario($linha['IDUSUARIO']);
            
        } else {
            print "Grupo não existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Grupo;
    }
    
    
    
    public function consultarGrupoDesbloqueadoPorNome($Grupo){
        $this->Grupo = $Grupo;
        
        $codigoSQL= "SELECT * FROM GRUPO".
            " WHERE NOME ='".$this->Grupo->getNome()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $this->Grupo->setId($linha['ID']);
            $this->Grupo->setNome($linha['NOME']);
            $this->Grupo->setSituacao($linha['SITUACAO']);
            $this->Grupo->setUsuario($linha['IDUSUARIO']);
            
        } else {
            print "Grupo não existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Grupo;
    }
    
    
    public function consultaGrupoPorId($Grupo){
        $this->Grupo= $Grupo;
        
        $codigoSQL = "SELECT * FROM GRUPO".
            " WHERE ID = ".$this->Grupo->getId()." ";
        echo $codigoSQL;
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            if($nLinha > 0){
                $linha = mysqli_fetch_assoc($resultado);
                $this->Grupo->setId($linha['ID']);
                $this->Grupo->setNome($linha['NOME']);
                $this->Grupo->setSituacao($linha['SITUACAO']);
                $this->Grupo->setUsuario($linha['IDUSUARIO']);
                
            } else {
                print "Grupo não existe";
            }
            $this->Conexao->fecharBanco();
            
            return $this->Grupo;
        }
        
    }
        public function contarGrupos(){
            $quant = 0;
            
            $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
                " FROM GRUPO ";
            
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
        public function contarTodosGrupoBloqueado(){
            $quant = 0;
            
            $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
                " FROM GRUPO ".
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
        public function contarTodosGruposDesbloqueado(){
            $quant = 0;
            
            $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
                " FROM GRUPO ".
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
        public function  listaGrupos(){
            $listaGrupos = '';
            
            $codigoSQL ="SELECT * FROM GRUPO ".
                " ORDER BY ID";
            $this->Conexao->abrirConexao();
            
            $resultado = $this->Conexao->getConexao()->query($codigoSQL);
            
            $nLinha = mysqli_num_rows($resultado);
            
            if($nLinha > 0){
                $contador = 0;
                while($linha = mysqli_fetch_assoc($resultado)){
                    $Grupo = new Grupo();
                    
                    $Grupo->setId($linha['ID']);
                    $Grupo->setNome($linha['NOME']);
                    $Grupo->setSituacao($linha['SITUACAO']);
                    $Grupo->setUsuario($linha['IDUSUARIO']);
                    
                    $listaGrupos[$contador] = $Grupo;
                    $contador++;
                }
            }
            
            $this->Conexao->fecharBanco();
            return $listaGrupos;
        }
        
        public function  listaGruposBloqueados(){
            $listaGrupos = '';
            
            $codigoSQL ="SELECT * FROM GRUPO".
                " WHERE SITUACAO = 1".
                " ORDER BY NOME";
            
            $this->Conexao->abrirConexao();
            
            $resultado = $this->Conexao->getConexao()->query($codigoSQL);
            
            $nLinha = mysqli_num_rows($resultado);
            
            if($nLinha > 0){
                $contador = 0;
                while($linha = mysqli_fetch_assoc($resultado)){
                    
                    $Grupo = new Grupo();
                    
                    $Grupo->setId($linha['ID']);
                    $Grupo->setNome($linha['NOME']);
                    $Grupo->setSituacao($linha['SITUACAO']);
                    $Grupo->setUsuario($linha['IDUSUARIO']);
                    
                    $listaGrupos[$contador] = $Grupo;
                    $contador++;
                }
            }
            
            $this->Conexao->fecharBanco();
            return $listaGrupos;
        }
    
        public function  listaGruposDesbloqueados(){
            $listaGrupos = '';
            
            $codigoSQL ="SELECT * FROM GRUPO WHERE SITUACAO = 0 ORDER BY NOME";
            
            $this->Conexao->abrirConexao();
            
            $resultado = $this->Conexao->getConexao()->query($codigoSQL);
            
            $nLinha = mysqli_num_rows($resultado);
            
            if($nLinha > 0){
                $contador = 0;
                while($linha = mysqli_fetch_assoc($resultado)){
                    
                    $Grupo = new Grupo();
          
                    $Grupo->setId($linha['ID']);
                    $Grupo->setNome($linha['NOME']);
                    $Grupo->setSituacao($linha['SITUACAO']);
                    $Grupo->setUsuario($linha['IDUSUARIO']);
                    
                    $listaGrupos[$contador] = $Grupo;
                    $contador++;
                }
            }
            
            $this->Conexao->fecharBanco();
            return $listaGrupos;
        }
             

}
