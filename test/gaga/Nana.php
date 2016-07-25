<?php
namespace test\gaga;

class Nana {
    public $haha;

    public function __construct($haha)
    {
        $this->haha = $haha;
    }
    public function printHaha()
    {
        echo $this->haha;
    }
}