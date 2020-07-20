<?php
namespace Learning\FirstUnit\Plugin;

use \Learning\FirstUnit\Block\Jenickpage;
class JenickPlugin {

        public function afterGetSubscriptions() {
            return array('John handsome', 'Jenick handsome', 'Marry beautiful');
        }
//        public function aroundGetSubscription() {
//            $this->beforeGetSubscription();
//            return null;
//        }
//        public function beforeGetSubscription() {
//            return array('ok');
//        }
}