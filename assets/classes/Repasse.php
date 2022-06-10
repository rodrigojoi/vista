<?php
    
    namespace assets\classes;
    use assets\classes\Contrato;
    use PDO;

    class Repasse
    {
        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $repasseCodigo; 
        var $repasseContratoCodigo;
        var $repasseValor;
        var $repasseDataAluguel;
        var $repasseDataEfetuado;
        var $repasseInsercaoData;
        var $repasseInsercaoUsuarioCodigo;
        var $vetorRepasse;

        public function setRepasseCodigo($repasseCodigo) 
        {
            $this->repasseCodigo = $repasseCodigo;
        }
        public function getRepasseCodigo()
        {
            return $this->repasseCodigo;
        }
        
        public function setRepasseContratoCodigo($repasseContratoCodigo) 
        {
            $this->repasseContratoCodigo = $repasseContratoCodigo;
        }
        public function getRepasseContratoCodigo()
        {
            return $this->repasseContratoCodigo;
        }
        
        public function setRepasseValor($repasseValor) 
        {
            $this->repasseValor = $repasseValor;
        }
        public function getRepasseValor()
        {
            return $this->repasseValor;
        }
	
        function setRepasseDataAluguel($repasseDataAluguel) {
            
            if(isset($repasseDataAluguel)) {
                
                $this->repasseDataAluguel = $repasseDataAluguel;
            }
        }
        function getRepasseDataAluguel() 
        {
            return $this->repasseDataAluguel;
        }
	
        function setRepasseDataEfetuado($repasseDataEfetuado) {
            
            if(isset($repasseDataEfetuado)) {
                
                $this->repasseDataEfetuado = $repasseDataEfetuado;
            }
        }
        function getRepasseDataEfetuado() 
        {
            return $this->repasseDataEfetuado;
        }
	
        function setRepasseInsercaoData($repasseInsercaoData) {
            
            if(isset($repasseInsercaoData)) {
                
                $data = explode('/', $repasseInsercaoData);
                $repasseInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->repasseInsercaoData = $repasseInsercaoData;
            }
        }
        function getRepasseInsercaoData() 
        {
            return $this->repasseInsercaoData;
        }
        
        public function setRepasseInsercaoUsuarioCodigo($repasseInsercaoUsuarioCodigo) 
        {
            $this->repasseInsercaoUsuarioCodigo = $repasseInsercaoUsuarioCodigo;
        }
        public function getRepasseInsercaoUsuarioCodigo()
        {
            return $this->repasseInsercaoUsuarioCodigo;
        }
        
        public function getVetorRepasse() {
            return $this->vetorRepasse;
        }
        public function setVetorRepasse($vetorRepasse) {
            $this->vetorRepasse = $vetorRepasse;
        }

        public function selecionaRepasse() 
        {

            $sql = "
                SELECT 
                     repasseCodigo
                    ,repasseContratoCodigo
                    ,repasseValor
                    ,repasseDataAluguel
                    ,repasseDataEfetuado
                    ,repasseInsercaoData
                    ,repasseInsercaoUsuarioCodigo
                    ,imovelEndereco
                FROM repasse
                LEFT JOIN contrato ON contrato.contratoCodigo = repasse.repasseContratoCodigo
                LEFT JOIN imovel   ON imovel.imovelCodigo     = contrato.contratoImovelCodigo
                WHERE 1 ";
            if($this->repasseCodigo) 
            {
                $sql .= " AND repasseCodigo = '".$this->repasseCodigo."'";
            }
            $sql .= " ORDER BY repasseCodigo ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['repasseCodigo'];
                
                $vetor[$codigo]['repasseCodigo']                = $linha['repasseCodigo'];
                $vetor[$codigo]['repasseContratoCodigo']        = $linha['repasseContratoCodigo'];
                $vetor[$codigo]['repasseValor']                 = $linha['repasseValor'];
                $vetor[$codigo]['repasseDataAluguel']           = $linha['repasseDataAluguel'];
                $vetor[$codigo]['repasseDataEfetuado']          = $linha['repasseDataEfetuado'];
                $vetor[$codigo]['repasseInsercaoData']          = $linha['repasseInsercaoData'];
                $vetor[$codigo]['repasseInsercaoUsuarioCodigo'] = $linha['repasseInsercaoUsuarioCodigo'];
                $vetor[$codigo]['imovelEndereco']               = $linha['imovelEndereco'];
            }
            if(isset($codigo)) {

                $this->setVetorRepasse($vetor);
            }
        }

        public function insereRepasse() {

            $objetoContrato = new Contrato($this->conexao);
            $objetoContrato->setContratoCodigo($this->repasseContratoCodigo);
            $objetoContrato->selecionaContrato();
            $vetorContrato = $objetoContrato->getVetorContrato();
    
            if(isset($vetorContrato)) {

                foreach($vetorContrato as $codigo => $vetorFinal) {
                    
                    $contratoDataInicio             = $vetorFinal['contratoDataInicio'];
                    $contratoAluguelValor           = $vetorFinal['contratoAluguelValor'];
                    $contratoIptuValor              = $vetorFinal['contratoIptuValor'];
                    $contratoTaxaAdministracaoValor = $vetorFinal['contratoTaxaAdministracaoValor'];
                    $contratoInsercaoUsuarioCodigo  = $vetorFinal['contratoInsercaoUsuarioCodigo'];

                    $contratoValorRepasse           = $contratoAluguelValor + $contratoIptuValor - $contratoTaxaAdministracaoValor;
                    
                    $diaI = explode("-",$contratoDataInicio);
                    $diaInicio = $diaI[2];
                    
                    if($diaInicio != '01') {

                        $resta = 30 - $diaInicio;
                        
                        $valorAluguelDia          = $contratoAluguelValor / 30;
                        $valorAluguelProporcional = $valorAluguelDia * $resta;

                        $valorIptuDia          = $contratoIptuValor / 30;
                        $valorIptuProporcional = $valorIptuDia * $resta;

                        $valorAdministracaoDia = $contratoTaxaAdministracaoValor / 30;
                        $valorAdministracaoProporcional = $valorAdministracaoDia * $resta;

                        $valorAluguelRepasseProporcional = $valorAluguelProporcional + $valorIptuProporcional - $valorAdministracaoProporcional;
                    }
                    else {

                        $valorAluguelProporcional           = $contratoAluguelValor;
                        $valorIptuProporcional              = $contratoIptuValor;
                        $valorAdministracaoProporcional     = $contratoTaxaAdministracaoValor;
                        
                        $valorAluguelRepasseProporcional = $valorAluguelProporcional + $valorIptuProporcional - $valorAdministracaoProporcional;
                    }

                    for($i = 1; $i <= 12; $i++) {

                        $dataA = explode('-',$contratoDataInicio);
                        $data = new \DateTime($dataA[2].'-'.$dataA[1].'-'.$dataA[0]);
                        $data->modify('+'.$i.' month');
                        $contratoData = $data->format('Y-m');
                        $contratoData = $contratoData."-01";

                        if($i == 1) {

                            $sql = "
                                INSERT INTO repasse
                                (
                                     repasseContratoCodigo
                                    ,repasseValor
                                    ,repasseDataAluguel
                                    ,repasseInsercaoData
                                    ,repasseInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->repasseContratoCodigo."'
                                    ,'".$valorAluguelRepasseProporcional."'
                                    ,'".$contratoData."'
                                    ,'".date('Y-m-d')."'
                                    ,'".$contratoInsercaoUsuarioCodigo."'
                                ) ";
                            $resultado = $this->conexao->query($sql);
                        }
                        else {

                            $sql = "
                                INSERT INTO repasse
                                (
                                     repasseContratoCodigo
                                    ,repasseValor
                                    ,repasseDataAluguel
                                    ,repasseInsercaoData
                                    ,repasseInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->repasseContratoCodigo."'
                                    ,'".$contratoValorRepasse."'
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

        function alteraRepasse() {
		
            $sql = "
                UPDATE 
                    repasse
                SET 
                     repasseContratoCodigo	       = '".$this->repasseContratoCodigo."'
                    ,repasseAluguelData            = '".$this->repasseAluguelData."'
                    ,repasseAluguelTotalValor      = '".$this->repasseAluguelTotalValor."'
                    ,repasseCondominioValor        = '".$this->repasseCondominioValor."'
                    ,repasseIptuValor              = '".$this->repasseIptuValor."'
                    ,repasseTaxaAdministracaoValor = '".$this->repasseTaxaAdministracaoValor."'
                WHERE repasseCodigo                = '".$this->repasseCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function pagarRepasse() {
		
            $sql = "
                UPDATE 
                    repasse
                SET 
                     repasseDataEfetuado = '".$this->repasseDataEfetuado."'
                WHERE repasseCodigo      = '".$this->repasseCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiRepasse() {
		
            $sql = "
                DELETE 
                FROM 
                    repasse 
                WHERE repasseCodigo = '".$this->repasseCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }