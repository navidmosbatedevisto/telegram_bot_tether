<?php
namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class Tetheriran extends TetherPriceProvider {
    protected function extractSellPrice($response){
        return json_decode($response,true)['sale'];
    }

    protected function extractBuyPrice($response){
        return json_decode($response,true)['buy'];
    }
}