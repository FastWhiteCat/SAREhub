<?php

namespace Fwc\SAREhub\Model\Event;

/**
 * Class LoginPage
 */
class LoginPage extends Event implements EventInterface
{
    /**
     * @var string
     */
    public $eventId = '_loginpage';

    /**
     * @return string
     */
    public function getCode()
    {
        $this->setData($this->eventId, $this->populateLoginPageData());

        return $this->getEventData();
    }

    /**
     * @return array
     */
    private function populateLoginPageData()
    {
        $data = [
            'pagetype' => 'Login page'
        ];

        $this->addRegionData($data);

        return $data;
    }
}
