<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\service\impl\NumberPortabilityService;
use PHPUnit\Framework\TestCase;

abstract class SendMessageBaseTest extends TestCase
{
    protected $operator;
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->operator = $GLOBALS['Operator'];
        $this->service = new NumberPortabilityService();
    }
}