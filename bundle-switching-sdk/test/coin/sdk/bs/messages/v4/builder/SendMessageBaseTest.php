<?php


namespace coin\sdk\bs\messages\v4\builder;


use coin\sdk\bs\service\impl\BundleSwitchingService;
use PHPUnit\Framework\TestCase;

abstract class SendMessageBaseTest extends TestCase
{
    protected $provider;
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->provider = $GLOBALS['Provider'];
        $this->service = new BundleSwitchingService();
    }
}
