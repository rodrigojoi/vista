<?php
    
    namespace assets\classes;
    use PDO;

    class Imovel
    {

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $imovelCodigo; 
        var $imovelEndereco;
        var $imovelLocadorCodigo;
        var $locadorNome;
        var $imovelInsercaoData;
        var $imovelInsercaoUsuarioCodigo;
        var $vetorImovel;

        public function setImovelCodigo($imovelCodigo) 
        {
            $this->imovelCodigo = $imovelCodigo;
        }
        public function getImovelCodigo()
        {
            return $this->imovelCodigo;
        }
        
        public function setImovelEndereco($imovelEndereco) 
        {
            $this->imovelEndereco = $imovelEndereco;
        }
        public function getImovelEndereco()
        {
            return $this->imovelEndereco;
        }
        
        public function setImovelLocadorCodigo($imovelLocadorCodigo) 
        {
            $this->imovelLocadorCodigo = $imovelLocadorCodigo;
        }
        public function getImovelLocadorCodigo()
        {
            return $this->imovelLocadorCodigo;
        }
        
        public function setLocadorNome($locadorNome) 
        {
            $this->locadorNome = $locadorNome;
        }
        public function getLocadorNome()
        {
            return $this->locadorNome;
        }
	
        function getImovelInsercaoData() {
            return $this->imovelInsercaoData;
        }
        function setImovelInsercaoData($imovelInsercaoData) {
            
            if(isset($imovelInsercaoData)) {
                
                $data = explode('/', $imovelInsercaoData);
                $imovelInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->imovelInsercaoData = $imovelInsercaoData;
            }
        }
        
        public function setImovelInsercaoUsuarioCodigo($imovelInsercaoUsuarioCodigo) 
        {
            $this->imovelInsercaoUsuarioCodigo = $imovelInsercaoUsuarioCodigo;
        }
        public function getImovelInsercaoUsuarioCodigo()
        {
            return $this->imovelInsercaoUsuarioCodigo;
        }
        
        public function getVetorImovel() {
            return $this->vetorImovel;
        }
        public function setVetorImovel($vetorImovel) {
            $this->vetorImovel = $vetorImovel;
        }

        public function selecionaImovel() 
        {

            $sql = "
                SELECT 
                     imovelCodigo
                    ,imovelEndereco
                    ,imovelLocadorCodigo
                    ,imovelInsercaoData
                    ,imovelInsercaoUsuarioCodigo
                    ,locador.locadorNome
                FROM imovel
                LEFT JOIN locador ON locador.locadorCodigo = imovel.imovelLocadorCodigo
                WHERE 1 ";
            if($this->imovelCodigo) 
            {
                $sql .= " AND imovelCodigo = '".$this->imovelCodigo."'";
            }
            $sql .= " ORDER BY imovelEndereco ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['imovelCodigo'];
                
                $vetor[$codigo]['imovelCodigo']                = $linha['imovelCodigo'];
                $vetor[$codigo]['imovelEndereco']              = $linha['imovelEndereco'];
                $vetor[$codigo]['imovelInsercaoUsuarioCodigo'] = $linha['imovelInsercaoUsuarioCodigo'];
                $vetor[$codigo]['imovelLocadorCodigo']		   = $linha['imovelLocadorCodigo'];
                $vetor[$codigo]['locadorNome']		           = $linha['locadorNome'];
                $vetor[$codigo]['imovelInsercaoData']          = $linha['imovelInsercaoData'];
            }
            if(isset($codigo)) {

                $this->setVetorImovel($vetor);
            }
        }

        public function insereImovel() {
		
            $sql = "
                INSERT INTO imovel
                (
                     imovelEndereco
                    ,imovelLocadorCodigo
                    ,imovelInsercaoData
                    ,imovelInsercaoUsuarioCodigo
                )
                VALUES
                (
                     '".$this->imovelEndereco."'
                    ,'".$this->imovelLocadorCodigo."'
                    ,'".$this->imovelInsercaoData."'
                    ,'".$this->imovelInsercaoUsuarioCodigo."'
                ) ";
                
            $resultado = $this->conexao->query($sql);
            
        }

        function alteraImovel() {
		
            $sql = "
                UPDATE 
                    imovel
                SET 
                     imovelEndereco	     = '".$this->imovelEndereco."'
                    ,imovelLocadorCodigo = '".$this->imovelLocadorCodigo."'
                WHERE imovelCodigo    = '".$this->imovelCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiImovel() {
		
            $sql = "
                DELETE 
                FROM 
                    imovel 
                WHERE imovelCodigo = '".$this->imovelCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }