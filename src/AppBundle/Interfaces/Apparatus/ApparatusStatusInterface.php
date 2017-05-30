<?php
namespace AppBundle\Interfaces\Apparatus;

use AppBundle\Entity\ApparatusStatus;
use DateTime;

interface ApparatusStatusInterface {
    public function getPersonnelCount(): int;
    public function setPersonnelCount(int $count): ApparatusStatus;

    public function getMedicalLevel(): string;
    public function setMedicalLevel(string $level): ApparatusStatus;

    public function getOffDutyTime(): DateTime;
    public function setOffDutyTime(DateTime $offDuty): ApparatusStatus;

    public function getPost(): string;
    public function setPost(string $post): ApparatusStatus;

    public function getDutyStatus(): int;
    public function setDutyStatus(int $dutyStatus) : ApparatusStatus;

    public function getOosReason(): ?string;
    public function setOosReason(string $reason) : ApparatusStatus;
}
