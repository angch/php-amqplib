<?php

//namespace PhpAmqpLib\Tests\Functional;

//use PhpAmqpLib\Connection\AMQPSocketConnection;

class SocketPublishConsumeTest extends PhpAmqpLib_Tests_Functional_AbstractPublishConsumeTest
{
    protected function createConnection()
    {
        return new AMQPSocketConnection(HOST, PORT, USER, PASS, VHOST);
    }
}
