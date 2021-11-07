<?php

namespace App\Command;

use App\Entity\History;
use App\Entity\OpenApiUrl;
use App\Repository\HistoryRepository;
use App\Repository\OpenApiUrlRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TreeWalker;

class ParseOpenapiCommand extends Command
{
    protected static $defaultName = 'app:parse-openapi';

    private OpenApiUrlRepository $openApiRepository;

    private HistoryRepository $historyRepository;

    private HttpClientInterface $client;

    private LoggerInterface $logger;

    private EntityManagerInterface $em;

    /**
     * @required
     *
     * @param OpenApiUrlRepository $openApiRepository
     */
    public function setOpenApiRepository(OpenApiUrlRepository $openApiRepository): void
    {
        $this->openApiRepository = $openApiRepository;
    }

    /**
     * @required
     *
     * @param HistoryRepository $historyRepository
     */
    public function setHistoryRepository(HistoryRepository $historyRepository): void
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * @required
     *
     * @param HttpClientInterface $client
     */
    public function setClient(HttpClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @required
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @required
     *
     * @param EntityManagerInterface $em
     */
    public function setEm(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $openApiList = $this->openApiRepository->findAll();

        foreach ($openApiList as $openapi) {
            $response = $this->client->request('GET', $openapi->getUrl());

            if (Response::HTTP_OK !== $response->getStatusCode()) {
                $this->logger->error(
                    sprintf('Url: %s. Status code: %s.', $openapi->getUrl(), $response->getStatusCode())
                );
            }

            try {
                $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
            } catch (Exception $exception) {
                $this->logger->error(
                    sprintf('Url: %s. Exception: %s', $response->getStatusCode(), $exception->getMessage())
                );

                continue;
            }

            $this->createIfNeed($openapi, $data);
        }

        return Command::SUCCESS;
    }

    /**
     * @param OpenApiUrl $openApi
     * @param array      $data
     *
     * @return void
     */
    private function createIfNeed(OpenApiUrl $openApi, array $data): void
    {
        $lastCreated = $this->historyRepository->findOneBy([
            'openApi' => $openApi,
        ], ['createdAt' => 'DESC']);

        if (null === $lastCreated) {
            $this->create($openApi, $data);

            return;
        }

        $walker = new TreeWalker([
            'returntype' => 'array',
        ]);

        // todo: find more pretty solution
        $diff = $walker->getdiff($lastCreated->getData(), $data);

        if (!empty($diff['new']) || !empty($diff['removed']) || !empty($diff['edited'])) {
            $this->create($openApi, $data);
        }
    }

    /**
     * @param OpenApiUrl $openApi
     * @param array      $data
     */
    private function create(OpenApiUrl $openApi, array $data): void
    {
        $history = new History();

        $history->setOpenApi($openApi)
                ->setData($data)
                ->setCreatedAt(new DateTimeImmutable())
        ;

        $this->em->persist($history);
        $this->em->flush();
    }
}
