<?php
    
    namespace assets\classes;
    use assets\classes\Contrato;
    use PDO;

    class Mensalidade
    {
        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $mensalidadeCodigo; 
        var $mensalidadeContratoCodigo;
        var $mensalidadeAluguelData;
        var $mensalidadeAluguelTotalValor;
        var $mensalidadeCondominioValor;
        var $mensalidadeIptuValor;
        var $mensalidadeTaxaAdministracaoValor;
        var $mensalidadeDataRecebimento;
        var $mensalidadeInsercaoData;
        var $mensalidadeInsercaoUsuarioCodigo;
        var $vetorMensalidade;

        public function setMensalidadeCodigo($mensalidadeCodigo) 
        {
            $this->mensalidadeCodigo = $mensalidadeCodigo;
        }
        public function getMensalidadeCodigo()
        {
            return $this->mensalidadeCodigo;
        }
        
        public function setMensalidadeContratoCodigo($mensalidadeContratoCodigo) 
        {
            $this->mensalidadeContratoCodigo = $mensalidadeContratoCodigo;
        }
        public function getMensalidadeContratoCodigo()
        {
            return $this->mensalidadeContratoCodigo;
        }
        
        public function setMensalidadeLocatarioCodigo($mensalidadeLocatarioCodigo) 
        {
            $this->mensalidadeLocatarioCodigo = $mensalidadeLocatarioCodigo;
        }
        public function getMensalidadeLocatarioCodigo()
        {
            return $this->mensalidadeLocatarioCodigo;
        }
	
        function setMensalidadeAluguelData($mensalidadeAluguelData) {
            
            if(isset($mensalidadeAluguelData)) {
                
                $data = explode('/', $mensalidadeAluguelData);
                $mensalidadeAluguelData = $data['2']."-".$data['1']."-".$data['0'];
                $this->mensalidadeAluguelData = $mensalidadeAluguelData;
            }
        }
        function getMensalidadeAluguelData() 
        {
            return $this->mensalidadeAluguelData;
        }
	
        function setMensalidadeAluguelTotalValor($mensalidadeAluguelTotalValor) {
            
            $this->mensalidadeAluguelTotalValor = $mensalidadeAluguelTotalValor;
        }
        function getMensalidadeAluguelTotalValor() 
        {
            return $this->mensalidadeAluguelTotalValor;
        }
        
        public function setMensalidadeCondominioValor($mensalidadeCondominioValor) 
        {
            $this->mensalidadeCondominioValor = $mensalidadeCondominioValor;
        }
        public function getMensalidadeCondominioValor()
        {
            return $this->mensalidadeCondominioValor;
        }
        
        public function setMensalidadeIptuValor($mensalidadeIptuValor) 
        {
            $this->mensalidadeIptuValor = $mensalidadeIptuValor;
        }
        public function getMensalidadeIptuValor()
        {
            return $this->mensalidadeIptuValor;
        }
        
        public function setMensalidadeTaxaAdministracaoValor($mensalidadeTaxaAdministracaoValor) 
        {
            $this->mensalidadeTaxaAdministracaoValor = $mensalidadeTaxaAdministracaoValor;
        }
        public function getMensalidadeTaxaAdministracaoValor()
        {
            return $this->mensalidadeTaxaAdministracaoValor;
        }
	
        function setMensalidadeDataRecebimento($mensalidadeDataRecebimento) {
            
            if(isset($mensalidadeDataRecebimento)) {
                
                $this->mensalidadeDataRecebimento = $mensalidadeDataRecebimento;
            }
        }
        function getMensalidadeDataRecebimento() 
        {
            return $this->mensalidadeDataRecebimento;
        }
	
        function setMensalidadeInsercaoData($mensalidadeInsercaoData) {
            
            if(isset($mensalidadeInsercaoData)) {
                
                $data = explode('/', $mensalidadeInsercaoData);
                $mensalidadeInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->mensalidadeInsercaoData = $mensalidadeInsercaoData;
            }
        }
        function getMensalidadeInsercaoData() 
        {
            return $this->mensalidadeInsercaoData;
        }
        
        public function setMensalidadeInsercaoUsuarioCodigo($mensalidadeInsercaoUsuarioCodigo) 
        {
            $this->mensalidadeInsercaoUsuarioCodigo = $mensalidadeInsercaoUsuarioCodigo;
        }
        public function getMensalidadeInsercaoUsuarioCodigo()
        {
            return $this->mensalidadeInsercaoUsuarioCodigo;
        }
        
        public function getVetorMensalidade() {
            return $this->vetorMensalidade;
        }
        public function setVetorMensalidade($vetorMensalidade) {
            $this->vetorMensalidade = $vetorMensalidade;
        }

        public function selecionaMensalidade() 
        {

            $sql = "
                SELECT 
                     mensalidadeCodigo
                    ,mensalidadeContratoCodigo
                    ,mensalidadeAluguelData
                    ,mensalidadeAluguelTotalValor
                    ,mensalidadeCondominioValor
                    ,mensalidadeIptuValor
                    ,mensalidadeTaxaAdministracaoValor
                    ,mensalidadeDataRecebimento
                    ,mensalidadeInsercaoData
                    ,mensalidadeInsercaoUsuarioCodigo
                    ,imovel.imovelEndereco
                FROM mensalidade
                LEFT JOIN contrato ON contrato.contratoCodigo = mensalidade.mensalidadeContratoCodigo
                LEFT JOIN imovel   ON imovel.imovelCodigo     = contrato.contratoImovelCodigo
                WHERE 1 ";
            if($this->mensalidadeCodigo) 
            {
                $sql .= " AND mensalidadeCodigo = '".$this->mensalidadeCodigo."'";
            }
            if($this->mensalidadeContratoCodigo) 
            {
                $sql .= " AND mensalidadeContratoCodigo = '".$this->mensalidadeContratoCodigo."'";
            }
            $sql .= " ORDER BY mensalidadeAluguelData ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['mensalidadeCodigo'];
                
                $vetor[$codigo]['mensalidadeCodigo']                 = $linha['mensalidadeCodigo'];
                $vetor[$codigo]['mensalidadeContratoCodigo']         = $linha['mensalidadeContratoCodigo'];
                $vetor[$codigo]['mensalidadeAluguelData']            = $linha['mensalidadeAluguelData'];
                $vetor[$codigo]['mensalidadeAluguelTotalValor']		 = $linha['mensalidadeAluguelTotalValor'];
                $vetor[$codigo]['mensalidadeCondominioValor']		 = $linha['mensalidadeCondominioValor'];
                $vetor[$codigo]['mensalidadeIptuValor']              = $linha['mensalidadeIptuValor'];
                $vetor[$codigo]['mensalidadeTaxaAdministracaoValor'] = $linha['mensalidadeTaxaAdministracaoValor'];
                $vetor[$codigo]['mensalidadeDataRecebimento']        = $linha['mensalidadeDataRecebimento'];
                $vetor[$codigo]['mensalidadeInsercaoData']           = $linha['mensalidadeInsercaoData'];
                $vetor[$codigo]['mensalidadeInsercaoUsuarioCodigo']  = $linha['mensalidadeInsercaoUsuarioCodigo'];
                $vetor[$codigo]['imovelEndereco']                    = $linha['imovelEndereco'];
            }
            if(isset($codigo)) {

                $this->setVetorMensalidade($vetor);
            }
        }

        public function insereMensalidade() {

            $objetoContrato = new Contrato($this->conexao);
            $objetoContrato->setContratoCodigo($this->mensalidadeContratoCodigo);
            $objetoContrato->selecionaContrato();
            $vetorContrato = $objetoContrato->getVetorContrato();
    
            if(isset($vetorContrato)) {

                foreach($vetorContrato as $codigo => $vetorFinal) {
                    
                    $contratoDataInicio             = $vetorFinal['contratoDataInicio'];
                    $contratoAluguelValor           = $vetorFinal['contratoAluguelValor'];
                    $contratoAluguelValorTotal      = $vetorFinal['contratoAluguelValorTotal'];
                    $contratoCondominioValor        = $vetorFinal['contratoCondominioValor'];
                    $contratoIptuValor              = $vetorFinal['contratoIptuValor'];
                    $contratoTaxaAdministracaoValor = $vetorFinal['contratoTaxaAdministracaoValor'];
                    $contratoInsercaoUsuarioCodigo  = $vetorFinal['contratoInsercaoUsuarioCodigo'];
                    
                    $diaI = explode("-",$contratoDataInicio);
                    $diaInicio = $diaI[2];
                    
                    if($diaInicio != '01') {

                        $resta = 30 - $diaInicio;
                        
                        $valorAluguelDia          = $contratoAluguelValor / 30;
                        $valorAluguelProporcional = $valorAluguelDia * $resta;
                        
                        $valorAluguelTotalDia          = $contratoAluguelValorTotal / 30;
                        $valorAluguelTotalProporcional = $valorAluguelTotalDia * $resta;

                        $valorCondominioDia          = $contratoCondominioValor / 30;
                        $valorCondominioProporcional = $valorCondominioDia * $resta;                        

                        $valorIptuDia          = $contratoIptuValor / 30;
                        $valorIptuProporcional = $valorIptuDia * $resta;               

                        $valorTaxaAdministracaoDia          = $contratoTaxaAdministracaoValor / 30;
                        $valorTaxaAdministracaoProporcional = $valorTaxaAdministracaoDia * $resta;
                    }
                    else {

                        $valorAluguelProporcional           = $contratoAluguelValor;
                        $valorAluguelTotalProporcional      = $contratoAluguelValorTotal;
                        $valorCondominioProporcional        = $contratoCondominioValor;
                        $valorIptuProporcional              = $contratoIptuValor;
                        $valorTaxaAdministracaoProporcional = $contratoTaxaAdministracaoValor;
                    }

                    for($i = 1; $i <= 12; $i++) {

                        $dataA = explode('-',$contratoDataInicio);
                        $data = new \DateTime($dataA[2].'-'.$dataA[1].'-'.$dataA[0]);
                        $data->modify('+'.$i.' month');
                        $contratoData = $data->format('Y-m');
                        $contratoData = $contratoData."-01";

                        if($i == 1) {

                            $sql = "
                                INSERT INTO mensalidade
                                (
                                     mensalidadeContratoCodigo
                                    ,mensalidadeAluguelData
                                    ,mensalidadeAluguelTotalValor
                                    ,mensalidadeCondominioValor
                                    ,mensalidadeIptuValor
                                    ,mensalidadeTaxaAdministracaoValor
                                    ,mensalidadeInsercaoData
                                    ,mensalidadeInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->mensalidadeContratoCodigo."'
                                    ,'".$contratoData."'
                                    ,'".$valorAluguelTotalProporcional."'
                                    ,'".$valorCondominioProporcional."'
                                    ,'".$valorIptuProporcional."'
                                    ,'".$valorTaxaAdministracaoProporcional."'
                                    ,'".date('Y-m-d')."'
                                    ,'".$contratoInsercaoUsuarioCodigo."'
                                ) ";
                            $resultado = $this->conexao->query($sql);
                        }
                        else {

                            $sql = "
                                INSERT INTO mensalidade
                                (
                                     mensalidadeContratoCodigo
                                    ,mensalidadeAluguelData
                                    ,mensalidadeAluguelTotalValor
                                    ,mensalidadeCondominioValor
                                    ,mensalidadeIptuValor
                                    ,mensalidadeTaxaAdministracaoValor
                                    ,mensalidadeInsercaoData
                                    ,mensalidadeInsercaoUsuarioCodigo
                                )
                                VALUES
                                (
                                     '".$this->mensalidadeContratoCodigo."'
                                    ,'".$contratoData."'
                                    ,'".$contratoAluguelValorTotal."'
                                    ,'".$contratoCondominioValor."'
                                    ,'".$contratoIptuValor."'
                                    ,'".$contratoTaxaAdministracaoValor."'
                                    ,'".date('Y-m-d')."'
                                    ,'".$contratoInsercaoUsuarioCodigo."'
                                ) ";
                            $resultado = $this->conexao->query($sql);
                        }
                    }
                }
            }
        }

        function alteraMensalidade() {
		
            $sql = "
                UPDATE 
                    mensalidade
                SET 
                     mensalidadeContratoCodigo	       = '".$this->mensalidadeContratoCodigo."'
                    ,mensalidadeAluguelData            = '".$this->mensalidadeAluguelData."'
                    ,mensalidadeAluguelTotalValor      = '".$this->mensalidadeAluguelTotalValor."'
                    ,mensalidadeCondominioValor        = '".$this->mensalidadeCondominioValor."'
                    ,mensalidadeIptuValor              = '".$this->mensalidadeIptuValor."'
                    ,mensalidadeTaxaAdministracaoValor = '".$this->mensalidadeTaxaAdministracaoValor."'
                WHERE mensalidadeCodigo                = '".$this->mensalidadeCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function pagarMensalidade() {
		
            $sql = "
                UPDATE 
                    mensalidade
                SET 
                     mensalidadeDataRecebimento        = '".$this->mensalidadeDataRecebimento."'
                WHERE mensalidadeCodigo                = '".$this->mensalidadeCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiMensalidade() {
		
            $sql = "
                DELETE 
                FROM 
                    mensalidade 
                WHERE mensalidadeCodigo = '".$this->mensalidadeCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }