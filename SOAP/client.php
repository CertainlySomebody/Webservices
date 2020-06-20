<?php

    class client {
        
        public function __construct() {
            $params = array(
                'location' => 'http://localhost/webservices/SOAP/server.php',
                'uri' => 'urn://localhost/webservices/SOAP/server.php',
                'trace' => true);

            $this->instance = new SoapClient(Null, $params);
        }

        public function login($email, $pswd) {
            $acc = new stdClass();
            $acc->email = $email;
            $acc->password = $pswd;
            $get_params = new SoapVar($acc, SOAP_ENC_OBJECT);
            $header = new SoapHeader('log', 'login', $get_params, false);
            $this->instance->__setSoapHeaders(array($header));
            return $this->instance->__soapCall('login', array($get_params));
        }

    }
?>