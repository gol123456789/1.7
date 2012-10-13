<?php
    class PinterestApi {
        const REQUIRED = 'Arg is required';
        const RECORDS_PER_PAGE = 36;
        const PINTEREST_SECURE_URL = 'https://pinterest.com';        
        const PINTEREST_UNSECURE_URL = 'http://pinterest.com';
        const PINTEREST_API_URL = 'https://api.pinterest.com';
                
        protected $_baseUrl;
        protected $_accessToken;
        
        public function __construct($accessToken='') {
            $this->_baseUrl = self::PINTEREST_API_URL . '/v2';
            $this->_accessToken = $accessToken;
        }                       
                
        public function getPinInfo($pin_id) {
			$endpoint = '/pin/' . $pin_id . '/';			
			
            return $this->get($endpoint);
        }
    
		public function getUserInfo($username) {            			
            $endpoint = '/users/' . $username . '/';
                        
            return $this->get($endpoint);              
        }

        public function getPinsOf($username, $params = array()) {
            $params = self::filterParams($params, array(
                'limit' => self::RECORDS_PER_PAGE,
                'page' => 1
            ));
                    	
			$endpoint = '/users/' . $username . '/pins/';			
			
            return $this->get($endpoint, $params);
        }

        public function popular($params = array()) {
            $params = self::filterParams($params, array(
                'limit' => self::RECORDS_PER_PAGE,
                'page' => 1
            ));
            
            return $this->get('/popular/', $params);
        }

        public function getBoardOf($username, $board_slug, $params = array()) {
            $params = self::filterParams($params, array(
                'limit' => self::RECORDS_PER_PAGE,
                'page' => 1
            ));
                    	
			$endpoint = '/boards/' . $username . '/' . $board_slug . '/';	
						
            return $this->get($endpoint, $params);    
        }               

		public function getFollowersOf($username, $params = array()) {
            $params = self::filterParams($params, array(
                'limit' => self::RECORDS_PER_PAGE,
                'page' => 1
            ));
                    	
			$endpoint = '/users/' . $username . '/followers/';			
			
            return $this->get($endpoint, $params);
        }
                
        static function getUserUrl($username) {
        	return self::PINTEREST_UNSECURE_URL . '/' . $username; 
        }
                
        static function getPinUrl($pinId) {
        	return self::PINTEREST_UNSECURE_URL . '/pin/' . $pinId; 
        }        
        
        public function get($endpoint, $params = array()) {
            $ch=curl_init();
            
            if ($this->_accessToken && !isset($params['access_token'])) {
                $params['access_token'] = $this->_accessToken;
            }
            
            foreach ($params as $k => $v){
                $encoded_params[] = urlencode($k).'='.urlencode($v);
            }
            
            $requestUrl = $this->_baseUrl . $endpoint . "?" . implode('&', $encoded_params);
            
            curl_setopt($ch, CURLOPT_URL, $requestUrl);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
            $resp=curl_exec($ch);            
            $info = curl_getinfo($ch);
            curl_close($ch);
            
            return $resp;
        }
                
        static function filterParams($params, $defaults) {            
            foreach ($defaults as $k => $v) {                
                if (!isset($params[$k])) {                    
                    if ($v === self::REQUIRED) {                        
                        $trace = debug_backtrace();
                        $function = $trace[1]['function'];
                        $caller = $trace[2]['function'].' in '.$trace[2]['file'].':'.$trace[2]['line'];
                        trigger_error(self::REQUIRED . ": $k (caller was $caller)");
                    
                    } else {
                        $params[$k] = $v;
                    }
                }
            }
            
            return $params;
        }        
        
    } // end class Pinterest_API
