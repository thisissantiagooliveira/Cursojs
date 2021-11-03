<?php
namespace src;
//pra incluir o  codigo da calsse usuario aqui no arquivo
include_once 'Funcionario.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class FuncionarioRepositorio
{
    
    private $Conexao;
    private $Usuario;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Funcionario = new Funcionario();
    }
    public function  cadastrarFuncionario($Funcionario){
        $retorno = FALSE;
        
        $this->Funcionario = $Funcionario;
        $codigoSQL = "INSERT INTO FUNCIONARIO (NOME,IDUSUARIO,DATA,TURNO,SUPERIOR,IDCARGO,IDUNIDADE,SITUACAO)".
            " VALUES ('".$this->Funcionario->getNome()."',".$this->Funcionario->getUsuario()->getId().",'".$this->Funcionario->getData()."',".$this->Funcionario->getTurno().", ".
		$this->Funcionario->getSuperior().",".$this->Funcionario->getCargo()->getId().",".$this->Funcionario->getUnidade()->getId().", 0)";
         
        
        $this->Conexao->abrirConexao();
        if( $this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha no cadastro do Funcionario".mysqli_error($this->Conexao));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
	
	 public function alterarFuncionario($Funcionario){
        $retorno = FALSE;
        $this->Funcionario = $Funcionario;
        $codigoSQL = "UPDATE FUNCIONARIO SET ".
            
            " NOME = '".$this->Funcionario->getNome()."', ".
            " IDUSUARIO = '".$this->Funcionario->getUsuario()->getId()."', ".
            " DATA = '".$this->Funcionario->getData()."', ".
			" TURNO = '".$this->Funcionario->getTurno()."', ".
			" IDCARGO = '".$this->Funcionario->getCargo()->getId()."',".
			" IDUNIDADE = '".$this->Funcionario->getUnidade()->getId()."',".
            " SUPERIOR =".$this->Funcionario->getSuperior()." ".
            " WHERE ID = ".$this->Funcionario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteracão do Funcionario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
	 public function bloquearFuncionario($Funcionario ){
        $retorno = FALSE;
        
        $this->Funcionario = $Funcionario;
        
        $codigoSQL="UPDATE FUNCIONARIO SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Funcionario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o Funcionario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
	  public function desbloquearFuncionario($Funcionario){
        $retorno = FALSE;
        $this->Funcionario = $Funcionario;
        
        $codigoSQL = "UPDATE USUARIO SET".
            " SITUACAO = 0 WHERE ID = ".$this->Funcionario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o Funcionario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
	 public function excluirFuncionario($Funcionario ){
        $retorno = FALSE;
        $this->Funcionario =$Funcionario;
        
        $codigoSQL ="DELETE FROM FUNCIONARIO".
            " WHERE ID = ".$this->Funcionario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o Funcionario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    public function consultarFuncionarioPorNome($Funcionario){
        $this->Funcionario = $Funcionario;
        
        $codigoSQL= "SELECT * FROM FUNCIONARIO".
            " WHERE NOME ='".$this->Funcionario->getNome()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
			
            $this->Funcionario->setId($linha['ID']);
            $this->Funcionario->setNome($linha['NOME']);
            $this->Funcionario->setTurno($linha['TURNO']);
            $this->Funcionario->setUsuario($linha['IDUSUARIO']);
            $this->Funcionario->setData($linha['DATA']);
            $this->Funcionario->setSituacao($linha['SITUACAO']);
            $this->Funcionario->setUnidade($linha['IDUNIDADE']);
            $this->Funcionario->setCargo($linha['IDCARGO']);
            $this->Funcionario->setSuperior($linha['SUPERIOR']);
			
			  }
        else{
            echo "Funcionario não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
	public function consultarFuncionarioBloqueadoPorNome($Funcionario){
        $this->Funcionario = $Funcionario;
        
        $codigoSQL= "SELECT * FROM FUNCIONARIO".
            " WHERE NOME ='".$this->Funcionario->getNome()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
	
            $this->Funcionario->setId($linha['ID']);
            $this->Funcionario->setNome($linha['NOME']);
            $this->Funcionario->setTurno($linha['TURNO']);
            $this->Funcionario->setUsuario($linha['IDUSUARIO']);
            $this->Funcionario->setData($linha['DATA']);
            $this->Funcionario->setSituacao($linha['SITUACAO']);
            $this->Funcionario->setUnidade($linha['IDUNIDADE']);
            $this->Funcionario->setCargo($linha['IDCARGO']);
            $this->Funcionario->setSuperior($linha['SUPERIOR']);
		  }
        else{
            echo "Funcionario não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Funcionario;
    }
    
    public function consultarFuncionarioDesbloqueadoPorNome($Funcionario){
        $this->Funcionario = $Funcionario;
        
        $codigoSQL= "SELECT * FROM FUNCIONARIO".
            " WHERE NOME ='".$this->Funcionario->getNome()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Funcionario->setId($linha['ID']);
            $this->Funcionario->setNome($linha['NOME']);
            $this->Funcionario->setTurno($linha['TURNO']);
            $this->Funcionario->setUsuario($linha['IDUSUARIO']);
            $this->Funcionario->setData($linha['DATA']);
            $this->Funcionario->setSituacao($linha['SITUACAO']);
            $this->Funcionario->setUnidade($linha['IDUNIDADE']);
            $this->Funcionario->setCargo($linha['IDCARGO']);
            $this->Funcionario->setSuperior($linha['SUPERIOR']);
        }
        else{
            echo "Funcionario não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Funcionario;
    }
	
	 public function consultaFuncionarioPorId($Funcionario){
        $this->Funcionario = $Funcionario;
        
        $codigoSQL = "SELECT * FROM FUNCIONARIO".
            " WHERE ID = ".$this->Funcionario->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
			
            $this->Funcionario->setId($linha['ID']);
            $this->Funcionario->setNome($linha['NOME']);
            $this->Funcionario->setTurno($linha['TURNO']);
            $this->Funcionario->setUsuario($linha['IDUSUARIO']);
            $this->Funcionario->setData($linha['DATA']);
            $this->Funcionario->setSituacao($linha['SITUACAO']);
            $this->Funcionario->setUnidade($linha['IDUNIDADE']);
            $this->Funcionario->setCargo($linha['IDCARGO']);
            $this->Funcionario->setSuperior($linha['SUPERIOR']);
			
			}
        else{
            echo "Este CODIGO não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Funcionario;
    }
	public function contarTodosFuncionarios(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM FUNCIONARIO ";
        
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
	 public function contarTodosFuncionariosBloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM FUNCIONARIO ".
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
	 public function contarTodosFuncionariosDesbloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM FUNCIONARIO ".
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
	  public function  listaUsuarios(){
        $listaFuncionarios = '';
        
        $codigoSQL ="SELECT * FROM FUNCIONARIO ".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
              
             $Funcionario = new Funcionario(); 
             
             $Funcionario->setId($linha['ID']);
             $Funcionario->setNome($linha['NOME']);
             $Funcionario->setTurno($linha['TURNO']);
             $Funcionario->setUsuario($linha['IDUSUARIO']);
             $Funcionario->setSituacao($linha['SITUACAO']);
             $Funcionario->setUnidade($linha['IDUNIDADE']);
             $Funcionario->setCargo($linha['IDCARGO']);
             $Funcionario->setSuperior($linha['SUPERIOR']);
			
			  $listaFuncionarios[$contador] = $Funcionario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaFuncionarios;
    }
	
	  public function  listaFuncionariosBloqueados(){
        $listaFuncionarios = '';
        
        $codigoSQL ="SELECT * FROM FUNCIONARIO".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
			
			$Funcionario = new Funcionario();           
			$this->Funcionario->setId($linha['ID']);
			$this->Funcionario->setNome($linha['NOME']);
			$this->Funcionario->setTurno($linha['TURNO']);
			$this->Funcionario->setUsuario($linha['IDUSUARIO']);
			$this->Funcionario->setData($linha['DATA']);
			$this->Funcionario->setSituacao($linha['SITUACAO']);
			$this->Funcionario->setUnidade($linha['IDUNIDADE']);
			$this->Funcionario->setCargo($linha['IDCARGO']);
			$this->Funcionario->setSuperior($linha['SUPERIOR']);
			
			  $listaFuncionarios[$contador] = $Funcionario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaFuncionarios;
    }
	  public function  listaFuncionariosDesbloqueados(){
        $listaFuncionarios = '';
        
        $codigoSQL ="SELECT * FROM FUNCIONARIO WHERE SITUACAO = 0 ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
			
			$Funcionario = new Funcionario();           
			$this->Funcionario->setId($linha['ID']);
			$this->Funcionario->setNome($linha['NOME']);
			$this->Funcionario->setTurno($linha['TURNO']);
			$this->Funcionario->setUsuario($linha['IDUSUARIO']);
			$this->Funcionario->setData($linha['DATA']);
			$this->Funcionario->setSituacao($linha['SITUACAO']);
			$this->Funcionario->setUnidade($linha['IDUNIDADE']);
			$this->Funcionario->setCargo($linha['IDCARGO']);
			$this->Funcionario->setSuperior($linha['SUPERIOR']);
			
			  $listaFuncionarios[$contador] = $Funcionario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaFuncionarios;
    }
	
	 public function  listaPorSuperior($Superior){
        $listaFuncionarios = '';
        
        $codigoSQL ="SELECT * FROM FUNCIONARIO".
            " WHERE IDSUPERIOR = ".$Superior." ".
            " ORDER BY NOME ";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Funcionario = new Funcionario();
				
			$Funcionario = new Funcionario();           
			$this->Funcionario->setId($linha['ID']);
			$this->Funcionario->setNome($linha['NOME']);
			$this->Funcionario->setTurno($linha['TURNO']);
			$this->Funcionario->setUsuario($linha['IDUSUARIO']);
			$this->Funcionario->setData($linha['DATA']);
			$this->Funcionario->setSituacao($linha['SITUACAO']);
			$this->Funcionario->setUnidade($linha['IDUNIDADE']);
			$this->Funcionario->setCargo($linha['IDCARGO']);
			$this->Funcionario->setSuperior($linha['SUPERIOR']);
				
			   $listaFuncionarios[$contador] = $Funcionario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaFuncionarios;
    }
	public function contarPoridSuperior($Superior){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM FUNCIONARIO ".
            " WHERE IDSUPERIOR = ".$Superior;
        
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
    
    public function  listaFuncionarios(){
        $listaFuncionarios = '';
        
        $codigoSQL ="SELECT * FROM FUNCIONARIO ".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Funcionario = new Funcionario();
                
                $Funcionario->setId($linha['ID']);
                $Funcionario->setNome($linha['NOME']);
                $Funcionario->setTurno($linha['TURNO']);
                $Funcionario->setUsuario($linha['IDUSUARIO']);
                $Funcionario->setSituacao($linha['SITUACAO']);
                $Funcionario->setUnidade($linha['IDUNIDADE']);
                $Funcionario->setCargo($linha['IDCARGO']);
                $Funcionario->setSuperior($linha['SUPERIOR']);
                
                $listaFuncionarios[$contador] = $Funcionario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaFuncionarios;
    }
    
    
}
?>