<?php
namespace Navid\TelegramTetherBot;

require dirname(__FILE__) . "/../vendor/autoload.php";

use Classes\TetherPriceProviders\TetherPriceProvider;
use Navid\TelegramTetherBot\Classes\TelegramBot\Bot;
use Navid\TelegramTetherBot\Classes\Config\Manager;

$config = require dirname(__FILE__) . "/../config.php";
$configManager = new Manager($config);

$enabledProviders = $configManager->getEnabledProviders();

$allProviderPrices = [];
foreach ($enabledProviders as $providerClass => $providerConfig){
  $allProviderPrices[$providerConfig['label']] = 
    (new $providerClass($providerConfig['name'],$providerConfig['label'],$providerConfig['url']))->getPrices()
  ;
}

$botStatus = (new Bot($configManager))->setPriceListingMessage($allProviderPrices)->send();