<?php
namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class SarafiTether extends TetherPriceProvider {
    protected function extractSellPrice($response){
        return json_decode($response,true)['USDT']['sell'];
    }

    protected function extractBuyPrice($response){
        return json_decode($response,true)['USDT']['buy'];
    }
}