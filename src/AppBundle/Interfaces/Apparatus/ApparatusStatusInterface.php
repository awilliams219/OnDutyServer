<?php
namespace AppBundle\Interfaces\Apparatus;

use AppBundle\Entity\ApparatusStatus;
use DateTime;

interface ApparatusStatusInterface {
    public function getPersonnelCount(): integer;
    public function setPersonnelCount(integer $count): ApparatusStatus;

    public function getMedicalLevel(): string;
    public function setMedicalLevel(string $level): ApparatusStatus;

    public function getOffDutyTime(): DateTime;
    public function setOffDutyTime(DateTime $offDuty): ApparatusStatus;

    public function getPost(): string;
    public function setPost(string $post): ApparatusStatus;

    public function getDutyStatus(): integer;
    public function setDutyStatus(integer $dutyStatus) : ApparatusStatus;

    public function getOosReason(): string;
    public function setOosReason(string $reason) : ApparatusStatus;
}
