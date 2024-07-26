<?php

namespace Razoyo\CarProfile\Controller\Customer;

use Magento\Framework\App\RequestInterface;
use Razoyo\CarProfile\Api\CustomerCarProfileRepositoryInterface;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileInterfaceFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CustomerCarProfileRepositoryInterface
     */
    private $customerCarProfileRepository;

    /**
     * @var CustomerCarProfileInterfaceFactory
     */
    private $customerCarProfileInterfaceFactory;

    /**
     * @var CustomerSession
     */
    private $customerSession;
    protected $messageManager;

    public function __construct(
        Context $context,
        RequestInterface $request,
        ManagerInterface $messageManager,
        CustomerCarProfileRepositoryInterface $customerCarProfileRepository,
        CustomerCarProfileInterfaceFactory $customerCarProfileInterfaceFactory,
        CustomerSession $customerSession
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->customerCarProfileRepository = $customerCarProfileRepository;
        $this->customerCarProfileInterfaceFactory = $customerCarProfileInterfaceFactory;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $carId = $this->request->getPost('car_id');
        $customerId = $this->customerSession->getId();
        if(!empty($carId)) {
            $customerCarProfileObject = $this->customerCarProfileInterfaceFactory->create();
            $customerCarProfile = $customerCarProfileObject->load($customerId, 'customer_id');
            if($customerCarProfile->getCustomercarprofileId()) {
                $customerCarProfile->setCarId($carId);
                $this->customerCarProfileRepository->save($customerCarProfile);
                $this->messageManager->addSuccessMessage(__('Car details has been updated successfully.'));
                return $resultRedirect->setPath('razoyocarprofile/customer/index');
            }
            $customerCarProfileObject->setCarId($carId)->setCustomerId($customerId);
            $this->customerCarProfileRepository->save($customerCarProfileObject);
            $this->messageManager->addSuccessMessage(__('Car details has been saved successfully.'));
            return $resultRedirect->setPath('razoyocarprofile/customer/index');
        }
    }
}
