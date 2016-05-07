<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LicencesControllerTest extends WebTestCase
{
    public function testActivate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/activate');
    }

}
