<?php
namespace src;

include_once 'Movimentacao.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class MovimentacaoRepositorio
{
    
    private $Conexao;
    private $Movimentacao;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Movimentacao = new Movimentacao();
    }
    public function CadastrarMovimentacao($Movimentacao) {
        $retorno= FALSE;
        $this->Movimentacao = $Movimentacao;
        $codigoSQL = "INSERT INTO MOVIMENTACAO(IDSTATUS,DATACADMOV,DATAENTRADA,DATASAIDA,MOTIVO,DESCRICAO,IDUSUARIO,IDATIVO,IDAMBIENTEORIGEM,IDAMBIENTEDESTINO,SITUACAO)".
        " VALUES ('".$this->Movimentacao->getStatus()."','". 
        $this->Movimentacao->getDataCad()."','".
        $this->Movimentacao->getDataEntrada()."','".
        $this->Movimentacao->getDataSaida()."','". 
        $this->Movimentacao->getMotivo()."','".
        $this->Movimentacao->getDescricao()."',".
        $this->Movimentacao->getUsuario()->getId().",".
        $this->Movimentacao->getAtivo()->getId().",".
        $this->Movimentacao->getAmbienteorigem()->getId().",".
        $this->Movimentacao->getAmbientedestino()->getId().",0)";
     echo $codigoSQL;
     
        $this->Conexao->abrirConexao();
        if ($this->Conexao->getConexao()->query($codigoSQL)) {
            $retorno = TRUE;
        } else {
            echo ("Falha no cadastro da Movimenção" . mysqli_error($this->Conexao->getConexao()));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }

    public function  existeMovimentacao($Movimentacao){
        $retorno = FALSE;
        $this->Movimentacao = $Movimentacao;
        
        $codigoSQL = "SELECT * FROM MOVIMENTACAO".
		  " AND DATAENTRADA = '" . $this->Movimentacao->getDataEntrada()." ,' '".
            " ANDIDAMBIENTE = '".$this->Movimentacao->getAmbiente()->getId( )."',".
    
	    
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $retorno = TRUE;
            
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
	
	  public function consultaMovimentacaoPorId($Movimentacao){
        $this->Movimentacao= $Movimentacao;
        
        $codigoSQL = "SELECT * FROM MOVIMENTACAO".
            " WHERE ID = ".$this->Movimentacao->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
			
			$this->Movimentacao->setId($linha['ID']);
            $this->Movimentacao->setDatacad($linha['DATACAD']);
            $this->Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $this->Movimentacao->setDatasaida($linha['DATASAIDA']);
            $this->Movimentacao->setMotivo($linha['MOTIVO']);
            $this->Movimentacao->setDescricao($linha['DESCRICAO']);
            $this->Movimentacao->setUsuario($linha['IDUSUARIO']);
			$this->Movimentacao->setAtivo($linha['IDATIVO']);
			$this->Movimentacao->setAmbiente($linha['IDAMBIENTE']);
			$this->Movimentacao->setStatus($linha['IDSTATUS']);
			 
        }
        else{
            echo "Este Codigo não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Movimentacao;
    }
	public function alterarMovimentacao($Movimentacao){
        $retorno = FALSE;
        $this->Movimentacao= $Movimentacao;
        $codigoSQL = "UPDATE MOVIMENTACAO SET ".
		
		"IDATIVO =  ".$this->Movimentacao->getAtivo()->getId()." ".
		"IDUSUARIO=  ".$this->Movimentacao->getUsuario()->getId()." ".
		"IDAMBIENTE = ". $this->Movimentacao->getAmbiente().getId(). ",". 
		"DESCRICAO = '".$this->Movimentacao->getDescricao()  ."',". 
		"DATAENTRADA = ". $this->Movimentacao->getDataentrada() . "',". 
		"DATASAIDA = '". $this->Movimentacao->getDatasaida()  ."',". 
		"MOTIVO = ".$this->Movimentacao->getMotivo()  ."',". 
		"DATACAD=".$this->Movimentacao->getDataCad()."',". 
		"STATUS=".$this->Movimentacao->getStatus().".".
		"WHERE ID = " .$this->Movimentacao->getId();
		
		   $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão da Movimentacao");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }

	public function excluirMovimentacao($Movimentacao){
        $retorno = FALSE;
        $this->Movimentacao  =$Movimentacao;
        
        $codigoSQL ="DELETE FROM UNIDADE".
            " WHERE ID = ".$this->Unidade->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir a Movimentacao");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
	
	 public function contarTodasMovimentacao(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM MOVIMENTACAO";
        
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
    
    
    public function  listaAtivosDesbloqueados(){
        $listaAtivos = '';
        
        $codigoSQL ="SELECT * FROM ATIVO WHERE SITUACAO = 0 ORDER BY NOME";
        
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
                
                $listaAtivos[$contador] = $Ativo;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaAtivos;
    }
    
    
    
    public function  listaAtivoMovimentacao(){
        $listaAtivos = '';
        
        $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 2 ORDER BY MOTIVO";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                
                $Movimentacao = new Movimentacao();
                
                $Movimentacao->setId($linha['ID']);
                $Movimentacao->setDatacad($linha['DATACADMOV']);
                $Movimentacao->setDataentrada($linha['DATAENTRADA']);
                $Movimentacao->setDatasaida($linha['DATASAIDA']);
                $Movimentacao->setMotivo($linha['MOTIVO']);
                $Movimentacao->setDescricao($linha['DESCRICAO']);
                $Movimentacao->setUsuario($linha['IDUSUARIO']);
                $Movimentacao->setAtivo($linha['IDATIVO']);
                $Movimentacao->setAmbiente($linha['IDAMBIENTEORIGEM']);
                $Movimentacao->setStatus($linha['IDSTATUS']);
                
                $listaAtivos[$contador] = $Movimentacao;
                $contador++;
            }
        }
        
           
 
        
        $this->Conexao->fecharBanco();
        return $listaAtivos;
    }
    
    public function contarTodosAtivoManutencao(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM MOVIMENTACAO ".
            " WHERE IDSTATUS = 2";
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
    

public function  listaAtivoTransferencia(){
    $listaAtivos = '';
    
    $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 4 ORDER BY MOTIVO";
    
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            
            $Movimentacao = new Movimentacao();
            
            $Movimentacao->setId($linha['ID']);
            $Movimentacao->setDatacad($linha['DATACADMOV']);
            $Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $Movimentacao->setDatasaida($linha['DATASAIDA']);
            $Movimentacao->setMotivo($linha['MOTIVO']);
            $Movimentacao->setDescricao($linha['DESCRICAO']);
            $Movimentacao->setUsuario($linha['IDUSUARIO']);
            $Movimentacao->setAtivo($linha['IDATIVO']);
            $Movimentacao->setAmbienteorigem($linha['IDAMBIENTEORIGEM']);
            $Movimentacao->setStatus($linha['IDSTATUS']);
            
            $listaAtivos[$contador] = $Movimentacao;
            $contador++;
        }
    }
      
    $this->Conexao->fecharBanco();
    return $listaAtivos;
}

public function contarTodosAtivoTransferencia(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM MOVIMENTACAO ".
        " WHERE IDSTATUS = 4";
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

public function  listaAtivoDevolucao(){
    $listaAtivos = '';
    
    $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 6 ORDER BY MOTIVO";
    
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            
            $Movimentacao = new Movimentacao();
            
            $Movimentacao->setId($linha['ID']);
            $Movimentacao->setDatacad($linha['DATACADMOV']);
            $Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $Movimentacao->setDatasaida($linha['DATASAIDA']);
            $Movimentacao->setMotivo($linha['MOTIVO']);
            $Movimentacao->setDescricao($linha['DESCRICAO']);
            $Movimentacao->setUsuario($linha['IDUSUARIO']);
            $Movimentacao->setAtivo($linha['IDATIVO']);
            $Movimentacao->setAmbiente($linha['IDAMBIENTEORIGEM']);
            $Movimentacao->setStatus($linha['IDSTATUS']);
            
            $listaAtivos[$contador] = $Movimentacao;
            $contador++;
        }
    }
    
    $this->Conexao->fecharBanco();
    return $listaAtivos;
}

public function contarTodosAtivoDevolucao(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM MOVIMENTACAO ".
        " WHERE IDSTATUS = 6";
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


public function  listaAtivodoacao(){
    $listaAtivos = '';
    
    $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 5 ORDER BY MOTIVO";
    
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            
            $Movimentacao = new Movimentacao();
            
            $Movimentacao->setId($linha['ID']);
            $Movimentacao->setDatacad($linha['DATACADMOV']);
            $Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $Movimentacao->setDatasaida($linha['DATASAIDA']);
            $Movimentacao->setMotivo($linha['MOTIVO']);
            $Movimentacao->setDescricao($linha['DESCRICAO']);
            $Movimentacao->setUsuario($linha['IDUSUARIO']);
            $Movimentacao->setAtivo($linha['IDATIVO']);
            $Movimentacao->setAmbiente($linha['IDAMBIENTEORIGEM']);
            $Movimentacao->setStatus($linha['IDSTATUS']);
            
            $listaAtivos[$contador] = $Movimentacao;
            $contador++;
        }
    }
    
    $this->Conexao->fecharBanco();
    return $listaAtivos;
}

