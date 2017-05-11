<?php


namespace AppBundle\Entity\Apparatus;


use AppBundle\Entity\Apparatus;
use AppBundle\Interfaces\Apparatus\WatercraftInterface;

class Watercraft extends Apparatus implements WatercraftInterface {
    public function getHin(): string {
        return $this->getVin();
    }

    public function setHin(string $hin) {
        return $this->setVin($hin);
    }
}