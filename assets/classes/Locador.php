<?php
    
    namespace assets\classes;
    use PDO;

    class Locador
    {

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $locadorCodigo; 
        var $locadorNome;
        var $locadorEmail;
        var $locadorTelefone;
        var $locadorDiaRepasse;
        var $locadorInsercaoData;
        var $locadorInsercaoUsuarioCodigo;
        var $vetorLocador;

        public function setLocadorCodigo($locadorCodigo) 
        {
            $this->locadorCodigo = $locadorCodigo;
        }
        public function getLocadorCodigo()
        {
            return $this->locadorCodigo;
        }
        
        public function setLocadorNome($locadorNome) 
        {
            $this->locadorNome = $locadorNome;
        }
        public function getLocadorNome()
        {
            return $this->locadorNome;
        }
        
        public function setLocadorEmail($locadorEmail) 
        {
            $this->locadorEmail = $locadorEmail;
        }
        public function getLocadorEmail()
        {
            return $this->locadorEmail;
        }
        
        public function setLocadorTelefone($locadorTelefone) 
        {
            $this->locadorTelefone = $locadorTelefone;
        }
        public function getLocadorTelefone()
        {
            return $this->locadorTelefone;
        }
        
        public function setLocadorDiaRepasse($locadorDiaRepasse) 
        {
            $this->locadorDiaRepasse = $locadorDiaRepasse;
        }
        public function getLocadorDiaRepasse()
        {
            return $this->locadorDiaRepasse;
        }
	
        function getLocadorInsercaoData() {
            return $this->locadorInsercaoData;
        }
        function setLocadorInsercaoData($locadorInsercaoData) {
            
            if(isset($locadorInsercaoData)) {
                
                $data = explode('/', $locadorInsercaoData);
                $locadorInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->locadorInsercaoData = $locadorInsercaoData;
            }
        }
        
        public function setLocadorInsercaoUsuarioCodigo($locadorInsercaoUsuarioCodigo) 
        {
            $this->locadorInsercaoUsuarioCodigo = $locadorInsercaoUsuarioCodigo;
        }
        public function getLocadorInsercaoUsuarioCodigo()
        {
            return $this->locadorInsercaoUsuarioCodigo;
        }
        
        public function getVetorLocador() {
            return $this->vetorLocador;
        }
        public function setVetorLocador($vetorLocador) {
            $this->vetorLocador = $vetorLocador;
        }

        public function selecionaLocador() 
        {

            $sql = "
                SELECT 
                     locadorCodigo
                    ,locadorNome
                    ,locadorEmail
                    ,locadorTelefone
                    ,locadorDiaRepasse
                    ,locadorInsercaoData
                    ,locadorInsercaoUsuarioCodigo
                FROM locador
                WHERE 1 ";
            if($this->locadorCodigo) 
            {
                $sql .= " AND locadorCodigo = '".$this->locadorCodigo."'";
            }
            $sql .= " ORDER BY locadorNome ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['locadorCodigo'];
                
                $vetor[$codigo]['locadorCodigo']       = $linha['locadorCodigo'];
                $vetor[$codigo]['locadorNome']		   = $linha['locadorNome'];
                $vetor[$codigo]['locadorEmail']		   = $linha['locadorEmail'];
                $vetor[$codigo]['locadorTelefone']	   = $linha['locadorTelefone'];
                $vetor[$codigo]['locadorDiaRepasse']   = $linha['locadorDiaRepasse'];
                $vetor[$codigo]['locadorInsercaoData'] = $linha['locadorInsercaoData'];
            }
            if(isset($codigo)) {

                $this->setVetorLocador($vetor);
            }
        }

        public function insereLocador() {
		
            $sql = "
                INSERT INTO locador
                (
                     locadorNome
                    ,locadorEmail
                    ,locadorTelefone
                    ,locadorDiaRepasse
                    ,locadorInsercaoData
                    ,locadorInsercaoUsuarioCodigo
                )
                VALUES
                (
                     '".$this->locadorNome."'
                    ,'".$this->locadorEmail."'
                    ,'".$this->locadorTelefone."'
                    ,'".$this->locadorDiaRepasse."'
                    ,'".$this->locadorInsercaoData."'
                    ,'".$this->locadorInsercaoUsuarioCodigo."'
                ) ";
                
            $resultado = $this->conexao->query($sql);
            
        }

        function alteraLocador() {
		
            $sql = "
                UPDATE 
                    locador
                SET 
                     locadorNome	   = '".$this->locadorNome."'
                    ,locadorEmail	   = '".$this->locadorEmail."'
                    ,locadorTelefone   = '".$this->locadorTelefone."'
                    ,locadorDiaRepasse = '".$this->locadorDiaRepasse."'
                WHERE locadorCodigo    = '".$this->locadorCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiLocador() {
		
            $sql = "
                DELETE 
                FROM 
                    locador 
                WHERE locadorCodigo = '".$this->locadorCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }