<?php
namespace AppBundle\Entity;
use AppBundle\Entity\Security\SecuredEntity;
use AppBundle\Interfaces\Apparatus\ApparatusStatusInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ApparatusStatus
 * @package AppBundle\Entity

 * @ORM\Table(name="apparatusstatus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApparatusStatusRepository")
 */
class ApparatusStatus extends SecuredEntity implements ApparatusStatusInterface {

    const STATUS_OOS = -1;
    const STATUS_OFFDUTY = 0;
    const STATUS_ONDUTY = 1;

    public function __construct() {
        $this->setSecurityGroup('ApparatusStatusManager');
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="personnelCount", type="integer")
     */
    private $personnelCount;

    /**
     * @var string
     *
     * @ORM\Column(name="medicalLevel", type="string", length=10, unique=false)
     */
    private $medicalLevel;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="offDutyTime", type="datetime")
     */
    private $offDutyTime;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="onDutyTime", type="datetime")
     */
    private $onDutyTime;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=64, unique=false)
     */
    private $post;

    /**
     * @var int
     *
     * @ORM\Column(name="dutyStatus", type="integer")
     */
    private $dutyStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="oosReason", type="string", length=64, unique=false, nullable=true)
     */
    private $oosReason;

    /**
     * @var Apparatus
     *
     * @ORM\ManyToOne(targetEntity="Apparatus", inversedBy="apparatusStatus")
     * @ORM\JoinColumn(name="apparatus_id", referencedColumnName="id", unique=false)
     */
    private $apparatus;



    public function getApparatus(): Apparatus {
        return $this->apparatus;
    }

    public function setApparatus($apparatus) : ApparatusStatus {
        $this->apparatus = $apparatus;
        return $this;
    }



    public function getPersonnelCount(): int {
        return $this->personnelCount;
    }

    public function setPersonnelCount(int $count): ApparatusStatus {
        $this->personnelCount = $count;
        return $this;
    }



    public function getMedicalLevel(): string {
        return $this->medicalLevel;
    }

    public function setMedicalLevel(string $level): ApparatusStatus {
        $this->medicalLevel = $level;
        return $this;
    }



    public function getOffDutyTime(): DateTime {
        return $this->offDutyTime;
    }

    public function setOffDutyTime(DateTime $offDuty): ApparatusStatus {
        $this->offDutyTime = $offDuty;
        return $this;
    }



    public function getPost(): string {
        return $this->post;
    }

    public function setPost(string $post): ApparatusStatus {
        $this->post = $post;
        return $this;
    }



    public function getDutyStatus(): int {
        return $this->dutyStatus;
    }

    public function setDutyStatus(int $dutyStatus): ApparatusStatus {
        $this->dutyStatus = $dutyStatus;
        return $this;
    }



    public function getOosReason() : ?string {
        return $this->oosReason;
    }

    public function setOosReason(string $reason): ApparatusStatus {
        $this->oosReason = $reason;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getOnDutyTime(): DateTime {
        return $this->onDutyTime;
    }

    /**
     * @param DateTime $onDutyTime
     * @return ApparatusStatus
     */
    public function setOnDutyTime(DateTime $onDutyTime): ApparatusStatus {
        $this->onDutyTime = $onDutyTime;
        return $this;
    }

    public function condensed() {
        return ($this->getDutyStatus() != self::STATUS_ONDUTY)
            ? $this->getReadableDutyStatus(true)
            : $this->getReadableDutyStatus() . " C" . $this->getPersonnelCount() . '0 ' . $this->getMedicalLevel() . ' until ' . $this->getOffDutyTime()->format('Hi');
    }

    public function toArray() {
        return [
            "personnelCount" => $this->getPersonnelCount(),
            "medicalLevel" => $this->getMedicalLevel(),
            "onDutyTime" => $this->getOnDutyTime()->format(DATE_ISO8601),
            "offDutyTime" => $this->getOffDutyTime()->format(DATE_ISO8601),
            "oosReason" => $this->getOosReason(),
            "dutyStatus" => $this->getReadableDutyStatus(),
            "post" => $this->getPost(),
            "readable" => $this->condensed()
        ];
    }

    protected function getReadableDutyStatus(bool $withReason = false) {
        $suffix = null;
        switch ($this->getDutyStatus()) {
            case self::STATUS_OFFDUTY:
                return "Off Duty";
            case self::STATUS_ONDUTY:
                return "On Duty";
            case self::STATUS_OOS:
                if ($withReason && $this->getOosReason() !== "") {
                  $suffix = " - " . $this->oosReason;
                }
                return "Out of Service" . $suffix;
            default:
                return "Unknown";
        }
    }
}

