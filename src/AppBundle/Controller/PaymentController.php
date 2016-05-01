<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function completeAction(Order $order)
    {
        die('Complete');
    }

    public function cancelAction(Order $order)
    {
        die('Cancel');
    }
}