public function contarTodosAtivoDoacao(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM MOVIMENTACAO ".
        " WHERE IDSTATUS = 5";
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


public function  listaAtivobaixa(){
    $listaAtivos = '';
    
    $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 3 ORDER BY MOTIVO";
    
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            
            $Movimentacao = new Movimentacao();
            
            $Movimentacao->setId($linha['ID']);
            $Movimentacao->setDatacad($linha['DATACADMOV']);
            $Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $Movimentacao->setDatasaida($linha['DATASAIDA']);
            $Movimentacao->setMotivo($linha['MOTIVO']);
            $Movimentacao->setDescricao($linha['DESCRICAO']);
            $Movimentacao->setUsuario($linha['IDUSUARIO']);
            $Movimentacao->setAtivo($linha['IDATIVO']);
            $Movimentacao->setAmbiente($linha['IDAMBIENTEORIGEM']);
            $Movimentacao->setStatus($linha['IDSTATUS']);
            
            $listaAtivos[$contador] = $Movimentacao;
            $contador++;
        }
    }
    
    $this->Conexao->fecharBanco();
    return $listaAtivos;
}

public function contarTodosAtivoBaixados(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM MOVIMENTACAO ".
        " WHERE IDSTATUS = 3";
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

public function  listaAtivouso(){
    $listaAtivos = '';
    
    $codigoSQL ="SELECT * FROM MOVIMENTACAO WHERE IDSTATUS = 1 ORDER BY MOTIVO";
    
    $this->Conexao->abrirConexao();
    
    $resultado = $this->Conexao->getConexao()->query($codigoSQL);
    
    $nLinha = mysqli_num_rows($resultado);
    
    if($nLinha > 0){
        $contador = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            
            $Movimentacao = new Movimentacao();
            
            $Movimentacao->setId($linha['ID']);
            $Movimentacao->setDatacad($linha['DATACADMOV']);
            $Movimentacao->setDataentrada($linha['DATAENTRADA']);
            $Movimentacao->setDatasaida($linha['DATASAIDA']);
            $Movimentacao->setMotivo($linha['MOTIVO']);
            $Movimentacao->setDescricao($linha['DESCRICAO']);
            $Movimentacao->setUsuario($linha['IDUSUARIO']);
            $Movimentacao->setAtivo($linha['IDATIVO']);
            $Movimentacao->setAmbiente($linha['IDAMBIENTEORIGEM']);
            $Movimentacao->setStatus($linha['IDSTATUS']);
            
            $listaAtivos[$contador] = $Movimentacao;
            $contador++;
        }
    }
    
    $this->Conexao->fecharBanco();
    return $listaAtivos;
}

public function contarTodosAtivoemuso(){
    $quant = 0;
    
    $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
        " FROM MOVIMENTACAO ".
        " WHERE IDSTATUS = 1";
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
	