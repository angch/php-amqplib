This is an experimental fork by angch to make php-amqplib
namespaceless and PHP 5.2 compatible (down from PHP 5.3) at least so
that it can run under hiphop php (hhvm). hhvm supports PHP 5.2 only.

The primary motivation is to make it run under hhvm -m run out of the
box (git), with the least amount of dependencies. This just requires
the PhpAmqpLib to be included. This means coming out with an autoload
stub that is compatbile with php-amqplib. This replacement autoload.php
is in the PhpAmqpLib directory and will autoload the required PhpAmqpLib
files.

When converting this library to namespaceless, the following classes
are declared as-is into the global space while the rest have the
namespaces encoded fully as underscores. (e.g. PhpAmqpLib_Wire_IO_StreamIO)
 * AMQPChannel
 * AMQPConnection
 * AMQPStreamConnection
 * AMQPSocketConnection
 * AMQPMessage
 * AMQPSSLConnection
 * AMQPRuntimeException
 * AMQPTimeoutException
 * AMQPProtocolChannelException
 * AMQPProtocolException
 * AMQPProtocolConnectionException

Caveat: This is mostly done and tested via the benchmark and demo files,
and phpunit tested.

To use, when you would run any of the scrips as "php producer.php", use
"hhvm -mrun producer.php" instead. In client scripts, just remove any "use "
statements. You can assume that the above classes are "use"d after you include
the autoload.php

FYI, informal benchmark of benchmark/producer.php 10000 yields:
  * php 5.3.10 -- 4.55 seconds
  * hhvm 2.0.1 -- 1.77 seconds

