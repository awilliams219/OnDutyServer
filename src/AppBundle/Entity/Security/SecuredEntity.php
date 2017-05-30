<?php
namespace AppBundle\Entity\Security;

use AppBundle\Interfaces\Security\SecuredEntityInterface;
use Doctrine\ORM\Mapping as ORM;


class SecuredEntity implements SecuredEntityInterface {

    protected $groupName;

    /**
     * @return mixed
     */
    public function getSecurityGroup(): string {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     * @return SecuredEntity
     */
    public function setSecurityGroup(string $groupName): SecuredEntity {
        $this->groupName = $groupName;
        return $this;
    }



}