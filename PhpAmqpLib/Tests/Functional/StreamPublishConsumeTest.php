<?php

//namespace PhpAmqpLib\Tests\Functional;

//use PhpAmqpLib\Connection\AMQPStreamConnection;

class StreamPublishConsumeTest extends PhpAmqpLib_Tests_Functional_AbstractPublishConsumeTest
{
    protected function createConnection()
    {
        return new PhpAmqpLib_Connection_AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
    }
}
