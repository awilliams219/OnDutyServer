<?php
namespace AppBundle\Entity;

use AppBundle\Entity\Security\SecuredEntity;
use AppBundle\Interfaces\Apparatus\ApparatusInterface;
use AppBundle\Interfaces\SoftDeletable;
use AppBundle\Traits\SoftDelete as SoftDeleteTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Apparatus
 *
 * @ORM\Table(name="apparatus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApparatusRepository")
 */
class Apparatus extends SecuredEntity implements ApparatusInterface, SoftDeletable
{
    use SoftDeleteTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=64, unique=true)
     */
    private $vin;

    /**
     * @var int
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, unique=false)
     */
    private $type;

    /** @var ApparatusStatus
     *
     * @ORM\OneToMany(targetEntity="ApparatusStatus", mappedBy="apparatus", cascade={"persist"})
     */
    private $status;


    public function __construct() {
        $this->setSecurityGroup('ApparatusManager');
    }

    /**
     * @return mixed
     */
    public function getStatus(): ApparatusStatus {
        return $this->status->last();
    }

    /**
     * @param mixed $status
     */
    public function setStatus(ApparatusStatus $status) {
        $this->status = $status;
    }

    public function addStatus(ApparatusStatus $status): Apparatus {
        $this->status[] = $status;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return integer
     */
    public function getSeats(): int {
        return $this->seats;
    }

    /**
     * @param integer $seats
     * @return Apparatus
     */
    public function setSeats(int $seats) {
        $this->seats = $seats;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin(): string {
        return $this->vin;
    }

    /**
     * @param string $vin
     * @return string
     */
    public function setVin(string $vin) {
        $this->vin = $vin;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): integer
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Apparatus
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array {
        return [
            "name" => $this->getName(),
            "vin" => $this->getVin(),
            "seats" => $this->getSeats(),
            "type" => $this->getType(),
            "status" => $this->getStatus()->condensed()
        ];
    }

    public function toFullArray(): array {
        $apparatus = $this->toArray();
        $apparatus["status"] = $this->getStatus()->toArray();
        return $apparatus;
    }
}

