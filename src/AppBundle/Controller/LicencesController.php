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

        return parent::putAction($request, $licenceNumber);
    }


}
