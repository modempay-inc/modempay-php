<?php

namespace ModemPay\Http;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use ModemPay\Exceptions\ModemPayException;

class Client
{
  protected string $apiKey;
  protected string $baseUrl;
  protected HttpClientInterface $http;

  public function __construct(string $apiKey, string $baseUrl = 'https://api.modempay.com')
  {
    $this->apiKey = $apiKey;
    $this->baseUrl = $baseUrl;

    $this->http = HttpClient::create([
      'base_uri' => $baseUrl,
      'headers' => [
        'Authorization' => 'Bearer ' . $this->apiKey,
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ],
      'timeout' => 30,
    ]);
  }

  public function request(string $method, string $uri, mixed $data = [], array $headers = []): mixed
  {
    try {
      $options = [];

      if ($data) {
        $options['json'] = $data;
      }

      if ($headers) {
        $options['headers'] = $headers;
      }

      $response = $this->http->request($method, $uri, $options);

      return $response->toArray();
    } catch (TransportExceptionInterface $e) {
      throw new ModemPayException(
        $e->getMessage(),
        $e->getCode()
      );
    } catch (\Exception $e) {
      throw new ModemPayException(
        $e->getMessage(),
        $e->getCode()
      );
    }
  }
}