<?php
namespace Navid\TelegramTetherBot\Classes\TetherPriceProviders;

class Tetherland extends TetherPriceProvider {
    // protected function extractSellPrice($response){
    //     return json_decode($response,true)['USDT']['sell'];
    // }

    protected function extractBuyPrice($response){
        return json_decode($response,true)['data']['currencies']['USDT']['price'];
    }
}