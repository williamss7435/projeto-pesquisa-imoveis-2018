<?php
use banco\Sql;
class Imovel {
 
    
    public static function salvarImovel($nome,$cep,$rua,$numero,$bairro,$cidade,$estado,$preco,$metragem, $quartos, $faixaMCMV, $subsidio, $data_entrega, $descricao,$visualizacao,$numImagens){
        $banco = new Sql();
                        
        $sql = "INSERT INTO tb_imovel (nm_imovel, cep_imovel, rua_imovel, nm_rua_imovel, bairro_imovel, cidade_imovel, sg_estado_imovel, vl_preco_imovel, metragem_imovel, qnt_quartos_imovel, faixa_mcmv_imovel, vl_subsidio_mcmv_imovel, visualizacao_imovel, dt_entrega_imovel, descricao_imovel)" .
                  " VALUES (:nome, :cep, :rua, :numero, :bairro, :cidade, :estado, :preco, :metragem, :quartos, :faixaMCMV, :subsidio, :visualizacao, :data_entrega, :descricao)";
        
        $parametros = array(
            ":nome"=>$nome,
            ":cep"=>$cep,
            ":rua"=>$rua,
            ":numero"=>$numero,
            ":bairro"=>$bairro,
            ":cidade"=>$cidade,
            ":estado"=>$estado,
            ":preco"=>$preco,
            ":metragem"=>$metragem,
            ":quartos"=>$quartos,
            ":faixaMCMV"=>$faixaMCMV,
            ":subsidio"=>$subsidio,
            ":visualizacao"=>$visualizacao,
            ":data_entrega"=> date($data_entrega),
            ":descricao"=>$descricao
        );
        
        if(!Imovel::validarFotos($numImagens)) return "Foto Invalida";
        
        if(!$banco->salvarDados($sql,$parametros)) return "Erro ao Salvar No Banco";
        
        $sql2 = "SELECT id_imovel FROM tb_imovel WHERE nm_imovel = :nome";
        $parametro2 = array (
            ":nome"=> $nome
        );
        $id = $banco->procurarDados($sql2,$parametro2);
        
        if(!Imovel::salvarFotos($numImagens,$id[0]["id_imovel"])) return "Erro Ao Salvar Imagens";
       
        return true;
    }
    
    public static function editarImovel($id, $nome,$cep,$rua,$numero,$bairro,$cidade,$estado,$preco,$metragem, $quartos, $faixaMCMV, $subsidio, $data_entrega, $descricao,$visualizacao){
        $banco = new Sql();
        
        $sql = "UPDATE tb_imovel SET "
                . "nm_imovel = :nome, cep_imovel = :cep, rua_imovel = :rua, nm_rua_imovel  = :numero, bairro_imovel = :bairro, "
                . "cidade_imovel = :cidade, sg_estado_imovel = :estado, vl_preco_imovel = :preco, metragem_imovel = :metragem, "
                . "qnt_quartos_imovel = :quartos, faixa_mcmv_imovel = :faixaMCMV, vl_subsidio_mcmv_imovel = :subsidio, "
                . "visualizacao_imovel = :visualizacao, dt_entrega_imovel = :data_entrega, descricao_imovel = :descricao "
                . "WHERE id_imovel = :id";
        
         $parametros = array(
            ":nome"=>$nome,
            ":cep"=>$cep,
            ":rua"=>$rua,
            ":numero"=>$numero,
            ":bairro"=>$bairro,
            ":cidade"=>$cidade,
            ":estado"=>$estado,
            ":preco"=>$preco,
            ":metragem"=>$metragem,
            ":quartos"=>$quartos,
            ":faixaMCMV"=>$faixaMCMV,
            ":subsidio"=>$subsidio,
            ":visualizacao"=>$visualizacao,
            ":data_entrega"=> date($data_entrega),
            ":descricao"=>$descricao,
             ":id"=>$id
        );
        
        if($banco->alterarDados($sql, $parametros))
                return true;
        
        return false;
    }
   
   public  static function retornarImovel($pesquisa){
       $sql = "SELECT * FROM tb_imovel WHERE id_imovel = :id";
       
       $parametro = array( 
                ":id"=>$pesquisa
         );
       
       $banco = new Sql();
       return $banco->procurarDados($sql, $parametro);
   }

