<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model\ResourceModel\CustomerCarProfile;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'customercarprofile_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Razoyo\CarProfile\Model\CustomerCarProfile::class,
            \Razoyo\CarProfile\Model\ResourceModel\CustomerCarProfile::class
        );
    }
}

