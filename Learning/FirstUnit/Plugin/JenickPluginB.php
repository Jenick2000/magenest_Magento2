<?php
namespace Learning\FirstUnit\plugin;

use \Learning\FirstUnit\Block\Jenickpage;

class JenickPluginB {

    public function afterGetSubscriptions() {
        return array('plugin B');
    }
    public function aroundGetSubscriptions( $next) {

        return $next;
    }

}