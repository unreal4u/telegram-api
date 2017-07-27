<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

class GuzzleRequestHandler implements RequestHandlerInterface
{
	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 * @var ClientInterface
	 */
	protected $httpClient;

	/**
	 * GuzzleRequestHandler constructor.
	 *
	 * @param ClientInterface $client
	 * @param LoggerInterface $logger
	 */
	public function __construct(?ClientInterface $client = null, LoggerInterface $logger = null)
	{
		if ($logger === null)
		{
			$logger = new DummyLogger();
		}
		$this->logger = $logger;

		if ($client === null)
		{
			$client = new Client();
		}
		$this->httpClient = $client;
	}

	public function get(string $uri): ResponseInterface
	{
		return $this->httpClient->get($uri);
	}

	/**
	 * This is the method that actually makes the call, which can be easily overwritten so that our unit tests can work
	 *
	 * @param string $uri
	 * @param array $formData
	 *
	 * @return TelegramRawData
	 */
	public function request(string $uri, array $formData = []): TelegramRawData
	{
		$e = null;
		$this->logger->debug('About to perform HTTP call to Telegram\'s API');
		try {
			$response = $this->httpClient->post($uri, $formData);
			$this->logger->debug('Got response back from Telegram, applying json_decode');
		}
		catch (ClientException $e) {
			$response = $e->getResponse();
			// It can happen that we have a network problem, in such case, we can't do nothing about it, so rethrow
			if (empty($response)) {
				throw $e;
			}
		}
		finally {
			return new TelegramRawData((string) $response->getBody(), $e);
		}
	}

	/**
	 * @param string $uri
	 * @param array $formData
	 *
	 * @return PromiseInterface
	 */
	public function requestAsync(string $uri, array $formData = []): PromiseInterface
	{
		$this->logger->debug('About to perform async HTTP call to Telegram\'s API');
		$deferred = new Promise();

		$promise = $this->httpClient->postAsync($uri, $formData);
		$promise->then(function (ResponseInterface $response) use ($deferred) {
			$deferred->resolve(new TelegramRawData((string) $response->getBody()));
		},
			function (RequestException $exception) use ($deferred) {
				if (!empty($exception->getResponse()->getBody()))
					$deferred->resolve(new TelegramRawData((string) $exception->getResponse()->getBody(), $exception));
				else
					$deferred->reject($exception);
			});

		return $deferred;
	}
}