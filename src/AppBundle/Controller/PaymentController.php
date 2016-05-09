<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends ResourceController
{
    public function completeAction($request, $orderNumber)
    {
        $resource = $this->getResource($request);
        $object = $this->findOrThrowNotFound($resource, $orderNumber);

        $paypalManager = $this->get('appbundle_payment_manager');
        $paypalManager->complete($object);

        return $this->getSuccessResponse($resource, $object);

    }

    public function canceledAction($request, $orderNumber)
    {
        $resource = $this->getResource($request);
        $object = $this->findOrThrowNotFound($resource, $orderNumber);

        $paypalManager = $this->get('appbundle_payment_manager');
        $paypalManager->complete($object);

        return $this->getSuccessResponse($resource, $object);
    }
}