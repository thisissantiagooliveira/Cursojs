<?php
namespace src;
//pra incluir o  codigo da calsse usuario aqui no arquivo
include_once 'Usuario.php';
include_once 'Conexao.php';

//bloqueado == 1;
//desbloqueado == 0;

class UsuarioRepositorio
{
    
    private $Conexao;
    private $Usuario;
    
    public function __construct()
    {
        $this->Conexao = new Conexao();
        $this->Usuario = new Usuario();
    }
    public function  cadastrarUsuario($Usuario){
        $retorno = FALSE;
        $this->Usuario = $Usuario;
        $codigoSQL = "INSERT INTO USUARIO(NOME,LOGIN,SENHA,NIVEL,IDSUPERIOR,SITUACAO)".
            " VALUES ('".$this->Usuario->getNome()."','".$this->Usuario->getLogin()."',".
            " SHA('".$this->Usuario->getSenha()."'),"."
        ".$this->Usuario->getNivel().",".
       " ".$this->Usuario->getIdSuperior().", 0)";

        $this->Conexao->abrirConexao();
        if( $this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha no cadastro do usuario".mysqli_error($this->Conexao));
        }
        $this->Conexao->fecharBanco();
        return $retorno;
        
    }
    
    public function alterarUsuario($Usuario){
        $retorno = FALSE;
        $this->Usuario = $Usuario;
        $codigoSQL = "UPDATE USUARIO SET ".
            " NOME = '".$this->Usuario->getNome()."', ".
            " LOGIN = '".$this->Usuario->getLogin()."', ".
            " NIVEL = '".$this->Usuario->getNivel()."', ".
            " IDSUPERIOR =".$this->Usuario->getIdSuperior()." ".
            " WHERE ID = ".$this->Usuario->getId()." ";

        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha na alteração do Usuario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function alterarSenha($Usuario){
        $retorno = FALSE;
        
        $this->Usuario = $Usuario;
        
        $codigoSQL = "UPDATE USUARIO SET".
            " SENHA = SHA('".$this->Usuario->getSenha()."') ".
            " WHERE ID = ".$this->Usuario->getId()." ";
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao alterar a senha do Usuario");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function  existeSenha($Usuario){
        $retorno = FALSE;
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO".
            " WHERE SENHA = SHA('".$this->Usuario->getSenha()."')".
            " AND ID = ".$this->Usuario->getId();  
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $retorno = TRUE;
            
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function bloquearUsuario($Usuario){
        $retorno = FALSE;
        
        $this->Usuario = $Usuario;
        
        $codigoSQL="UPDATE USUARIO SET".
            " SITUACAO= 1".
            " WHERE ID = ".$this->Usuario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Bloquear o Usuário");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function desbloquearUsuario($Usuario){
        $retorno = FALSE;
        $this->Usuario = $Usuario;
        
        $codigoSQL = "UPDATE USUARIO SET".
            " SITUACAO = 0 WHERE ID = ".$this->Usuario->getId()." ";

        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Desbloquear o Usuário");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function excluirUsuario($Usuario){
        $retorno = FALSE;
        $this->Usuario =$Usuario;
        
        $codigoSQL ="DELETE FROM USUARIO".
            " WHERE ID = ".$this->Usuario->getId()." ";
        
        $this->Conexao->abrirConexao();
        if($this->Conexao->getConexao()->query($codigoSQL)){
            $retorno = TRUE;
        }
        else{
            echo("Falha ao tentar Excluir o Usuário");
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function autenticarUsuario($Usuario){
        
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO ".
            " WHERE BINARY LOGIN = '".$this->Usuario->getLogin()."' ".
            " AND  BINARY SENHA = SHA('".$this->Usuario->getSenha()."')".
            " AND SITUACAO = 0 ";

        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);

        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Usuario->setId($linha['ID']);
            $this->Usuario->setNome($linha['NOME']);
            $this->Usuario->setLogin($linha['LOGIN']);
            $this->Usuario->setSenha($linha['SENHA']);
            $this->Usuario->setNivel($linha['NIVEL']);
            $this->Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $this->Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "<br/>"."Usuario invalido";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function  existeLogin($Usuario){
        $retorno = FALSE;
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO".
            " WHERE ID = '".$this->Usuario->getId();
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $retorno = TRUE;
            
        }
        $this->Conexao->fecharBanco();
        return $retorno;
    }
    
    public function consultarUsuarioPorNome($Usuario){
        $this->Usuario = $Usuario;
        
        $codigoSQL= "SELECT * FROM USUARIO".
            " WHERE NOME ='".$this->Usuario->getNome()."' ".
            " AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $Usuario->setId($linha['ID']);
            $Usuario->setNome($linha['NOME']);
            $Usuario->setLogin($linha['LOGIN']);
            $Usuario->setSenha($linha['SENHA']);
            $Usuario->setNivel($linha['NIVEL']);
            $Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "Usuario não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function consultarUsuarioBloqueadoPorNome($Usuario){
        $this->Usuario = $Usuario;
        
        $codigoSQL= "SELECT * FROM USUARIO".
            " WHERE NOME ='".$this->Usuario->getNome()."' ".
            " AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Usuario->setId($linha['ID']);
            $this->Usuario->setNome($linha['NOME']);
            $this->Usuario->setLogin($linha['LOGIN']);
            $this->Usuario->setSenha($linha['SENHA']);
            $this->Usuario->setNivel($linha['NIVEL']);
            $this->Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $this->Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "Usuario não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function consultaUsuarioPorId($Usuario){
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO".
            " WHERE ID = ".$this->Usuario->getId()." ";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Usuario->setId($linha['ID']);
            $this->Usuario->setNome($linha['NOME']);
            $this->Usuario->setLogin($linha['LOGIN']);
            $this->Usuario->setSenha($linha['SENHA']);
            $this->Usuario->setNivel($linha['NIVEL']);
            $this->Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $this->Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "Este CODIGO não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function  consultarUsuarioPorLogin($Usuario){
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO".
            " WHERE LOGIN = '".$this->Usuario->getLogin()."' ".
            "AND SITUACAO = 0";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Usuario->setId($linha['ID']);
            $this->Usuario->setNome($linha['NOME']);
            $this->Usuario->setLogin($linha['LOGIN']);
            $this->Usuario->setSenha($linha['SENHA']);
            $this->Usuario->setNivel($linha['NIVEL']);
            $this->Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $this->Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "Este lOGIN não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function  consultarUsuarioBloqueadoPorLogin($Usuario){
        $this->Usuario = $Usuario;
        
        $codigoSQL = "SELECT * FROM USUARIO".
            " WHERE LOGIN = '".$this->Usuario->getLogin()."' ".
            "AND SITUACAO = 1";
        
        $this->Conexao->abrirConexao();
        
        $resultado= $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $linha = mysqli_fetch_assoc($resultado);
            
            $this->Usuario->setId($linha['ID']);
            $this->Usuario->setNome($linha['NOME']);
            $this->Usuario->setLogin($linha['LOGIN']);
            $this->Usuario->setSenha($linha['SENHA']);
            $this->Usuario->setNivel($linha['NIVEL']);
            $this->Usuario->setIdSuperior($linha['IDSUPERIOR']);
            $this->Usuario->setSituacao($linha['SITUACAO']);
            
        }
        else{
            echo "Este lOGIN não existe";
        }
        $this->Conexao->fecharBanco();
        return $this->Usuario;
    }
    
    public function contarTodosUsuarios(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM USUARIO ";
        
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
    
    public function contarTodosUsuariosBloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM USUARIO ".
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
    
    public function contarTodosUsuariosDesbloqueado(){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM USUARIO ".
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
        $listaUsuarios = '';
        
        $codigoSQL ="SELECT * FROM USUARIO ".
            " ORDER BY ID";
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Usuario = new Usuario();
                
                $Usuario->setId($linha['ID']);
                $Usuario->setNome($linha['NOME']);
                $Usuario->setLogin($linha['LOGIN']);
                $Usuario->setSenha($linha['SENHA']);
                $Usuario->setNivel($linha['NIVEL']);
                $Usuario->setIdSuperior($linha['IDSUPERIOR']);
                $Usuario->setSituacao($linha['SITUACAO']);
                
                $listaUsuarios[$contador] = $Usuario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUsuarios;
    }
    
    public function  listaUsuariosBloqueados(){
        $listaUsuarios = '';
        
        $codigoSQL ="SELECT * FROM USUARIO".
            " WHERE SITUACAO = 1".
            " ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Usuario = new Usuario();
                
                $Usuario->setId($linha['ID']);
                $Usuario->setNome($linha['NOME']);
                $Usuario->setLogin($linha['LOGIN']);
                $Usuario->setSenha($linha['SENHA']);
                $Usuario->setNivel($linha['NIVEL']);
                $Usuario->setIdSuperior($linha['IDSUPERIOR']);
                $Usuario->setSituacao($linha['SITUACAO']);
                
                $listaUsuarios[$contador] = $Usuario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUsuarios;
    }
    
    public function  listaUsuariosDesbloqueados(){
        $listaUsuarios = '';
        
        $codigoSQL ="SELECT * FROM USUARIO WHERE SITUACAO = 0 ORDER BY NOME";
        
        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Usuario = new Usuario();
                
                $Usuario->setId($linha['ID']);
                $Usuario->setNome($linha['NOME']);
                $Usuario->setLogin($linha['LOGIN']);
                $Usuario->setSenha($linha['SENHA']);
                $Usuario->setNivel($linha['NIVEL']);
                $Usuario->setIdSuperior($linha['IDSUPERIOR']);
                $Usuario->setSituacao($linha['SITUACAO']);
                
                $listaUsuarios[$contador] = $Usuario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUsuarios;
    }
    
    public function  listaPorNivel($nivel){
        $listaUsuarios = '';
        
        $codigoSQL ="SELECT * FROM USUARIO".
            " WHERE NIVEL = ".$nivel." ".
            " ORDER BY NOME ";

        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Usuario = new Usuario();
                
                $Usuario->setId($linha['ID']);
                $Usuario->setNome($linha['NOME']);
                $Usuario->setLogin($linha['LOGIN']);
                $Usuario->setSenha($linha['SENHA']);
                $Usuario->setNivel($linha['NIVEL']);
                $Usuario->setIdSuperior($linha['IDSUPERIOR']);
                $Usuario->setSituacao($linha['SITUACAO']);
                
                $listaUsuarios[$contador] = $Usuario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUsuarios;
    }
    
    public function contarPorNivel($nivel){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM USUARIO ".
            " WHERE NIVEL = ".$nivel;

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
    
    public function  listaPorSuperior($idSuperior){
        $listaUsuarios = '';
        
        $codigoSQL ="SELECT * FROM USUARIO".
            " WHERE IDSUPERIOR = ".$idSuperior." ".
            " ORDER BY NOME ";

        $this->Conexao->abrirConexao();
        
        $resultado = $this->Conexao->getConexao()->query($codigoSQL);
        
        $nLinha = mysqli_num_rows($resultado);
        
        if($nLinha > 0){
            $contador = 0;
            while($linha = mysqli_fetch_assoc($resultado)){
                $Usuario = new Usuario();
                
                $Usuario->setId($linha['ID']);
                $Usuario->setNome($linha['NOME']);
                $Usuario->setLogin($linha['LOGIN']);
                $Usuario->setSenha($linha['SENHA']);
                $Usuario->setNivel($linha['NIVEL']);
                $Usuario->setIdSuperior($linha['IDSUPERIOR']);
                $Usuario->setSituacao($linha['SITUACAO']);
                
                $listaUsuarios[$contador] = $Usuario;
                $contador++;
            }
        }
        
        $this->Conexao->fecharBanco();
        return $listaUsuarios;
    }
    
    public function contarPoridSuperior($idSuperior){
        $quant = 0;
        
        $codigoSQL = "SELECT COUNT(ID) AS QUANTIDADE".
            " FROM USUARIO ".
            " WHERE IDSUPERIOR = ".$idSuperior;

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
?>