   public static function retornarImoveis($pesquisa){
        $sql = "SELECT id_imovel, nm_imovel, rua_imovel, bairro_imovel, cidade_imovel, sg_estado_imovel FROM tb_imovel";
        
        if(isset($pesquisa)){
            $sql .= " WHERE nm_imovel LIKE :pesquisa"
                    . " OR rua_imovel LIKE :pesquisa2"
                    . " OR bairro_imovel LIKE :pesquisa3".
                    " OR cidade_imovel LIKE :pesquisa4";
                    
            $parametros = array( 
                ":pesquisa"=> "%" . $pesquisa . "%",
                 ":pesquisa2"=> "%" . $pesquisa . "%",
                ":pesquisa3"=> "%" . $pesquisa . "%",
                ":pesquisa4"=> "%" . $pesquisa . "%"
            );
        } 
        
        $sql .= " ORDER BY nm_imovel";
        
        $banco = new Sql();
        return $banco->procurarDados($sql, $parametros);
    }
    
    public static function deletarImovel($id){
        if(!isset($id)) return false;
        $banco = new Sql();
        
        
        $sql2 = "SELECT url_foto FROM tb_foto WHERE id_imovel = :id";
        $parametro2 = array(
            ":id"=> $id
        );
        $fotos = $banco->procurarDados($sql2,$parametro2);
      
        if($fotos != false){
            foreach ($fotos as $key => $value){
            Imovel::removerJPG($value["url_foto"]);
            }
            $sql3 = "DELETE FROM tb_foto WHERE id_imovel = ?";
           if(!$banco->excluirDados($sql3, $id)) return false;
        }
               
        $sql4 = "DELETE FROM tb_imovel WHERE id_imovel = ?";
        if(!$banco->excluirDados($sql4, $id)) return false;
        
        return true;
    }
    
    public static function retonarFotos($pesquisa){
        $banco = new Sql;
        
        $sql = "SELECT id_foto ,url_foto FROM tb_foto WHERE id_imovel = :id";
        $parametro = array(
            ":id"=> $pesquisa
        );
        
        return $banco->procurarDados($sql, $parametro);
    }
    
    public static function deletarFoto($id){
        if(!isset($id)) return false;
        $banco = new Sql();
        
        $sql1 = "SELECT url_foto FROM tb_foto WHERE id_foto = :id";
        $parametro = array(
            ":id"=> $id
        );
        $resultado = $banco->procurarDados($sql1,$parametro);
        Imovel::removerJPG($resultado[0]["url_foto"]);
        
        $sql2 = "DELETE FROM tb_foto WHERE id_foto = ?";
        return $banco->excluirDados($sql2, $id);
    }
    
    public static function removerJPG($nome){
        $diretorioUpload = "../fotos/";
        unlink($diretorioUpload . $nome);   
    }
    
    public static function salvarFotos($numImagens,$id){
        
         $banco = new Sql();
         $diretorioUpload = "../fotos/";
         $sql = "INSERT INTO tb_foto (url_foto, id_imovel) VALUES (:url, :id)";
         $parametros = array();
         
         for($j = 1; $numImagens>=$j; $j++){
            $parametros = array(
                ":url"=> Imovel::nomeUnico() . ".jpg",
                ":id"=>$id
            );
            
            if(!$banco->salvarDados($sql,$parametros)) return false;
            
            move_uploaded_file( $_FILES["foto". $j]['tmp_name'], $diretorioUpload . $parametros[":url"]);
          }
        
        return true;
    }
    
    private static function validarFotos($numImagens){
            for($i = 1; $numImagens>=$i; $i++){
                if($_FILES["foto". $i]['type'] !== "image/jpeg" || $_FILES["foto". $i]['size'] > 1024000)  return false;
            }
            
            return true;
    }


    private static function nomeUnico(){        
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
        $randomString = '';
        for($i = 0; $i < 4; $i++){
            $randomString .= $chars[mt_rand(0,60)];
         }
        return $randomString . rand(1000, 9999) . str_shuffle(time());
    }
    
}
