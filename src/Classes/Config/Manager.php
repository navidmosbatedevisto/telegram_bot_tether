<?php
namespace Navid\TelegramTetherBot\Classes\Config;

class Manager {
    
    public $config;
    
    public function __construct($config) {
        $this->config = $config;
    }

  
    public function getAvailableProviders() : array { 
        // use $this->config
        return $this->config['providers'];
    }

    public function getEnabledProviders() : array { 
        $enabledProviders = [];
        foreach ($this->getAvailableProviders() as $providerClass => $config) {
            if(($config['enabled'] ?? false) === true){
                $enabledProviders[$providerClass] =  $config;
            }
        }
        return $enabledProviders;
    }

  
}