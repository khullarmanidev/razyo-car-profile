<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\ViewModel;

use Razoyo\CarProfile\Service\CarApiService;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Razoyo\CarProfile\Api\Data\CustomerCarProfileInterfaceFactory;
use Magento\Customer\Model\Session as CustomerSession;

class CarInfo implements ArgumentInterface
{
    /**
     * @var CarApiService
     */
    protected $carApiService;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UrlInterface
     */
    private $urlInterface;
    /**
     * @var CustomerCarProfileInterfaceFactory
     */
    private $customerCarProfileInterfaceFactory;
    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * CarInfo constructor.
     *
     */
    public function __construct(
        CarApiService $carApiService,
        CustomerCarProfileInterfaceFactory $customerCarProfileInterfaceFactory,
        CustomerSession $customerSession,
        SerializerInterface $serializer,
        UrlInterface $urlInterface
    ) {
        $this->carApiService = $carApiService;
        $this->customerCarProfileInterfaceFactory = $customerCarProfileInterfaceFactory;
        $this->customerSession = $customerSession;
        $this->serializer = $serializer;
        $this->urlInterface = $urlInterface;
    }

    /**
     * @return array
     */
    public function getCarsList()
    {
        $response = $this->carApiService->execute();
        if ($response->getStatusCode() == 200) {
            $responseBody = $response->getBody();
            return $this->serializer->unserialize($responseBody->getContents());
        }

        return [];
    }

    /**
     * @return array
     */
    public function getCarsListById($id)
    {
        $response = $this->carApiService->getCarListById($id);
        if ($response->getStatusCode() == 200) {
            $responseBody = $response->getBody();
            return $this->serializer->unserialize($responseBody->getContents());
        }

        return [];
    }

     public function getCarByCustomerId()
    {
        $customerId = $this->customerSession->getId();
        $customerCarProfileObject = $this->customerCarProfileInterfaceFactory->create();
        $customerCarProfile = $customerCarProfileObject->load($customerId, 'customer_id');
        return $customerCarProfile->getData();
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->urlInterface->getUrl('razoyocarprofile/customer/save', ['_secure' => true]);
    }

}
