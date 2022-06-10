<?php
    
    namespace assets\classes;
    use assets\classes\Mensalidade;
    use assets\classes\Repasse;
    use assets\classes\Condominio;
    use PDO;

    class Contrato
    {

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $contratoCodigo; 
        var $contratoImovelCodigo;
        var $contratoLocatarioCodigo;
        var $contratoDataInicio;
        var $contratoDataFim;
        var $contratoAluguelValor;
        var $contratoAluguelValorTotal;
        var $contratoCondominioValor;
        var $contratoIptuValor;
        var $contratoTaxaAdministracaoValor;
        var $contratoInsercaoData;
        var $contratoInsercaoUsuarioCodigo;
        var $imovelEndereco;
        var $locatarioNome;
        var $locadorNome;
        var $temCondominio;
        var $vetorContrato;

        public function setContratoCodigo($contratoCodigo) 
        {
            $this->contratoCodigo = $contratoCodigo;
        }
        public function getContratoCodigo()
        {
            return $this->contratoCodigo;
        }
        
        public function setContratoImovelCodigo($contratoImovelCodigo) 
        {
            $this->contratoImovelCodigo = $contratoImovelCodigo;
        }
        public function getContratoImovelCodigo()
        {
            return $this->contratoImovelCodigo;
        }
        
        public function setContratoLocatarioCodigo($contratoLocatarioCodigo) 
        {
            $this->contratoLocatarioCodigo = $contratoLocatarioCodigo;
        }
        public function getContratoLocatarioCodigo()
        {
            return $this->contratoLocatarioCodigo;
        }
	
        function setContratoDataInicio($contratoDataInicio) {
            
            $this->contratoDataInicio = $contratoDataInicio;
        }
        function getContratoDataInicio() 
        {
            return $this->contratoDataInicio;
        }
	
        function setContratoDataFim($contratoDataFim) {
            
            $this->contratoDataFim = $contratoDataFim;
        }
        function getContratoDataFim() 
        {
            return $this->contratoDataFim;
        }
        
        public function setContratoAluguelValor($contratoAluguelValor) 
        {
            $this->contratoAluguelValor = $contratoAluguelValor;
        }
        public function getContratoAluguelValor()
        {
            return $this->contratoAluguelValor;
        }
        
        public function setContratoAluguelValorTotal($contratoAluguelValorTotal) 
        {
            $this->contratoAluguelValorTotal = $contratoAluguelValorTotal;
        }
        public function getContratoAluguelValorTotal()
        {
            return $this->contratoAluguelValorTotal;
        }
        
        public function setContratoCondominioValor($contratoCondominioValor) 
        {
            $this->contratoCondominioValor = $contratoCondominioValor;
        }
        public function getContratoCondominioValor()
        {
            return $this->contratoCondominioValor;
        }
        
        public function setContratoIptuValor($contratoIptuValor) 
        {
            $this->contratoIptuValor = $contratoIptuValor;
        }
        public function getContratoIptuValor()
        {
            return $this->contratoIptuValor;
        }
        
        public function setContratoTaxaAdministracaoValor($contratoTaxaAdministracaoValor) 
        {
            $this->contratoTaxaAdministracaoValor = $contratoTaxaAdministracaoValor;
        }
        public function getContratoTaxaAdministracaoValor()
        {
            return $this->contratoTaxaAdministracaoValor;
        }
	
        function setContratoInsercaoData($contratoInsercaoData) {
            
            if(isset($contratoInsercaoData)) {
                
                $data = explode('/', $contratoInsercaoData);
                $contratoInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->contratoInsercaoData = $contratoInsercaoData;
            }
        }
        function getContratoInsercaoData() 
        {
            return $this->contratoInsercaoData;
        }
        
        public function setContratoInsercaoUsuarioCodigo($contratoInsercaoUsuarioCodigo) 
        {
            $this->contratoInsercaoUsuarioCodigo = $contratoInsercaoUsuarioCodigo;
        }
        public function getContratoInsercaoUsuarioCodigo()
        {
            return $this->contratoInsercaoUsuarioCodigo;
        }
        
        public function setTemCondominio($temCondominio) 
        {
            $this->temCondominio = $temCondominio;
        }
        public function getTemCondominio()
        {
            return $this->temCondominio;
        }
        
        public function getVetorContrato() {
            return $this->vetorContrato;
        }
        public function setVetorContrato($vetorContrato) {
            $this->vetorContrato = $vetorContrato;
        }

        public function selecionaContrato() 
        {

            $sql = "
                SELECT 
                     contratoCodigo
                    ,contratoImovelCodigo
                    ,contratoLocatarioCodigo
                    ,contratoDataInicio
                    ,contratoDataFim
                    ,contratoAluguelValor
                    ,contratoAluguelValorTotal
                    ,contratoCondominioValor
                    ,contratoIptuValor
                    ,contratoTaxaAdministracaoValor
                    ,contratoInsercaoData
                    ,contratoInsercaoUsuarioCodigo
                    ,imovelEndereco
                    ,locatarioNome
                    ,locadorNome
                FROM contrato
                LEFT JOIN imovel ON imovel.imovelCodigo = contrato.contratoImovelCodigo
                LEFT JOIN locatario ON locatario.locatarioCodigo = contrato.contratoLocatarioCodigo
                LEFT JOIN locador ON locador.locadorCodigo = imovel.imovelLocadorCodigo
                WHERE 1 ";
            if($this->contratoCodigo) 
            {
                $sql .= " AND contratoCodigo = '".$this->contratoCodigo."'";
            }
            if($this->temCondominio) {

                $sql .= " AND contratoCondominioValor > 0";
            }
            $sql .= " ORDER BY contratoCodigo ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['contratoCodigo'];
                
                $vetor[$codigo]['contratoCodigo']                 = $linha['contratoCodigo'];
                $vetor[$codigo]['contratoImovelCodigo']           = $linha['contratoImovelCodigo'];
                $vetor[$codigo]['contratoLocatarioCodigo']        = $linha['contratoLocatarioCodigo'];
                $vetor[$codigo]['contratoDataInicio']		      = $linha['contratoDataInicio'];
                $vetor[$codigo]['contratoDataFim']		          = $linha['contratoDataFim'];
                $vetor[$codigo]['contratoAluguelValor']           = $linha['contratoAluguelValor'];
                $vetor[$codigo]['contratoAluguelValorTotal']      = $linha['contratoAluguelValorTotal'];
                $vetor[$codigo]['contratoCondominioValor']        = $linha['contratoCondominioValor'];
                $vetor[$codigo]['contratoIptuValor']              = $linha['contratoIptuValor'];
                $vetor[$codigo]['contratoTaxaAdministracaoValor'] = $linha['contratoTaxaAdministracaoValor'];
                $vetor[$codigo]['contratoInsercaoData']           = $linha['contratoInsercaoData'];
                $vetor[$codigo]['contratoInsercaoUsuarioCodigo']  = $linha['contratoInsercaoUsuarioCodigo'];
                $vetor[$codigo]['imovelEndereco']                 = $linha['imovelEndereco'];
                $vetor[$codigo]['locatarioNome']                  = $linha['locatarioNome'];
                $vetor[$codigo]['locadorNome']                    = $linha['locadorNome'];
            }
            if(isset($codigo)) {

                $this->setVetorContrato($vetor);
            }
        }

        public function insereContrato() {
		
            $sql = "
                INSERT INTO contrato
                (
                    contratoImovelCodigo
                   ,contratoLocatarioCodigo
                   ,contratoDataInicio
                   ,contratoDataFim
                   ,contratoAluguelValor
                   ,contratoAluguelValorTotal
                   ,contratoCondominioValor
                   ,contratoIptuValor
                   ,contratoTaxaAdministracaoValor
                   ,contratoInsercaoData
                   ,contratoInsercaoUsuarioCodigo
                )
                VALUES
                (
                     '".$this->contratoImovelCodigo."'
                    ,'".$this->contratoLocatarioCodigo."'
                    ,'".$this->contratoDataInicio."'
                    ,'".$this->contratoDataFim."'
                    ,'".$this->contratoAluguelValor."'
                    ,'".$this->contratoAluguelValorTotal."'
                    ,'".$this->contratoCondominioValor."'
                    ,'".$this->contratoIptuValor."'
                    ,'".$this->contratoTaxaAdministracaoValor."'
                    ,'".$this->contratoInsercaoData."'
                    ,'".$this->contratoInsercaoUsuarioCodigo."'
                ) ";
                //die(" -- ".$sql);
            $resultado = $this->conexao->query($sql)or die(" -- ".$sql);

            $this->setContratoCodigo($this->conexao->lastInsertId());

            $objetoMensalidade = new Mensalidade($this->conexao);
            $objetoMensalidade->setMensalidadeContratoCodigo($this->getContratoCodigo());
            $objetoMensalidade->insereMensalidade();

            $objetoRepasse = new Repasse($this->conexao);
            $objetoRepasse->setRepasseContratoCodigo($this->getContratoCodigo());
            $objetoRepasse->insereRepasse();

            if($this->contratoCondominioValor) {
                
                $objetoCondominio = new Condominio($this->conexao);
                $objetoCondominio->setCondominioContratoCodigo($this->getContratoCodigo());
                $objetoCondominio->insereCondominio();
            }
            
        }

        function alteraContrato() {
		
            $sql = "
                UPDATE 
                    contrato
                SET 
                     contratoImovelCodigo	        = '".$this->contratoImovelCodigo."'
                    ,contratoLocatarioCodigo        = '".$this->contratoLocatarioCodigo."'
                    ,contratoDataInicio             = '".$this->contratoDataInicio."'
                    ,contratoDataFim                = '".$this->contratoDataFim."'
                    ,contratoAluguelValor           = '".$this->contratoAluguelValor."'
                    ,contratoAluguelValorTotal      = '".$this->contratoAluguelValorTotal."'
                    ,contratoCondominioValor        = '".$this->contratoCondominioValor."'
                    ,contratoIptuValor              = '".$this->contratoIptuValor."'
                    ,contratoTaxaAdministracaoValor = '".$this->contratoTaxaAdministracaoValor."'
                WHERE contratoCodigo                = '".$this->contratoCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiContrato() {
		
            $sql = "
                DELETE 
                FROM 
                    contrato 
                WHERE contratoCodigo = '".$this->contratoCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }