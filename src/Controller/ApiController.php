<?php

namespace App\Controller;

use App\Entity\Calculation;
use App\Service\MailerService;
use App\Service\RequestHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * @Route("/nasdaq", name="nasdaq", methods={"GET"})
     */
    public function getNasdaq(): Response
    {
        $url = 'https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json';
        $response = $this->client->request('GET', $url);

        return $this->json($response->toArray())->setSharedMaxAge(120);
    }

    /**
     * @Route("/rapid", name="rapid", methods={"POST"})
     */
    public function postRapidData(Request $request, RequestHandler $handler): Response
    {
        $calculation = $handler->handle($request, Calculation::class);

        return $this->rapidData($calculation->getCompanySymbol()->getSymbol());
    }

    /**
     * @Route("/mail", name="mail", methods={"POST"})
     */
    public function sendMail(Request $request, RequestHandler $handler, MailerService $mailerService): Response
    {
        $calculation = $handler->handle($request, Calculation::class);

        $mailerService->send($calculation);

        return $this->json([]);
    }

    private function rapidData(string $symbol, string $region = 'US'): Response
    {
        $response = $this->client->request('GET', 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data', [
            'headers' => [
                'X-RapidAPI-Key'  => $this->getParameter('app.rapid_api'),
                'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
            ],
            'query'   => [
                'symbol' => $symbol,
                // 'region' => $region,
            ]
        ]);

        return $this->json($response->toArray());
    }
}
