<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require('/app/vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

include __DIR__ . '/config.php';

$connection = new AMQPStreamConnection($config['host'], 5672, $config['user'], $config['pass']);

$channel = $connection->channel();

$channel->queue_declare($config['queue'], false, true, false, false);

$channel->exchange_declare($config['exchange'], PhpAmqpLib\Exchange\AMQPExchangeType::DIRECT, false, true, false);

$channel->queue_bind($config['queue'], $config['exchange']);

$messageBody = 'My test message';
$message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
$channel->basic_publish($message, $config['exchange']);

$channel->close();
$connection->close();
