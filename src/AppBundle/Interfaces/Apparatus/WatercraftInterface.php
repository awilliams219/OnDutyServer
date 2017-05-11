<?php

namespace AppBundle\Interfaces\Apparatus;


interface WatercraftInterface {
    public function getHin(): string;
    public function setHin(string $hin);
}