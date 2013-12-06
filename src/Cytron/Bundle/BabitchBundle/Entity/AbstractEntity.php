<?php
namespace Cytron\Bundle\BabitchBundle\Entity;

/**
 * Abstract entity
 */
abstract class AbstractEntity
{
    /**
     * Normalize a string
     *
     * @param string $string
     *
     * @return string|null
     */
    final public function normalize($string)
    {
        if ($string) {
            return $string;
        }

        return null;
    }

    /**
     * Normalize a date
     *
     * @param \DateTime|null $date Date object
     *
     * @return \DateTime|null
     */
    final public function normalizeDate(\DateTime $date = null)
    {
        if (!is_null($date) && ($date->format("Y") > 0)) {
            return $date;
        }

        return null;
    }
}
