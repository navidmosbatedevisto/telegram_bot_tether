<?php

namespace Navid\TelegramTetherBot\Classes\TelegramBot;

use Navid\TelegramTetherBot\Classes\TelegramBot\MessageFactory;
use Navid\TelegramTetherBot\Classes\Config\Manager;

class Bot
{
    protected  $messageFactory;
    protected  $config;
    public function __construct($config)
    {
        $this->config = $config;
        $this->messageFactory = new MessageFactory;
    }

    public function setPriceListingMessage($price_array)
    {
        $this->payload = $this->messageFactory->getTabularRepresentation($price_array);
        return $this;
    }

    public function send()
    {
        // use config for getting dest url
        // curl stuff!
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . $this->config->config['telegram']['token'] . '/sendMessage?chat_id=' . $this->config->config['telegram']['group_id'] . '&parse_mode=html' . '&text=' . urlencode($this->payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17',
            CURLOPT_AUTOREFERER => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response['code'] == 200 ? true : false;
    }
}
