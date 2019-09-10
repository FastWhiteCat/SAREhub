<?php

namespace Fwc\SAREhub\Logger;

use Magento\Framework\Logger\Handler\Base as MagentoBase;

/**
 * Class Handler
 */
class Handler extends MagentoBase
{
    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/sarehub.log';

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }
}
