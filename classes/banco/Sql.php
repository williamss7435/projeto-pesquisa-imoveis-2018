<?php
namespace banco;
class Sql{
    private $conexao;
    const USUARIO = "root";
    const SENHA = "";
    const HOST = "localhost";
    const BANCO = "db_gi";

    function __construct() { 
        $this->conexao = new \PDO("mysql:host=" . Sql::HOST .";dbname=". Sql::BANCO ,Sql::USUARIO, Sql::SENHA);
    }
    
    public function salvarDados($sql, $parametros = array()){
     
        try {
             $stmt = $this->conexao->prepare($sql);
        
             foreach($parametros as $chave => $valor){
                 $stmt->bindValue($chave, $valor);
             }  
             
            return $stmt->execute();
            
        } catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
            
        }
              
    }
    
    public function alterarDados($sql, $parametros = array()){
        $stmt = $this->conexao->prepare($sql);
        
        foreach($parametros as $chave => $valor){
                 $stmt->bindValue($chave, $valor);
         }  
         
        return $stmt->execute();
    }

    public function procurarDados($sql, $parametros = array()){
        
        try {
            
            $stmt = $this->conexao->prepare($sql);
            
            foreach($parametros as $chave => $valor){
                 $stmt->bindValue($chave, $valor);
            }  
            
            $stmt->execute();
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            if(count($resultado)>0)
                return $resultado;
            else
                return false;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
    
    public function excluirDados($sql, $parametro){
        
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindParam(1, $parametro);
        
        return $stmt->execute();
    }
    
    
}
