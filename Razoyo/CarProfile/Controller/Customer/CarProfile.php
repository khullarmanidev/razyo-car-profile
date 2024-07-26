<?php
namespace Razoyo\CarProfile\Controller\Customer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\Session as CustomerSession;

class CarProfile extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var ResultFactory
     */
    protected $resultFactory;
    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @param Context $context
     * @param ResultFactory $resultFactory
     * @param UrlInterface $url
     * @param CustomerSession $customerSession
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        UrlInterface $url,
        CustomerSession $customerSession,
        PageFactory $resultPageFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->url = $url;
        $this->customerSession = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        if($this->customerSession->getId()){
            return $resultPage;
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getBaseUrl());
        return $resultRedirect;


    }
}
