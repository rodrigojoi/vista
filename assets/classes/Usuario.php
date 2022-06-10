<?php
    
    namespace assets\classes;
    use PDO;

    class Usuario
    {

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        var $usuarioCodigo; 
        var $usuarioNome;
        var $usuarioCelular;
        var $usuarioEmail;
        var $usuarioSenha;
        var $usuarioFoto;
        var $vetorUsuario;

        public function setUsuarioCodigo($usuarioCodigo) 
        {
            $this->usuarioCodigo = $usuarioCodigo;
        }
        public function getUsuarioCodigo()
        {
            return $this->usuarioCodigo;
        }
        
        public function setUsuarioNome($usuarioNome) 
        {
            $this->usuarioNome = $usuarioNome;
        }
        public function getUsuarioNome()
        {
            return $this->usuarioNome;
        }
        
        public function setUsuarioEmail($usuarioEmail) 
        {
            $this->usuarioEmail = $usuarioEmail;
        }
        public function getUsuarioEmail()
        {
            return $this->usuarioEmail;
        }
        
        public function setUsuarioCelular($usuarioCelular) 
        {
            $this->usuarioCelular = $usuarioCelular;
        }
        public function getUsuarioCelular()
        {
            return $this->usuarioCelular;
        }
        
        public function setUsuarioSenha($usuarioSenha) 
        {
            $this->usuarioSenha = $usuarioSenha;
        }
        public function getUsuarioSenha()
        {
            return $this->usuarioSenha;
        }
        
        public function setUsuarioFoto($usuarioFoto) 
        {
            $this->usuarioFoto = $usuarioFoto;
        }
        public function getUsuarioFoto()
        {
            return $this->usuarioFoto;
        }
        
        public function getVetorUsuario() {
            return $this->vetorUsuario;
        }
        public function setVetorUsuario($vetorUsuario) {
            $this->vetorUsuario = $vetorUsuario;
        }

        public function selecionaUsuario() 
        {

            $sql = "
                SELECT 
                     usuarioCodigo
                    ,usuarioNome
                    ,usuarioEmail
                    ,usuarioCelular
                    ,usuarioFoto
                    ,usuarioSenha
                FROM usuario
                WHERE 1 ";
            if($this->usuarioCodigo) 
            {
                $sql .= " AND usuarioCodigo = '".$this->usuarioCodigo."'";
            }
            if($this->usuarioEmail) 
            {
                $sql .= " AND usuarioEmail = '".$this->usuarioEmail."'";
            }
            if($this->usuarioSenha) 
            {
                $sql .= " AND usuarioSenha = '".$this->usuarioSenha."'";
            }
            $sql .= " ORDER BY usuarioNome ASC";
                
            $resultado = $this->conexao->query($sql);

            while($linha = $resultado->fetch()) {
                
                $codigo = $linha['usuarioCodigo'];
                
                $vetor[$codigo]['usuarioCodigo']  = $linha['usuarioCodigo'];
                $vetor[$codigo]['usuarioNome']	  = $linha['usuarioNome'];
                $vetor[$codigo]['usuarioEmail']	  = $linha['usuarioEmail'];
                $vetor[$codigo]['usuarioCelular'] = $linha['usuarioCelular'];
                $vetor[$codigo]['usuarioFoto']    = $linha['usuarioFoto'];
                $vetor[$codigo]['usuarioSenha']   = $linha['usuarioSenha'];
            }
            if(isset($codigo)) {

                $this->setVetorUsuario($vetor);
            }
        }

        public function insereUsuario() {
		
            $sql = "
                INSERT INTO usuario
                (
                     usuarioNome
                    ,usuarioEmail
                    ,usuarioCelular
                    ,usuarioSenha
                )
                VALUES
                (
                     '".$this->usuarioNome."'
                    ,'".$this->usuarioEmail."'
                    ,'".$this->usuarioCelular."'
                    ,'".$this->usuarioSenha."'
                ) ";
                
            $resultado = $this->conexao->query($sql);
            
        }

        function alteraUsuario() {
		
            $sql = "
                UPDATE 
                    usuario
                SET 
                     usuarioNome	= '".$this->usuarioNome."'
                    ,usuarioEmail	= '".$this->usuarioEmail."'
                    ,usuarioCelular = '".$this->usuarioCelular."'
                    ,usuarioSenha   = '".$this->usuarioSenha."'
                    ,usuarioFoto    = '".$this->usuarioFoto."'
                WHERE usuarioCodigo = '".$this->usuarioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function alteraSenha() {
		
            $sql = "
                UPDATE 
                    usuario
                SET 
                     usuarioSenha   = '".$this->usuarioSenha."'
                WHERE usuarioCodigo = '".$this->usuarioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }

        function excluiUsuario() {
		
            $sql = "
                DELETE 
                FROM 
                    usuario 
                WHERE usuarioCodigo = '".$this->usuarioCodigo."' ";
                
            $resultado = $this->conexao->query($sql);
        }          
    }