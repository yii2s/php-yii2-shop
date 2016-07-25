<?php
namespace test\gaga\haha;

class Haha {

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