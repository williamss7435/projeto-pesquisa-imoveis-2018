<?php
use banco\Sql;

class Pesquisa {
    
    public static function jsonDataListImoveis(){
        
         $sql = "SELECT DISTINCT value
                    FROM (
                        SELECT DISTINCT nm_imovel AS value FROM tb_imovel
                        UNION SELECT DISTINCT rua_imovel AS value FROM tb_imovel
                        UNION SELECT DISTINCT bairro_imovel AS value FROM tb_imovel
                        UNION SELECT DISTINCT cidade_imovel AS value FROM tb_imovel
                    ) AS derived";
        
      
        
        $banco = new Sql();
        return $banco->procurarDados($sql);
        
    }
    
    public static function PesquisarImoveis($pesquisa){
         $sql = "SELECT * FROM tb_imovel";
        
        if(isset($pesquisa)){
            $sql .= " WHERE nm_imovel LIKE :pesquisa"
                    . " OR rua_imovel LIKE :pesquisa2"
                    . " OR bairro_imovel LIKE :pesquisa3".
                    " OR cidade_imovel LIKE :pesquisa4".
                    " OR descricao_imovel LIKE :pesquisa5";
                    
            $parametros = array( 
                ":pesquisa"=> "%" . $pesquisa . "%",
                 ":pesquisa2"=> "%" . $pesquisa . "%",
                ":pesquisa3"=> "%" . $pesquisa . "%",
                ":pesquisa4"=> "%" . $pesquisa . "%",
                ":pesquisa5"=> "%" . $pesquisa . "%"
            );
        }
        
        $sql .= " ORDER BY nm_imovel";
        
        $banco = new Sql();
        return $banco->procurarDados($sql, $parametros);
    }
    
    public static function dadosImovel($id){
        $sql1 = "SELECT * FROM tb_imovel WHERE id_imovel = :id";
        $sql2 = "SELECT url_foto FROM  tb_foto WHERE id_imovel = :id";
        $banco = new Sql();
        $parametro = array(
            ":id"=>$id
        );
        
        $dados = $banco->procurarDados($sql1,$parametro);
        $fotos =   $banco->procurarDados($sql2,$parametro);
        
        $array["nome"] = $dados[0]["nm_imovel"];
        $array["rua"] = $dados[0]["rua_imovel"];
        $array["numero"] = $dados[0]["nm_rua_imovel"];
        $array["cidade"] = $dados[0]["cidade_imovel"];
        $array["estado"] = $dados[0]["sg_estado_imovel"];
        $array["preco"] = $dados[0]["vl_preco_imovel"];
        $array["metragem"] = $dados[0]["metragem_imovel"];
        $array["quartos"] = $dados[0]["qnt_quartos_imovel"];
        $array["faixa"] = $dados[0]["faixa_mcmv_imovel"];
        $array["subsidio"] = $dados[0]["vl_subsidio_mcmv_imovel"];
        $array["data_entrega"] = $dados[0]["dt_entrega_imovel"];
        $array["descricao"] = $dados[0]["descricao_imovel"];
        if($fotos){
              for($i=0; count($fotos)>$i ;$i++){
            $array["foto"][$i] = $fotos[$i]["url_foto"];
            }
        }else{
             $array["foto"] = 0;
        }
        return $array;
  
    }
    
}
