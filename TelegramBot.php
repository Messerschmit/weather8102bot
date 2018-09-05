<?php

use GuzzleHttp\Client;

class TelegramBot 
{
    protected $token = "619458384:AAGsRZ17QD0Kgxea_fVj8VW0UVLwDa620d0";
    protected $updateId;
    
    protected function query($method, $params = []){
        
        //Формируем строку для доступа к боту 
        $url = "https://api.telegram.org/bot";
        
        $url .= $this->token;
        
        $url .= "/" . $method;
        
        // Проверяем наличие дополнительно отправленных параметров        
        if (!empty($params)){
            $url .= "?" . http_build_query($params);
        }
        
        //Объект @var Client из расширения guzzlehttp
        $client = new Client ([
            'base_uri' => $url,
        ]);
            
        $result = $client->request('GET'); 
        
        return json_decode($result->getBody()); 
    }
    
    public function getUpdates(){
        
        $response = $this->query('getUpdates',[
            'offset' => $this->updateId + 1,    
        ]);
        
        if (!empty($response->result)){
           
            $this->updateId = $response->result[count($response->result) - 1]->update_id;
        }
        return $response->result;
    }
    
    public function sendMessage($chat_id, $text){
        
        $response = $this->query('sendMessage', [
            'text' => $text,
            'chat_id' => $chat_id,
        ]);
        
        return $response;
    }
    
    
}