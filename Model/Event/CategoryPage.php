<?php

namespace Fwc\SAREhub\Model\Event;

/**
 * Class CategoryPage
 * Used in creating options for Yes|No config value selection
 */
class CategoryPage extends Event implements EventInterface
{
    /**
     * @var string
     */
    public $eventId = '_category';

    /**
     * @return string
     */
    public function getCode()
    {
        $this->setData($this->eventId, $this->populateCategoryPageData());

        return $this->getEventData();
    }

    /**
     * @return array
     */
    private function populateCategoryPageData()
    {
        $data = [
            'id' => $this->registry->registry('current_category')->getName()
        ];

        $this->addRegionData($data);

        return $data;
    }
}
