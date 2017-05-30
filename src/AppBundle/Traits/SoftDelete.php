<?php
namespace AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

trait SoftDelete {

    /**
     * @var int
     *
     * @ORM\Column(name="deleted", type="integer")
     */
    private $deleted;

    public function delete() {
        $this->deleted = self::STATUS_DELETED;
    }

    public function undelete() {
        $this->deleted = self::STATUS_ACTIVE;
    }


}