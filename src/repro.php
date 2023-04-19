<?php

use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use function Amp\async;

require __DIR__ . '/../vendor/autoload.php';

$request = static function () {
    $client = (new HttpClientBuilder())->build();

    $request = new Request('https://httpbin.org/get');

    $response = $client->request($request);
    $response->getBody()->buffer();
};

for ($i = 0; $i < 3; $i++) {
    async($request(...))->await();

    gc_collect_cycles();
    gc_mem_caches();

    echo memory_get_usage() . PHP_EOL;
}

