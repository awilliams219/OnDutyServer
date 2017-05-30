<?php
namespace AppBundle\Filters;

use AppBundle\Interfaces\SoftDeletable;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeleteFilter extends SQLFilter {

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias) {
        if ($targetEntity->reflClass->implementsInterface('AppBundle\Interfaces\SoftDeletable')) {
            return $targetTableAlias.'.deleted != ' . SoftDeletable::STATUS_DELETED;
        }
        return "";
    }
}
