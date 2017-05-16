<?php
/**
 * Created by PhpStorm.
 * User: adamwilliams1
 * Date: 5/15/17
 * Time: 5:08 PM
 */

namespace AppBundle\Interfaces\Security;


use AppBundle\Entity\Security\SecuredEntity;

interface SecuredEntityInterface {

    public function getGroupName(): string;
    public function setGroupName(string $groupName): SecuredEntity;

}