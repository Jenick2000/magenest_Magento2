<?php

namespace Learning\FirstUnit\Plugin;

use \Learning\FirstUnit\Block\Jenickpage;

class JenickPlugin
{

//    public function afterGetSubscriptions()
//    {
//        return array('John handsome', 'Jenick handsome', 'Marry beautiful');
//    }
//        public function aroundGetSubscription() {
//            $this->beforeGetSubscription();
//            return null;
//        }
//        public function beforeGetSubscription() {
//            return array('ok');
//        }

    public function beforeSetName($subject, $name, $age)
    {
        $name = 'Jenick';
        $age = 25;
        return [$name, $age];
    }

    public function beforeTest($subject, $pra1, $pra2)
    {
        $pra2 = 'Thu Thuy';
        return [$pra1, $pra2];
    }

    public function aroundTest($subject, callable $process, $p1, $p2)
    {

        $p2 = 'Marry';
       // $result = $process('Yo1', $p2); // khong co cai nay thi khong chay vao function chinh vaf around se override function chinh
        return $p1 . ' Love ' . $p2;

    }

    public function afterGetName($subject, $result)
    {
        return $result . ' Hello';
    }
}