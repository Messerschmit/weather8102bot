<?php

use GuzzleHttp\Client;

class Weather 
{
        protected $token = "8e4c17b29f3268d4813b4a45db508f26";
        
        public function getWeatherByCoord($lat, $lon){
            
            $url = "api.openweathermap.org/data/2.5/weather";
            
            $params = [];
            
            $params['lat'] = $lat;
            $params['lon'] = $lon;
            $params['APPID'] = $this->token;
            
            $url .= "?" . http_build_query($params);
            
            $client = new Client ([
                'base_uri' => $url,    
            ]);
            
            $result = $client->request('GET'); 
        
            return json_decode($result->getBody()); 
            
        }
        
        public function getWeatherByCityName($cityName){
            // todo: доработать получение url (есть ошибка при назначении города)
            $url = "api.openweathermap.org/data/2.5/weather";
            
            $params = [];
            $params['q'] = $cityName;
            $params['APPID'] = $this->token;
            
            $url.= "?" . http_build_query($params);
            
            $client = new Client ([
                'base_uri' => $url,    
            ]);
            
            $result = $client->request('GET'); 
        
            return json_decode($result->getBody()); 
        }
        
}
    
    
    