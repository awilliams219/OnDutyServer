<?php


namespace AppBundle;


class Rights {
    // OPERATIONS
    const SHOW =      0b0000000000000001;
    const LIST =      0b0000000000000010;
    const CREATE =    0b0000000000000100;
    const UPDATE =    0b0000000000001000;
    const DELETE =    0b0000000000010000;

    // SUBJECTS
    const APPARATUS = 0b0000000000100000;
    const USER      = 0b0000000001000000;
    const REPORT    = 0b0000000010000000;
    const ADMIN     = 0b0000000100000000;


    public static function hasAll($subject, array $rights): bool {
        $mask = self::getMask($rights);
        return ($subject == $mask);
    }

    public static function hasAny($subject, array $rights): bool {
        $mask = self::getMask($rights);
        return (bool) ($subject & $mask);
    }


    protected static function getMask(array $rights): integer {
        return array_reduce($rights, function ($runningMask, $right) {
            return ($runningMask | $right); // compile rights array down to a single bitmask
        }, 0);
    }
}

