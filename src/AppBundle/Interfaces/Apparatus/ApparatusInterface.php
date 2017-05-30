<?php
namespace AppBundle\Interfaces\Apparatus;

interface ApparatusInterface {
    public function getName(): string;
    public function setName(string $name);
    public function getSeats(): int;
    public function setSeats(int $seats);
    public function getVin(): string;
    public function setVin(string $vin);
}