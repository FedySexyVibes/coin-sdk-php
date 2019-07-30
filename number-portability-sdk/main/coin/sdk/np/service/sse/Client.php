<?php

/* Original license:
The MIT License (MIT)

Copyright (c) 2015 Oleksandr Bushkovskyi

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.*/


namespace coin\sdk\np\service\sse;

use GuzzleHttp;

class Client
{
    const RETRY_DEFAULT_MS = 3000;
    const END_OF_MESSAGE = "/\r\n\r\n|\n\n|\r\r/";
    const TIMED_OUT = "timed_out";

    /** @var  GuzzleHttp\Client */
    private $client;
    /** @var GuzzleHttp\Psr7\Response */
    private $response;

    /** @var string - requesting url * */
    private $url;
    /** @var  string - last received message id */
    private $lastId;
    /** @var  int - reconnection time in milliseconds */
    private $retry = self::RETRY_DEFAULT_MS;

    /**
     * @param string $url
     * @param array $headers
     */
    public function __construct($url, array $headers = [])
    {
        $this->url = $url;
        $this->client = new GuzzleHttp\Client([
            'headers' => array_merge($headers, [
                'Accept' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
            ]),
        ]);
    }

    /**
     * Connect to server.
     */
    private function connect()
    {
        $this->response = $this->client->request('GET', $this->url, [
            'stream' => true,
            'read_timeout' => 30, // Time out in seconds, time-out > keep-alive interval
        ]);
    }

    /**
     * Returns generator that yields new event when it's available on stream.
     *
     * @param callable $onDisconnect
     * @return Event[]
     */
    public function getEvents()
    {
        $this->connect();
        $buffer = '';
        $body = $this->response->getBody();
        while (true) {
            // if server closes connection - try to reconnect
            if ($body->eof()) {
                break;
            }

            $buffer .= $body->read(1);

            if ($body->getMetadata(self::TIMED_OUT)) {
                break;
            }

            if (preg_match(self::END_OF_MESSAGE, $buffer)) {
                $parts = preg_split(self::END_OF_MESSAGE, $buffer, 2);

                $rawMessage = $parts[0];
                $remaining = $parts[1];

                $buffer = $remaining;

                $event = Event::parse($rawMessage);

                // if message contains id set it to last received message id
                if ($event->getId()) {
                    $this->lastId = $event->getId();
                }

                // take into account server request for reconnection delay
                if ($event->getRetry()) {
                    $this->retry = $event->getRetry();
                }

                yield $event;
            }
        }
    }
}
