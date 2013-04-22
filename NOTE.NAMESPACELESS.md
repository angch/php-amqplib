This is an experimental subbranch by angch to make php-amqplib
namespaceless at least so that it can run under hiphop php (hhvm)
properly.

The primary motivation is to make it run under hhvm -m run out of the
box (git), with the least amount of dependencies. This also means
coming out with an autoload stub that is compatbile with php-amqplib.
This replacement autoload.php is in the PhpAmqpLib directory and will
autoload the required PhpAmqpLib files.

When converting this library to namespaceless, the following classes
are declared as-is into the global space while the rest have the
namespaces encoded fully as underscores. (e.g. PhpAmqpLib_Wire_IO_StreamIO)
  * AMQPChannel
  * AMQPConnection
  * AMQPStreamConnectio
  * AMQPRuntimeExceptio
  * AMQPMessage
  * AMQPSSLConnection

Caveat: This is mostly done and tested via the benchmark and demo files.

To use, when you would run any of the scrips as "php producer.php", use
"hhvm -mrun producer.php" instead. In client scripts, just remove any "use "
namespace statements.

FYI, informal benchmark of benchmark/producer.php 10000 yields:
  * php 5.3.10 -- 4.55 seconds
  * hhvm 2.0.1 -- 1.77 seconds

