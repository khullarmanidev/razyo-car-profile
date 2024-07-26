<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerCarProfile extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('razoyo_customercarprofile', 'customercarprofile_id');
    }
}

