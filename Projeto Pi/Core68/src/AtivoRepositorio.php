<?php

namespace src;

include_once 'Ativo.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class AtivoRepositorio
{
    
    private $Conexao;
    private $Usuario;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Ativo = new Ativo();
    }
    public function  cadastrarAtivo($Ativo){
        $retorno = FALSE;
        $this->Ativo = $Ativo;
        
        $codigoSQL = "INSERT INTO ATIVO(NOME,CODIGOBARRA,DESCRICAO,DATACAD,IDSUBGRUPO,IDUSUARIO,IDAMBIENTE,IDSTATUS,SITUACAO)".
            " VALUES ('".$this->Ativo->getNome()."','".$this->Ativo->getCodigobarra()."','".$this->Ativo->getDescricao()."','".$this->Ativo->getData()."',".$this->Ativo->getSubGrupo()->getId().",".
            $this->Ativo->getUsuario()->getId().",".$this->Ativo->getAmbiente()->getId().",'".$this->Ativo->getStatus()."', 0)";
            
            $this->Conexao->abrirConexao();
            if( $this->Conexao->getConexao()->query($codigoSQL)){
                $retorno = TRUE;
            }
            else{
                echo("Falha no cadastro do Ativo".mysqli_error($this->Conexao->getConexao()));
            }
            $this->Conexao->fecharBanco();
            return $retorno;
            
    }
    
    public function consultarAtivoPorNome($Ativo)
    {
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO WHERE NOME = '" . $this->Ativo->getNome() . "' AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        if ($numeroLinhas > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $this->Ativo->setAmbinte($linha['IDAMBIENTE']);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $this->Ativo->setSubGrupo($linha['IDSUBGRUPO']);
            
        }  else {
            print "Ativo inv??lido";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function alterarAtivo($Ativo){
        $retorno = FALSE;
        
        $this->Ativo = $Ativo;
        $codigoSQL = "UPDATE ATIVO SET ".
            " NOME = '".$this->Ativo->getNome()."', ".
            " DATACAD = '".$this->Ativo->getData()."', ".
            " IDSTATUS ='".$this->Ativo->getStatus()."', ".
            " IDAMBIENTE =".$this->Ativo->getAmbiente()->getId().", ".
            " IDUSUARIO = ".$this->Ativo->getUsuario()->getId().",".
            " IDSUBGRUPO = ".$this->Ativo->getSubGrupo()->getId().",".
            " CODIGOBARRA ='".$this->Ativo->getCodigobarra()."' ".
            " WHERE ID = ".$this->Ativo->getId()." ";

        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alterac??o do Ativo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function bloquearAtivo($Ativo){
        $retorno = FALSE;
        
        $this->Ativo = $Ativo;
        
        $codigoSQL="UPDATE ATIVO SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Ativo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o Ativo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function desbloquearAtivo($Ativo){
        $retorno = FALSE;
        $this->Ativo = $Ativo;
        
        $codigoSQL = "UPDATE ATIVO SET".
            " SITUACAO = 0 WHERE ID = ".$this->Ativo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o Ativo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function excluirAtivo($Ativo){
        $retorno = FALSE;
        $this->Unidade=$Ativo;
        
        $codigoSQL ="DELETE FROM ATIVO".
            " WHERE ID = ".$this->Ativo->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o Ativo");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarAtivoBloqueadoPorId($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL= "SELECT * FROM ATIVO".
            " WHERE ID ='".$this->Ativo->getId()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }

    public function consultarAtivoDesbloqueadoPorId($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL= "SELECT * FROM ATIVO".
            " WHERE ID ='".$this->Ativo->getId()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function  existeAtivo($Ativo){
        $retorno = FALSE;
        
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO".
            " WHERE CODIGOBARRA ='".$this->Ativo->getCodigobarra()."'";

        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $retorno = TRUE;
            
        }
        
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
    
    
    public function consultaAtivoPorId($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO".
            " WHERE ID = ".$this->Ativo->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function consultaAtivoPorCodigoBarra($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO".
            " WHERE CODIGOBARRA = ".$this->Ativo->getCodigobarra()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function consultaAtivoPorCodigoBarraDesbloqueado($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO".
            " WHERE CODIGOBARRA = ".$this->Ativo->getCodigobarra()." AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function consultaAtivoPorCodigoBarraBloqueado($Ativo){
        $this->Ativo = $Ativo;
        
        $codigoSQL = "SELECT * FROM ATIVO".
            " WHERE CODIGOBARRA = ".$this->Ativo->getCodigobarra()." AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Ativo->setId($linha['ID']);
            $this->Ativo->setNome($linha['NOME']);
            $this->Ativo->setData($linha['DATACAD']);
            $this->Ativo->setDescricao($linha['DESCRICAO']);
            $this->Ativo->setCodigobarra($linha['CODIGOBARRA']);
            $Ambiente = new Ambiente();
            $Ambiente->setId($linha['IDAMBIENTE']);
            $this->Ativo->setAmbiente($Ambiente);
            $this->Ativo->setStatus($linha['IDSTATUS']);
            $this->Ativo->setSituacao($linha['SITUACAO']);
            $this->Ativo->setUsuario($linha['IDUSUARIO']);
            $SubGrupo = new SubGrupo();
            $SubGrupo->getId($linha['IDSUBGRUPO']);
            $this->Ativo->setSubGrupo($SubGrupo);
            
        }  else {
            print "Ativo n??o existe";
        }
        $this->Conexao->fecharBanco();
        
        return $this->Ativo;
    }
    
    public function contarTodosAtivos(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ";
        
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
    
    public function contarTodosAtivosBloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ".
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
    
    public function contarTodosAtivosDesbloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ".
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
    
    public function  listarAtivo(){
        $listaAtivo = '';
        
        $codigoSQL ="SELECT * FROM ATIVO ".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
               $Ativo = new Ativo ();
               
               $Ativo->setId($linha['ID']);
               $Ativo->setNome($linha['NOME']);
               $Ativo->setData($linha['DATACAD']);
               $Ativo->setDescricao($linha['DESCRICAO']);
               $Ativo->setCodigobarra($linha['CODIGOBARRA']);
               $Ativo->setAmbiente($linha['IDAMBIENTE']);
               $Ativo->setStatus($linha['IDSTATUS']);
               $Ativo->setSituacao($linha['SITUACAO']);
               $Ativo->setUsuario($linha['IDUSUARIO']);
               $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
               
               $listaAtivo[$contador] = $Ativo;
               $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAtivo;
    }
    
    public function  listarAtivoBloqueados(){
        $listaAtivo = '';
        
        $codigoSQL ="SELECT * FROM ATIVO WHERE SITUACAO = 1".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $Ativo = new Ativo ();
                
                $Ativo->setId($linha['ID']);
                $Ativo->setNome($linha['NOME']);
                $Ativo->setData($linha['DATACAD']);
                $Ativo->setDescricao($linha['DESCRICAO']);
                $Ativo->setCodigobarra($linha['CODIGOBARRA']);
                $Ativo->setAmbiente($linha['IDAMBIENTE']);
                $Ativo->setStatus($linha['IDSTATUS']);
                $Ativo->setSituacao($linha['SITUACAO']);
                $Ativo->setUsuario($linha['IDUSUARIO']);
                $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
                
                $listaAtivo[$contador] = $Ativo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAtivo;
    }
    
    public function  listarAtivoDesbloqueados(){
        $listaAtivo = '';
        
        $codigoSQL ="SELECT * FROM ATIVO WHERE SITUACAO = 0".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $Ativo = new Ativo ();
                
                $Ativo->setId($linha['ID']);
                $Ativo->setNome($linha['NOME']);
                $Ativo->setData($linha['DATACAD']);
                $Ativo->setDescricao($linha['DESCRICAO']);
                $Ativo->setCodigobarra($linha['CODIGOBARRA']);
                $Ativo->setAmbiente($linha['IDAMBIENTE']);
                $Ativo->setStatus($linha['IDSTATUS']);
                $Ativo->setSituacao($linha['SITUACAO']);
                $Ativo->setUsuario($linha['IDUSUARIO']);
                $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
                
                $listaAtivo[$contador] = $Ativo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAtivo;
    }
    
    public function contarTodosAtivosPorIdAmbiente($idAmbiente){
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
    
    public function contarTodosAtivosPorIdAmbienteBloqueados($idAmbiente){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ".
            " WHERE IDAMBIENTE = $idAmbiente. AND SITUACAO = 1 ";
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
    
    public function listarAtivoPorIdAmbiente($idAmbiente)
    {
        $listaAtivo = '';
        
        $codigoSQL = "SELECT * FROM Ativo WHERE IDAMBIENTE = " . $idAmbiente . " ORDER BY NOME;";
        
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        
        if ($numeroLinhas > 0) {
            $contador = 0;
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $Ativo = new Ativo ();
                
                $Ativo->setId($linha['ID']);
                $Ativo->setNome($linha['NOME']);
                $Ativo->setData($linha['DATACAD']);
                $Ativo->setDescricao($linha['DESCRICAO']);
                $Ativo->setCodigobarra($linha['CODIGOBARRA']);
                $Ativo->setAmbiente($linha['IDAMBIENTE']);
                $Ativo->setStatus($linha['IDSTATUS']);
                $Ativo->setSituacao($linha['SITUACAO']);
                $Ativo->setUsuario($linha['IDUSUARIO']);
                $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
                
                
                $listaAtivo[$contador] = $Ativo;
                $contador ++;
            }
        }
        $this->Conexao->fecharBanco();
        
        return $listaAtivo;
    }
    
    public function listarAtivoPorIdAmbienteBloqueado($idAmbiente)
    {
        $listaAtivo = '';
        
        $codigoSQL = "SELECT * FROM ATIVO WHERE IDAMBIENTE = " . $idAmbiente . " AND SITUACAO = 1 ORDER BY NOME";
        
        echo $codigoSQL;
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        
        if ($numeroLinhas > 0) {
            $contador = 0;
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $Ativo = new Ativo ();
                
                $Ativo->setId($linha['ID']);
                $Ativo->setNome($linha['NOME']);
                $Ativo->setData($linha['DATACAD']);
                $Ativo->setDescricao($linha['DESCRICAO']);
                $Ativo->setCodigobarra($linha['CODIGOBARRA']);
                $Ativo->setAmbiente($linha['IDAMBIENTE']);
                $Ativo->setStatus($linha['IDSTATUS']);
                $Ativo->setSituacao($linha['SITUACAO']);
                $Ativo->setUsuario($linha['IDUSUARIO']);
                $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
                
                
                $listaAtivo[$contador] = $Ativo;
                $contador ++;
            }
        }
        $this->Conexao->fecharBanco();
        
        return $listaAtivo;
    }
    
    public function contarTodosAtivosPorIdAmbienteDesbloqueados($idAmbiente){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM ATIVO ".
            " WHERE IDAMBIENTE = $idAmbiente. AND SITUACAO = 0 ";
        echo $codigoSQL;
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
    
    public function listarAtivoPorIdAmbienteDesbloqueado($idAmbiente)
    {
        $listaAtivo = '';
        
        $codigoSQL = "SELECT * FROM ATIVO WHERE IDAMBIENTE = " . $idAmbiente . " AND SITUACAO = 0 ORDER BY NOME";
        
        echo $codigoSQL;
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $numeroLinhas = mysqli_num_rows($resultado);
        
        if ($numeroLinhas > 0) {
            $contador = 0;
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $Ativo = new Ativo ();
                
                $Ativo->setId($linha['ID']);
                $Ativo->setNome($linha['NOME']);
                $Ativo->setData($linha['DATACAD']);
                $Ativo->setDescricao($linha['DESCRICAO']);
                $Ativo->setCodigobarra($linha['CODIGOBARRA']);
                $Ativo->setAmbiente($linha['IDAMBIENTE']);
                $Ativo->setStatus($linha['IDSTATUS']);
                $Ativo->setSituacao($linha['SITUACAO']);
                $Ativo->setUsuario($linha['IDUSUARIO']);
                $Ativo->setSubGrupo($linha['IDSUBGRUPO']);
                
                
                $listaAtivo[$contador] = $Ativo;
                $contador ++;
            }
        }
        $this->Conexao->fecharBanco();
        
        return $listaAtivo;
    }
    
}
