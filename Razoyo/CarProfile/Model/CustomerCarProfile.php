<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Model\AbstractModel;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface;

class CustomerCarProfile extends AbstractModel implements CustomerCarProfileInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Razoyo\CarProfile\Model\ResourceModel\CustomerCarProfile::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomercarprofileId()
    {
        return $this->getData(self::CUSTOMERCARPROFILE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomercarprofileId($customercarprofileId)
    {
        return $this->setData(self::CUSTOMERCARPROFILE_ID, $customercarprofileId);
    }

    /**
     * @inheritDoc
     */
    public function getCarId()
    {
        return $this->getData(self::CAR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCarId($carId)
    {
        return $this->setData(self::CAR_ID, $carId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }
}

