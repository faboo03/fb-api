<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Order;
use Doctrine\ORM\EntityManager;
use JMS\Payment\CoreBundle\PluginController\EntityPluginController;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class PaypalPaymentManager
{

    /**
     * @var EntityManager
     */
    private $em = null;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var EntityPluginController
     */
    private $ppc;

    /**
     * PaypalPaymentManager constructor.
     * @param EntityManager $em
     * @param Router $router
     * @param EntityPluginController $ppc
     */
    public function __construct(EntityManager $em, Router $router, EntityPluginController $ppc)
    {
        $this->em = $em;
        $this->router = $router;
        $this->ppc = $ppc;
    }

    public function completeOrder(Order $order) {
        // get instruction
        $instruction = $order->getPaymentInstruction();
        if (null === $pendingTransaction = $instruction->getPendingTransaction()) {
            $payment = $this->ppc->createPayment($instruction->getId(), $instruction->getAmount() - $instruction->getDepositedAmount());
        } else {
            $payment = $pendingTransaction->getPayment();
        }

        $result = $this->ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());
        if (Result::STATUS_PENDING === $result->getStatus()) {
            $ex = $result->getPluginException();

            if ($ex instanceof ActionRequiredException) {
                $action = $ex->getAction();

                if ($action instanceof VisitUrl) {
                    return new RedirectResponse($action->getUrl());
                }

                throw $ex;
            }
        } else if (Result::STATUS_SUCCESS !== $result->getStatus()) {
            throw new \RuntimeException('Transaction was not successful: '.$result->getReasonCode());
        }
    }
}