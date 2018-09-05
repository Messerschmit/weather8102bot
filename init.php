<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require __DIR__ . '/vendor/autoload.php';
    include 'TelegramBot.php';
    include 'Weather.php';
    // //Получить сообщение, которое написали боту
    $telegtamApi = new TelegramBot();
    
    $weatherApi = new Weather();
    
    while(true){
        
        sleep(2);
        
        $updates = $telegtamApi->getUpdates();
        
        // //Проходим по каждому сообщению
        foreach ($updates as $update){
            
            if (isset($update->message->location)){
                //get forecast
                $responseWeather = $weatherApi->getWeatherByCoord($update->message->location->latitude, $update->message->location->longitude);
                //формируем строку ответа
                $responce = $responseWeather->weather[0]->main;
                //Отвечаем на каждое сообщение
                $telegtamApi->sendMessage($update->message->chat->id, $responce);
            }else {
                
            $responseWeather = $weatherApi->getWeatherByCityName($update->message->text);
            $telegtamApi->sendMessage($update->message->chat->id, $responseWeather->weather[0]->description);
            }

        } 
    }

    
?>