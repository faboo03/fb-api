<?php

namespace AppBundle\Controller;

use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function completeAction(Order $order)
    {
        return $this->render('AppBundle:Payment:complete.html.twig', array(
                // ...
            ));
    }
}