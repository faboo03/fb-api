<?php

namespace AppBundle\Controller;

use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class LicencesController extends ResourceController
{
    public function activateAction(Request $request, $licenceNumber)
    {
        $resource = $this->getResource($request);
        $object = $this->findOrThrowNotFound($resource, $licenceNumber);
//        $em = $this->get('doctrine.orm.entity_manager');
//        $array = json_decode($request->getContent(), true);
//        $object->setActivationHash($array['activationHash']);
//        $em->persist($object);
//        $em->flush();

        return parent::putAction($request, $licenceNumber);
    }


}
