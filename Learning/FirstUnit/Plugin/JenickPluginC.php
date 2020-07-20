<?php
namespace Learning\FirstUnit\Plugin;
use \Learning\FirstUnit\Block\Jenickpage;

class JenickPluginC {
    public function afterGetSubscriptions(){
        return array('plugin C');
    }

}