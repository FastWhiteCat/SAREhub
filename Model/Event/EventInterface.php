<?php

namespace Fwc\SAREhub\Model\Event;

/**
 * Interface EventInterface
 */
interface EventInterface
{

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @return mixed
     */
    public function isAllowed();
}
