<?php
namespace AppBundle\Entity\Security;

use AppBundle\Interfaces\Security\SecuredEntityInterface;

class SecuredEntity implements SecuredEntityInterface {

    /**
     * @var string
     *
     * @ORM\Column(name="securityGroup", type="string", length=64, unique=true)
     */
    protected $groupName;

    /**
     * @return mixed
     */
    public function getGroupName(): string {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     * @return SecuredEntity
     */
    public function setGroupName(string $groupName): SecuredEntity {
        $this->groupName = $groupName;
        return $this;
    }



}