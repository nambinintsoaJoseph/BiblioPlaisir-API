<?php 
    require '../vendor/autoload.php'; 

    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;

    class JWTManagement {
        private $cle_secrete; 

        public function __construct($cle_secrete) {
            $this->cle_secrete = $cle_secrete; 
        }

        public function genererToken($payload) {
            return JWT::encode($payload, $this->cle_secrete, 'HS256');
        }

        public function decoderToken($jwt) {
            return JWT::decode($jwt, new Key($this->cle_secrete, 'HS256'));
        }

        public function validerToken($jwt) {
            try {
                $decode = $this->decoderToken($jwt);
                return $decode;
            } catch (Exception $e) {
                return false; 
            }
        }
    }
?>