<?php
namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class CryptoKif extends TetherPriceProvider {
    protected function extractSellPrice($response){
        return json_decode($response,true)['sale'];
    }

    protected function extractBuyPrice($response){
        return json_decode($response,true)['buy'];
    }
}