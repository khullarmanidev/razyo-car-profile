<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

interface CustomerCarProfileSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CustomerCarProfile list.
     * @return \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

