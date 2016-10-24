<?php

namespace Chrl\AppBundle\Type;

interface TypeInterface
{
    /**
     * @param \stdClass $obj
     */
    public function loadResult(\stdClass $obj);
}
