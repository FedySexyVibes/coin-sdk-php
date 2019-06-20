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

use InvalidArgumentException;

class Event {
    const END_OF_LINE = "/\r\n|\n|\r/";
    /** @var string */
    private $data;
    /** @var string */
    private $eventType;
    /** @var string */
    private $id;
    /** @var int */
    private $retry;

    public $exception;

    /**
     * @param string $data
     * @param string $eventType
     * @param null   $id
     * @param null   $retry
     */
    public function __construct($data = '', $eventType = 'message', $id = null, $retry = null)
    {
        $this->data = $data;
        $this->eventType = $eventType;
        $this->id = $id;
        $this->retry = $retry;
    }
    /**
     * @param $raw
     *
     * @return Event
     */
    public static function parse($raw)
    {
        $event = new static();
        $lines = preg_split(self::END_OF_LINE, $raw);
        foreach ($lines as $line) {
            $matched = preg_match('/(?P<name>[^:]*):?( ?(?P<value>.*))?/', $line, $matches);
            if (!$matched) {
                throw new InvalidArgumentException(sprintf('Invalid line %s', $line));
            }
            $name = $matches['name'];
            $value = $matches['value'];
            if ($name === '') {
                // ignore comments
                continue;
            }
            switch ($name) {
                case 'event':
                    $event->eventType = $value;
                    break;
                case 'data':
                    $event->data = empty($event->data) ? $value : "$event->data\n$value";
                    break;
                case 'id':
                    $event->id = $value;
                    break;
                case 'retry':
                    $event->retry = (int) $value;
                    break;
                default:
                    // The field is ignored.
                    continue;
            }
        }
        return $event;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getEventType()
    {
        return $this->eventType;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getRetry()
    {
        return $this->retry;
    }
}
