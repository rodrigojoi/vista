<?php
    
    namespace assets\classes;
    use PDO;

    class Locatario
    {

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $locatarioCodigo; 
        var $locatarioNome;
        var $locatarioEmail;
        var $locatarioTelefone;
        var $locatarioInsercaoData;
        var $locatarioInsercaoUsuarioCodigo;
        var $vetorLocatario;

        public function setLocatarioCodigo($locatarioCodigo) 
        {
            $this->locatarioCodigo = $locatarioCodigo;
        }
        public function getLocatarioCodigo()
        {
            return $this->locatarioCodigo;
        }
        
        public function setLocatarioNome($locatarioNome) 
        {
            $this->locatarioNome = $locatarioNome;
        }
        public function getLocatarioNome()
        {
            return $this->locatarioNome;
        }
        
        public function setLocatarioEmail($locatarioEmail) 
        {
            $this->locatarioEmail = $locatarioEmail;
        }
        public function getLocatarioEmail()
        {
            return $this->locatarioEmail;
        }
        
        public function setLocatarioTelefone($locatarioTelefone) 
        {
            $this->locatarioTelefone = $locatarioTelefone;
        }
        public function getLocatarioTelefone()
        {
            return $this->locatarioTelefone;
        }
	
        function getLocatarioInsercaoData() {
            return $this->locatarioInsercaoData;
        }
        function setLocatarioInsercaoData($locatarioInsercaoData) {
            
            if(isset($locatarioInsercaoData)) {
                
                $data = explode('/', $locatarioInsercaoData);
                $locatarioInsercaoData = $data['2']."-".$data['1']."-".$data['0'];
                $this->locatarioInsercaoData = $locatarioInsercaoData;
            }
        }
        
        public function setLocatarioInsercaoUsuarioCodigo($locatarioInsercaoUsuarioCodigo) 
        {
            $this->locatarioInsercaoUsuarioCodigo = $locatarioInsercaoUsuarioCodigo;
        }
        public function getLocatarioInsercaoUsuarioCodigo()
        {
            return $this->locatarioInsercaoUsuarioCodigo;
        }
        
        public function getVetorLocatario() {
            return $this->vetorLocatario;
        }
        public function setVetorLocatario($vetorLocatario) {
            $this->vetorLocatario = $vetorLocatario;
        }

        public function selecionaLocatario() 
        {

            $sql = "
                SELECT 
                     locatarioCodigo
                    ,locatarioNome
                    ,locatarioEmail
                    ,locatarioTelefone
                    ,locatarioInsercaoData
                    ,locatarioInsercaoUsuarioCodigo
                FROM locatario
                WHERE 1 ";
            if($this->locatarioCodigo) 
            {
                $sql .= " AND locatarioCodigo = '".$this->locatarioCodigo."'";
            }
            $sql .= " ORDER BY locatarioNome ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['locatarioCodigo'];
                
                $vetor[$codigo]['locatarioCodigo']		 = $linha['locatarioCodigo'];
                $vetor[$codigo]['locatarioNome']		 = $linha['locatarioNome'];
                $vetor[$codigo]['locatarioEmail']		 = $linha['locatarioEmail'];
                $vetor[$codigo]['locatarioTelefone']	 = $linha['locatarioTelefone'];
                $vetor[$codigo]['locatarioInsercaoData'] = $linha['locatarioInsercaoData'];
            }
            if(isset($codigo)) {

                $this->setVetorLocatario($vetor);
            }
        }

        public function insereLocatario() {
		
            $sql = "
                INSERT INTO locatario
                (
                     locatarioNome
                    ,locatarioEmail
                    ,locatarioTelefone
                    ,locatarioInsercaoData
                    ,locatarioInsercaoUsuarioCodigo
                )
                VALUES
                (
                     '".$this->locatarioNome."'
                    ,'".$this->locatarioEmail."'
                    ,'".$this->locatarioTelefone."'
                    ,'".$this->locatarioInsercaoData."'
                    ,'".$this->locatarioInsercaoUsuarioCodigo."'
                ) ";
                
            $resultado = $this->conexao->query($sql);
            
        }

        function alteraLocatario() {
		
            $sql = "
                UPDATE 
                    locatario
                SET 
                     locatarioNome	   = '".$this->locatarioNome."'
                    ,locatarioEmail	   = '".$this->locatarioEmail."'
                    ,locatarioTelefone = '".$this->locatarioTelefone."'
                WHERE locatarioCodigo  = '".$this->locatarioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiLocatario() {
		
            $sql = "
                DELETE 
                FROM 
                    locatario 
                WHERE locatarioCodigo = '".$this->locatarioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }