<?php

namespace Learning\FirstUnit\Plugin;

class ExamplePlugin
{

    public function beforeSetTitle(\Learning\FirstUnit\Controller\Index\Example $example, $title)
    {
        $title = $title . ' you to ';
        echo __METHOD__ . '<br>';
        return $title;
    }

    public function afterGetTitle(\Learning\FirstUnit\Controller\Index\Example $example, $title)
    {
        echo __METHOD__ . '<br>';
        $title = $title . '<b>Magenest.com</b>';
        return $title;
    }


    public function aroundGetTitle(\Learning\FirstUnit\Controller\Index\Example $subject, callable $proceed)
    {

        echo __METHOD__ . " - Before proceed() </br>";
        $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";
        echo '<br>' . $result . '<br>';

        return $result . ' with ';
    }

    public function afterGetName(\Learning\FirstUnit\Controller\Index\Example $subject, $name)
    {
        return 'hello';
    }
}