<?php
use banco\Sql;
class Usuario{
    private $id;
    private $nome;
    private $sobrenome;
    private $login;
    private $senha;
    private $cargo;
    private $permissao;
    
    
    public static function login($login, $senha){
        $parametros = array(
            ":login"=>$login
        );
        $resultado = Usuario::retornarDadosUsuario($parametros);
        
        if(count($resultado)>0){
            
            if($resultado[0]["senha_usuario"] === $senha)
                Usuario::autenticarUsuario($resultado);
            else
                header("location: /ge/index.php?q=1");
            
        }
          
    }
    
    public static function editarDados($login, $senhaAtual, $senhaNova){
        $parametros = array(
            ":login"=>$login
        );
        $resultado = Usuario::retornarDadosUsuario($parametros);
        
        if($resultado){
            
            if($resultado[0]["senha_usuario"] === $senhaAtual){
                
                $banco = new Sql();
                $sql = "UPDATE tb_usuario SET senha_usuario = :novaSenha WHERE login_usuario = :login";
                $valores = array(
                    ":novaSenha"=>$senhaNova,
                    ":login"=>$login
                );
                $banco->alterarDados($sql, $valores);
                
                return array(
                "status"=>true,
                "login"=>$login,
                "senha"=>$senhaNova
                );
                
            } 
            
        }
        
        return array("status"=>false);
    }
    
    private static function autenticarUsuario($dadosUsuario){            
        session_start();
        $_SESSION["nome"] = $dadosUsuario[0]["nm_usuario"];
        $_SESSION["sobrenome"] = $dadosUsuario[0]["sobrenome_usuario"];
        $_SESSION["login"] = $dadosUsuario[0]["login_usuario"];
        $_SESSION["tipo"] = $dadosUsuario[0]["tipo_usuario"];
        $_SESSION["id"] = $dadosUsuario[0]["id_usuario"];
      
        if($_SESSION["tipo"]==9)
             header("location: /ge/tenda-admin.php");
        else if ($_SESSION["tipo"] == 1 || $_SESSION["tipo"] == 2)
             header("location: /ge/imoveis.php");
    }
    
    public static function salvarNovoUsuario($nome, $sobrenome, $login, $cargo, $tipo){
        $banco = new Sql();
        $dados;
        
        $sql = "INSERT INTO tb_usuario (nm_usuario, sobrenome_usuario, login_usuario, senha_usuario, cargo_usuario, tipo_usuario) "
                . "VALUES (:usuario, :sobrenome, :login, :senha, :cargo, :tipo)";
        
        $valores = array(
            ":usuario"=> $nome,
            ":sobrenome"=> $sobrenome,
            ":login"=> $login,
            ":senha"=> Usuario::senhaAleatoria(),
            ":cargo"=> $cargo,
            ":tipo" => $tipo
        );
        
        if($banco->salvarDados($sql, $valores)){
           $dados = array(
                "status"=>true,
                "login"=>$login,
                "senha"=>$valores[":senha"]
            );
        }else{
            $dados = array(
                "status"=>false,
            );
        }
           return $dados; 
    }
    
    private static function retornarDadosUsuario($parametro){
        $sql = "SELECT * FROM tb_usuario WHERE login_usuario = :login";
        $banco = new Sql();
        return $banco->procurarDados($sql, $parametro);
    }
    
    public static function retornarUsuarios($pesquisa){
        $sql = "SELECT concat(nm_usuario, ' ' , sobrenome_usuario) nm_usuario,login_usuario, tipo_usuario FROM tb_usuario";
        
        if(isset($pesquisa)){
            $sql .= " WHERE concat(nm_usuario, ' ' , sobrenome_usuario) LIKE :pesquisa OR login_usuario LIKE :pesquisa2 OR sobrenome_usuario LIKE :pesquisa3";
            $parametros = array( 
                ":pesquisa"=> "%" . $pesquisa . "%",
                 ":pesquisa2"=> "%" . $pesquisa . "%",
                ":pesquisa3"=> "%" . $pesquisa . "%"
            );
        } 
        
        $sql .= " ORDER BY nm_usuario";
        
        $banco = new Sql();
        return $banco->procurarDados($sql, $parametros);
    }
    
    public static function resetarSenha($login){
         $parametros = array(
            ":login"=>$login
        );
        $resultado = Usuario::retornarDadosUsuario($parametros);
        
        if(isset($resultado)){
            $novaSenha = Usuario::senhaAleatoria();
            $banco = new Sql();
            $sql = "UPDATE tb_usuario SET senha_usuario = :novasenha WHERE login_usuario = :login";
            $dados = array(
                ":novasenha"=> $novaSenha,
                ":login"=> $login
            );
            
            if($banco->alterarDados($sql,$dados));
                return array("status"=>true,"login"=>$login, "novaSenha"=>$novaSenha);
        }
        
        return array("status"=>false);
        
    }
    
    public static function excluirUsuario($login){
           if(!isset($login)) return false;
      
            $banco = new Sql();
            $sql = "DELETE FROM tb_usuario WHERE login_usuario = ?";
             
            return $banco->excluirDados($sql,$login);
    }
    
    public static function senhaAleatoria(){
        return base64_encode(random_bytes(3));
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getPermissao() {
        return $this->permissao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setPermissao($permissao) {
        $this->permissao = $permissao;
    }

}
