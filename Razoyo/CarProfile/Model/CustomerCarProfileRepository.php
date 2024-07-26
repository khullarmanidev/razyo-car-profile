<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Razoyo\CarProfile\Api\CustomerCarProfileRepositoryInterface;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileInterface;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileInterfaceFactory;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileSearchResultsInterfaceFactory;
use Razoyo\CarProfile\Model\ResourceModel\CustomerCarProfile as ResourceCustomerCarProfile;
use Razoyo\CarProfile\Model\ResourceModel\CustomerCarProfile\CollectionFactory as CustomerCarProfileCollectionFactory;

class CustomerCarProfileRepository implements CustomerCarProfileRepositoryInterface
{

    /**
     * @var ResourceCustomerCarProfile
     */
    protected $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CustomerCarProfile
     */
    protected $searchResultsFactory;

    /**
     * @var CustomerCarProfileCollectionFactory
     */
    protected $customerCarProfileCollectionFactory;

    /**
     * @var CustomerCarProfileInterfaceFactory
     */
    protected $customerCarProfileFactory;


    /**
     * @param ResourceCustomerCarProfile $resource
     * @param CustomerCarProfileInterfaceFactory $customerCarProfileFactory
     * @param CustomerCarProfileCollectionFactory $customerCarProfileCollectionFactory
     * @param CustomerCarProfileSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCustomerCarProfile $resource,
        CustomerCarProfileInterfaceFactory $customerCarProfileFactory,
        CustomerCarProfileCollectionFactory $customerCarProfileCollectionFactory,
        CustomerCarProfileSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customerCarProfileFactory = $customerCarProfileFactory;
        $this->customerCarProfileCollectionFactory = $customerCarProfileCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        CustomerCarProfileInterface $customerCarProfile
    ) {
        try {
            $this->resource->save($customerCarProfile);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerCarProfile: %1',
                $exception->getMessage()
            ));
        }
        return $customerCarProfile;
    }

    /**
     * @inheritDoc
     */
    public function get($customerCarProfileId)
    {
        $customerCarProfile = $this->customerCarProfileFactory->create();
        $this->resource->load($customerCarProfile, $customerCarProfileId);
        if (!$customerCarProfile->getId()) {
            throw new NoSuchEntityException(__('CustomerCarProfile with id "%1" does not exist.', $customerCarProfileId));
        }
        return $customerCarProfile;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerCarProfileCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(
        CustomerCarProfileInterface $customerCarProfile
    ) {
        try {
            $customerCarProfileModel = $this->customerCarProfileFactory->create();
            $this->resource->load($customerCarProfileModel, $customerCarProfile->getCustomercarprofileId());
            $this->resource->delete($customerCarProfileModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomerCarProfile: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($customerCarProfileId)
    {
        return $this->delete($this->get($customerCarProfileId));
    }
}

