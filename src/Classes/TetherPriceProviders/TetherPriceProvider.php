<?php

namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class TetherPriceProvider
{

    public $name;
    public $label;
    public $url;
    public $logo_name;

    public  function __construct($name, $label, $url, $logo_name = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->url = $url;
        $this->logo_name = $logo_name;
    }

    public function getPrices()
    {
        $response = $this->getProviderResponse();
        $pricesArray = [
            "sell" => $this->extractSellPrice($response),
            "buy" => $this->extractBuyPrice($response)
        ];

        return $pricesArray;

    }

    public function getProviderResponse()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 50,
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
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/../../../cookie.txt');

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    protected function extractSellPrice($response){
        return '-----';
    }

    protected function extractBuyPrice($response){
        return '-----';
    }
}
