<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ApiControllerTest extends WebTestCase
{
    public function testNasdaqResponse(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/nasdaq');

        $this->assertResponseIsSuccessful();
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
