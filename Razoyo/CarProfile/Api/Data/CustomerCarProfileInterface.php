<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

interface CustomerCarProfileInterface
{

    const CAR_ID = 'car_id';
    const CUSTOMER_ID = 'customer_id';
    const CUSTOMERCARPROFILE_ID = 'customercarprofile_id';

    /**
     * Get customercarprofile_id
     * @return string|null
     */
    public function getCustomercarprofileId();

    /**
     * Set customercarprofile_id
     * @param string $customercarprofileId
     * @return \Razoyo\CarProfile\CustomerCarProfile\Api\Data\CustomerCarProfileInterface
     */
    public function setCustomercarprofileId($customercarprofileId);

    /**
     * Get car_id
     * @return string|null
     */
    public function getCarId();

    /**
     * Set car_id
     * @param string $carId
     * @return \Razoyo\CarProfile\CustomerCarProfile\Api\Data\CustomerCarProfileInterface
     */
    public function setCarId($carId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Razoyo\CarProfile\CustomerCarProfile\Api\Data\CustomerCarProfileInterface
     */
    public function setCustomerId($customerId);
}

