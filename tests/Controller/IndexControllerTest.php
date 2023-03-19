<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class IndexControllerTest extends WebTestCase
{
    public function testGetResponse(): void
    {
        $client = self::createClient();
        $client->request('GET', '/text');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
