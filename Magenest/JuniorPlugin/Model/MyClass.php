<?php
namespace Magenest\JuniorPlugin\Model;

use Magenest\JuniorPlugin\Api\MyInterface;

class MyClass implements MyInterface{

    public function foo()
    {
        echo 'foo from my class ';
    }

    public function hi()
    {
        echo '<br>Jenick say hi everyone !';
    }
}