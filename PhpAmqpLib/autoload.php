<?php

if (!defined('PHPAMQPLIB_PATH')) {
    define('PHPAMQPLIB_PATH', __DIR__);
}

// Sorry.
$_phpampqlib_mapping_exceptions =  array(
    'AMQPChannel'          => PHPAMQPLIB_PATH.'/Channel/AMQPChannel.php',
    'AMQPConnection'       => PHPAMQPLIB_PATH.'/Connection/AMQPConnection.php',
    'AMQPStreamConnection' => PHPAMQPLIB_PATH.'/Connection/AMQPStreamConnection.php',
    'AMQPRuntimeException' => PHPAMQPLIB_PATH.'/Exception/AMQPRuntimeException.php',
    'AMQPTimeoutException' => PHPAMQPLIB_PATH.'/Exception/AMQPTimeoutException.php',
    'AMQPMessage'          => PHPAMQPLIB_PATH.'/Message/AMQPMessage.php',
    'AMQPSSLConnection'    => PHPAMQPLIB_PATH.'/Connection/AMQPSSLConnection.php',
);

//PHPAMQPLIB_PATH
function phpamqplib_loader($class) {
    global $_phpampqlib_mapping_exceptions;
    //print "autoload $class\n";
    if (isset($_phpampqlib_mapping_exceptions[$class])) {
        // Exceptions mapping
        require_once $_phpampqlib_mapping_exceptions[$class];
    } else if (preg_match('/^PhpAmqpLib/', $class)) {
        @$paths = explode('\\', $class);
        array_shift($paths);
        if (!file_exists(PHPAMQPLIB_PATH."/".implode("/", $paths).".php")) {
            @$paths = explode('_', $class);
            array_shift($paths);
        }
        require_once PHPAMQPLIB_PATH."/".implode("/", $paths).".php";
    }
}
spl_autoload_register('phpamqplib_loader');
