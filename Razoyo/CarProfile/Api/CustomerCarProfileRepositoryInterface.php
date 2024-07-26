<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerCarProfileRepositoryInterface
{

    /**
     * Save CustomerCarProfile
     * @param \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface $customerCarProfile
     * @return \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface $customerCarProfile
    );

    /**
     * Retrieve CustomerCarProfile
     * @param string $customercarprofileId
     * @return \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customercarprofileId);

    /**
     * Retrieve CustomerCarProfile matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Razoyo\CarProfile\Api\Data\CustomerCarProfileSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomerCarProfile
     * @param \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface $customerCarProfile
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface $customerCarProfile
    );

    /**
     * Delete CustomerCarProfile by ID
     * @param string $customercarprofileId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customercarprofileId);
}

