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

    public const STATUS_OOS = -1;
    public const STATUS_OFFDUTY = 0;
    public const STATUS_ONDUTY = 1;


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
     * @ORM\Column(name="oosReason", type="string", length=64, unique=false)
     */
    private $oosReason;

    /**
     * @var Apparatus
     *
     * @OneToOne(targetEntity="Apparatus", inversedBy="apparatusStatus")
     * @JoinColumn(name="apparatus_id", referencedColumnName="id")
     */
    private $apparatus;



    public function getApparatus(): Apparatus {
        return $this->apparatus;
    }

    public function setApparatus($apparatus) : ApparatusStatus {
        $this->apparatus = $apparatus;
    }



    public function getPersonnelCount(): integer {
        return $this->personnelCount;
    }

    public function setPersonnelCount(integer $count): ApparatusStatus {
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



    public function getDutyStatus(): integer {
        return $this->dutyStatus;
    }

    public function setDutyStatus(integer $dutyStatus): ApparatusStatus {
        $this->dutyStatus = $dutyStatus;
        return $this;
    }



    public function getOosReason(): string {
        return $this->oosReason;
    }

    public function setOosReason(string $reason): ApparatusStatus {
        $this->oosReason = $reason;
        return $this;
    }
}