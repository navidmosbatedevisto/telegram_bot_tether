<?php
namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class AbanTether extends TetherPriceProvider {
    protected function extractSellPrice($response){
        return array_values(array_filter(json_decode($response,true),function($item){return $item['symbol'] == 'USDT';}))
[0]['priceSell'];
    }

    protected function extractBuyPrice($response){
return array_values(array_filter(json_decode($response,true),function($item){return $item['symbol'] == 'USDT';}))
[0]['priceBuy'];    }
}