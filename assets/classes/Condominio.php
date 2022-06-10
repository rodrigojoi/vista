<?php
    
    namespace assets\classes;
    use assets\classes\Contrato;
    use PDO;

    class Condominio
    {
        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $condominioCodigo; 
        var $condominioContratoCodigo;
        var $condominioValor;
        var $condominioDataAluguel;
        var $condominioDataEfetuado;
        var $condominioInsercaoData;
        var $condominioInsercaoUsuarioCodigo;
        var $vetorCondominio;

        public function setCondominioCodigo($condominioCodigo) 
        {
            $this->condominioCodigo = $condominioCodigo;
        }
        public function getCondominioCodigo()
        {
            return $this->condominioCodigo;
        }
        
        public function setCondominioContratoCodigo($condominioContratoCodigo) 
        {
            $this->condominioContratoCodigo = $condominioContratoCodigo;
        }
        public function getCondominioContratoCodigo()
        {
            return $this->condominioContratoCodigo;
        }
        
        public function setCondominioValor($condominioValor) 
        {
            $this->condominioValor = $condominioValor;
        }
        public function getCondominioValor()
        {
            return $this->condominioValor;
        }
	
        function setCondominioDataAluguel($condominioDataAluguel) {
            
            if(isset($condominioDataAluguel)) {
                
                $this->condominioDataAluguel = $condominioDataAluguel;
            }
        }
        function getCondominioDataAluguel() 
        {
            return $this->condominioDataAluguel;
        }
	
        function setCondominioDataEfetuado($condominioDataEfetuado) {
            
            if(isset($condominioDataEfetuado)) {
                
                $this->condominioDataEfetuado = $condominioDataEfetuado;
            }
        }
        function getCondominioDataEfetuado() 
        {
            return $this->condominioDataEfetuado;
        }
	
        function setCondominioInsercaoData($condominioInsercaoData) {
            
            if(isset($condominioInsercaoData)) {
                
                $data = explode('/', $condominioInsercaoData);
                $condominioInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->condominioInsercaoData = $condominioInsercaoData;
            }
        }
        function getCondominioInsercaoData() 
        {
            return $this->condominioInsercaoData;
        }
        
        public function setCondominioInsercaoUsuarioCodigo($condominioInsercaoUsuarioCodigo) 
        {
            $this->condominioInsercaoUsuarioCodigo = $condominioInsercaoUsuarioCodigo;
        }
        public function getCondominioInsercaoUsuarioCodigo()
        {
            return $this->condominioInsercaoUsuarioCodigo;
        }
        
        public function getVetorCondominio() {
            return $this->vetorCondominio;
        }
        public function setVetorCondominio($vetorCondominio) {
            $this->vetorCondominio = $vetorCondominio;
        }

        public function selecionaCondominio() 
        {

            $sql = "
                SELECT 
                     condominioCodigo
                    ,condominioContratoCodigo
                    ,condominioValor
                    ,condominioDataAluguel
                    ,condominioDataEfetuado
                    ,condominioInsercaoData
                    ,condominioInsercaoUsuarioCodigo
                    ,imovelEndereco
                FROM condominio
                LEFT JOIN contrato ON contrato.contratoCodigo = condominio.condominioContratoCodigo
                LEFT JOIN imovel   ON imovel.imovelCodigo     = contrato.contratoImovelCodigo
                WHERE 1 ";
            if($this->condominioCodigo) 
            {
                $sql .= " AND condominioCodigo = '".$this->condominioCodigo."'";
            }
            $sql .= " ORDER BY condominioCodigo ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['condominioCodigo'];
                
                $vetor[$codigo]['condominioCodigo']                = $linha['condominioCodigo'];
                $vetor[$codigo]['condominioContratoCodigo']        = $linha['condominioContratoCodigo'];
                $vetor[$codigo]['condominioValor']                 = $linha['condominioValor'];
                $vetor[$codigo]['condominioDataAluguel']           = $linha['condominioDataAluguel'];
                $vetor[$codigo]['condominioDataEfetuado']          = $linha['condominioDataEfetuado'];
                $vetor[$codigo]['condominioInsercaoData']          = $linha['condominioInsercaoData'];
                $vetor[$codigo]['condominioInsercaoUsuarioCodigo'] = $linha['condominioInsercaoUsuarioCodigo'];
                $vetor[$codigo]['imovelEndereco']               = $linha['imovelEndereco'];
            }
            if(isset($codigo)) {

                $this->setVetorCondominio($vetor);
            }
        }

        public function insereCondominio() {

            $objetoContrato = new Contrato($this->conexao);
            $objetoContrato->setContratoCodigo($this->condominioContratoCodigo);
            $objetoContrato->selecionaContrato();
            $vetorContrato = $objetoContrato->getVetorContrato();
    
            if(isset($vetorContrato)) {

                foreach($vetorContrato as $codigo => $vetorFinal) {
                    
                    $contratoDataInicio             = $vetorFinal['contratoDataInicio'];
                    $contratoCondominioValor        = $vetorFinal['contratoCondominioValor'];
                    $contratoInsercaoUsuarioCodigo  = $vetorFinal['contratoInsercaoUsuarioCodigo'];

                    $diaI = explode("-",$contratoDataInicio);
                    $diaInicio = $diaI[2];
                    
                    if($diaInicio != '01') {

                        $resta = 30 - $diaInicio;
                        
                        $valorCondominioDia       = $contratoCondominioValor / 30;
                        $valorCondominioProporcional = $valorCondominioDia * $resta;
                    }
                    else {

                        $valorCondominioProporcional        = $contratoCondominioValor;
                    }

                    for($i = 1; $i <= 12; $i++) {

                        $dataA = explode('-',$contratoDataInicio);
                        $data = new \DateTime($dataA[2].'-'.$dataA[1].'-'.$dataA[0]);
                        $data->modify('+'.$i.' month');
                        $contratoData = $data->format('Y-m');
                        $contratoData = $contratoData."-01";

                        if($i == 1) {

                            $sql = "
                                INSERT INTO condominio
                                (
                                     condominioContratoCodigo
                                    ,condominioValor
                                    ,condominioDataAluguel
                                    ,condominioInsercaoData
                                    ,condominioInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->condominioContratoCodigo."'
                                    ,'".$valorCondominioProporcional."'
                                    ,'".$contratoData."'
                                    ,'".date('Y-m-d')."'
                                    ,'".$contratoInsercaoUsuarioCodigo."'
                                ) ";
                            $resultado = $this->conexao->query($sql);
                        }
                        else {

                            $sql = "
                                INSERT INTO condominio
                                (
                                     condominioContratoCodigo
                                    ,condominioValor
                                    ,condominioDataAluguel
                                    ,condominioInsercaoData
                                    ,condominioInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->condominioContratoCodigo."'
                                    ,'".$contratoCondominioValor."'
                                    ,'".$contratoData."'
                                    ,'".date('Y-m-d')."'
                                    ,'".$contratoInsercaoUsuarioCodigo."'
                                ) ";
                            $resultado = $this->conexao->query($sql);
                        }
                    }
                }
            }
        }

        function alteraCondominio() {
		
            $sql = "
                UPDATE 
                    condominio
                SET 
                     condominioContratoCodigo	       = '".$this->condominioContratoCodigo."'
                    ,condominioAluguelData            = '".$this->condominioAluguelData."'
                    ,condominioAluguelTotalValor      = '".$this->condominioAluguelTotalValor."'
                    ,condominioCondominioValor        = '".$this->condominioCondominioValor."'
                    ,condominioIptuValor              = '".$this->condominioIptuValor."'
                    ,condominioTaxaAdministracaoValor = '".$this->condominioTaxaAdministracaoValor."'
                WHERE condominioCodigo                = '".$this->condominioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function pagarCondominio() {
		
            $sql = "
                UPDATE 
                    condominio
                SET 
                     condominioDataEfetuado = '".$this->condominioDataEfetuado."'
                WHERE condominioCodigo      = '".$this->condominioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiCondominio() {
		
            $sql = "
                DELETE 
                FROM 
                    condominio 
                WHERE condominioCodigo = '".$this->condominioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }