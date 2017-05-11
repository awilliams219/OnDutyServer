<?php
namespace AppBundle\Interfaces\Apparatus;

interface ApparatusInterface {
    public function getName(): string;
    public function setName(string $name);
    public function getSeats(): integer;
    public function setSeats(integer $seats);
    public function getVin(): string;
    public function setVin(string $vin);
}