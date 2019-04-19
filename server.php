<?php

require __DIR__.'/vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$server = new \Twirp\Server();
$handler = new \Twirp\Example\Haberdasher\HaberdasherServer(new \Twirp\Demo\Haberdasher());
$server->registerServer(\Twirp\Example\Haberdasher\HaberdasherServer::PATH_PREFIX, $handler);

$response = $server->handle($request);

if (!headers_sent()) {
	// status
	header(sprintf('HTTP/%s %s %s', $response->getProtocolVersion(), $response->getStatusCode(), $response->getReasonPhrase()), true, $response->getStatusCode());
	// headers
	foreach ($response->getHeaders() as $header => $values) {
		foreach ($values as $value) {
			header($header.': '.$value, false, $response->getStatusCode());
		}
	}
}
echo $response->getBody();
