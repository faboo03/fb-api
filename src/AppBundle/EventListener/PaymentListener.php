<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Order;
use Doctrine\Common\Persistence\ManagerRegistry;
use Dunglas\ApiBundle\Event\DataEvent;
use JMS\Payment\CoreBundle\Entity\ExtendedData;
use JMS\Payment\CoreBundle\Entity\PaymentInstruction;
use Symfony\Component\Routing\RouterInterface;

class PaymentListener
{

    /**
     * @var RouterInterface
     */
    private $router = null;

    /**
     * PaymentListener constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param DataEvent $event
     */
    public function onPostCreate(DataEvent $event)
    {
        $data = $event->getData();

        if ($data instanceof Order) {
            $resource = $event->getResource(); // Get the related instance of Dunglas\ApiBundle\Api\ResourceInterface

            $extendedData = new ExtendedData();
            $extendedData->set('return_url',$this->router->generate('payment_complete', array(
                'orderNumber' => $data->getOrderNumber(),
            ), true));
            $extendedData->set('cancel_url',$this->router->generate('payment_cancel', array(
                'orderNumber' => $data->getOrderNumber(),
            ), true));

            $paymentInstruction =  new PaymentInstruction($data->getAmount(), 'EUR', 'paypal_express_checkout', $extendedData);
            
            $data->setPaymentInstruction($paymentInstruction);
        }
    }
}