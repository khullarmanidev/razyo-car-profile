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

class Delete extends Action implements HttpPostActionInterface
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
        $carId = $this->request->getPost('id');
        $customerId = $this->customerSession->getId();
        if(!empty($carId)) {
            $customerCarProfileObject = $this->customerCarProfileInterfaceFactory->create();
            $customerCarProfile = $customerCarProfileObject->load($customerId, 'customer_id');
            if($customerCarProfile->getCustomercarprofileId()) {
                $customerCarProfile->setCarId($carId);
                $this->customerCarProfileRepository->delete($customerCarProfile);
                $this->messageManager->addSuccessMessage(__('Car details has been deleted successfully.'));
                return $resultRedirect->setPath('razoyocarprofile/customer/carprofile/');
            }
            $this->messageManager->addSuccessMessage(__('Car details not found.'));
            return $resultRedirect->setPath('razoyocarprofile/customer/carprofile/');
        }
    }
}
