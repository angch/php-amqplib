<?php

/* This file was autogenerated by spec/parser.php - Do not modify */

class PhpAmqpLib_Helper_Protocol_Protocol080
{

	public function connectionStart($version_major = 0, $version_minor = 8, $server_properties, $mechanisms = 'PLAIN', $locales = 'en_US') {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_octet($version_major);
		$args->write_octet($version_minor);
		$args->write_table($server_properties);
		$args->write_longstr($mechanisms);
		$args->write_longstr($locales);
		return array(10, 10, $args);
	}

	public static function connectionStartOk($args) {
		$ret = array();
		$ret[] = $args->read_table();
		$ret[] = $args->read_shortstr();
		$ret[] = $args->read_longstr();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function connectionSecure($challenge) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_longstr($challenge);
		return array(10, 20, $args);
	}

	public static function connectionSecureOk($args) {
		$ret = array();
		$ret[] = $args->read_longstr();
		return $ret;
	}

	public function connectionTune($channel_max = 0, $frame_max = 0, $heartbeat = 0) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($channel_max);
		$args->write_long($frame_max);
		$args->write_short($heartbeat);
		return array(10, 30, $args);
	}

	public static function connectionTuneOk($args) {
		$ret = array();
		$ret[] = $args->read_short();
		$ret[] = $args->read_long();
		$ret[] = $args->read_short();
		return $ret;
	}

	public function connectionOpen($virtual_host = '/', $capabilities = '', $insist = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($virtual_host);
		$args->write_shortstr($capabilities);
		$args->write_bit($insist);
		return array(10, 40, $args);
	}

	public static function connectionOpenOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function connectionRedirect($host, $known_hosts = '') {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($host);
		$args->write_shortstr($known_hosts);
		return array(10, 50, $args);
	}

	public function connectionClose($reply_code, $reply_text = '', $class_id, $method_id) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_short($class_id);
		$args->write_short($method_id);
		return array(10, 60, $args);
	}

	public static function connectionCloseOk($args) {
		$ret = array();
		return $ret;
	}

	public function channelOpen($out_of_band = '') {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($out_of_band);
		return array(20, 10, $args);
	}

	public static function channelOpenOk($args) {
		$ret = array();
		return $ret;
	}

	public function channelFlow($active) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_bit($active);
		return array(20, 20, $args);
	}

	public static function channelFlowOk($args) {
		$ret = array();
		$ret[] = $args->read_bit();
		return $ret;
	}

	public function channelAlert($reply_code, $reply_text = '', $details = array (
)) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_table($details);
		return array(20, 30, $args);
	}

	public function channelClose($reply_code, $reply_text = '', $class_id, $method_id) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_short($class_id);
		$args->write_short($method_id);
		return array(20, 40, $args);
	}

	public static function channelCloseOk($args) {
		$ret = array();
		return $ret;
	}

	public function accessRequest($realm = '/data', $exclusive = false, $passive = true, $active = true, $write = true, $read = true) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($realm);
		$args->write_bit($exclusive);
		$args->write_bit($passive);
		$args->write_bit($active);
		$args->write_bit($write);
		$args->write_bit($read);
		return array(30, 10, $args);
	}

	public static function accessRequestOk($args) {
		$ret = array();
		$ret[] = $args->read_short();
		return $ret;
	}

	public function exchangeDeclare($ticket = 1, $exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false, $internal = false, $nowait = false, $arguments = array (
)) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($exchange);
		$args->write_shortstr($type);
		$args->write_bit($passive);
		$args->write_bit($durable);
		$args->write_bit($auto_delete);
		$args->write_bit($internal);
		$args->write_bit($nowait);
		$args->write_table($arguments);
		return array(40, 10, $args);
	}

	public static function exchangeDeclareOk($args) {
		$ret = array();
		return $ret;
	}

	public function exchangeDelete($ticket = 1, $exchange, $if_unused = false, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($exchange);
		$args->write_bit($if_unused);
		$args->write_bit($nowait);
		return array(40, 20, $args);
	}

	public static function exchangeDeleteOk($args) {
		$ret = array();
		return $ret;
	}

	public function queueDeclare($ticket = 1, $queue = '', $passive = false, $durable = false, $exclusive = false, $auto_delete = false, $nowait = false, $arguments = array (
)) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_bit($passive);
		$args->write_bit($durable);
		$args->write_bit($exclusive);
		$args->write_bit($auto_delete);
		$args->write_bit($nowait);
		$args->write_table($arguments);
		return array(50, 10, $args);
	}

	public static function queueDeclareOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		$ret[] = $args->read_long();
		$ret[] = $args->read_long();
		return $ret;
	}

	public function queueBind($ticket = 1, $queue = '', $exchange, $routing_key = '', $nowait = false, $arguments = array (
)) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_bit($nowait);
		$args->write_table($arguments);
		return array(50, 20, $args);
	}

	public static function queueBindOk($args) {
		$ret = array();
		return $ret;
	}

	public function queuePurge($ticket = 1, $queue = '', $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_bit($nowait);
		return array(50, 30, $args);
	}

	public static function queuePurgeOk($args) {
		$ret = array();
		$ret[] = $args->read_long();
		return $ret;
	}

	public function queueDelete($ticket = 1, $queue = '', $if_unused = false, $if_empty = false, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_bit($if_unused);
		$args->write_bit($if_empty);
		$args->write_bit($nowait);
		return array(50, 40, $args);
	}

	public static function queueDeleteOk($args) {
		$ret = array();
		$ret[] = $args->read_long();
		return $ret;
	}

	public function queueUnbind($ticket = 1, $queue = '', $exchange, $routing_key = '', $arguments = array (
)) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_table($arguments);
		return array(50, 50, $args);
	}

	public static function queueUnbindOk($args) {
		$ret = array();
		return $ret;
	}

	public function basicQos($prefetch_size = 0, $prefetch_count = 0, $global = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_long($prefetch_size);
		$args->write_short($prefetch_count);
		$args->write_bit($global);
		return array(60, 10, $args);
	}

	public static function basicQosOk($args) {
		$ret = array();
		return $ret;
	}

	public function basicConsume($ticket = 1, $queue = '', $consumer_tag = '', $no_local = false, $no_ack = false, $exclusive = false, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_shortstr($consumer_tag);
		$args->write_bit($no_local);
		$args->write_bit($no_ack);
		$args->write_bit($exclusive);
		$args->write_bit($nowait);
		return array(60, 20, $args);
	}

	public static function basicConsumeOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function basicCancel($consumer_tag, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_bit($nowait);
		return array(60, 30, $args);
	}

	public static function basicCancelOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function basicPublish($ticket = 1, $exchange = '', $routing_key = '', $mandatory = false, $immediate = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_bit($mandatory);
		$args->write_bit($immediate);
		return array(60, 40, $args);
	}

	public function basicReturn($reply_code, $reply_text = '', $exchange, $routing_key) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		return array(60, 50, $args);
	}

	public function basicDeliver($consumer_tag, $delivery_tag, $redelivered = false, $exchange, $routing_key) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_longlong($delivery_tag);
		$args->write_bit($redelivered);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		return array(60, 60, $args);
	}

	public function basicGet($ticket = 1, $queue = '', $no_ack = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_bit($no_ack);
		return array(60, 70, $args);
	}

	public static function basicGetOk($args) {
		$ret = array();
		$ret[] = $args->read_longlong();
		$ret[] = $args->read_bit();
		$ret[] = $args->read_shortstr();
		$ret[] = $args->read_shortstr();
		$ret[] = $args->read_long();
		return $ret;
	}

	public static function basicGetEmpty($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function basicAck($delivery_tag = 0, $multiple = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_longlong($delivery_tag);
		$args->write_bit($multiple);
		return array(60, 80, $args);
	}

	public function basicReject($delivery_tag, $requeue = true) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_longlong($delivery_tag);
		$args->write_bit($requeue);
		return array(60, 90, $args);
	}

	public function basicRecoverAsync($requeue = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_bit($requeue);
		return array(60, 100, $args);
	}

	public function basicRecover($requeue = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_bit($requeue);
		return array(60, 110, $args);
	}

	public static function basicRecoverOk($args) {
		$ret = array();
		return $ret;
	}

	public function fileQos($prefetch_size = 0, $prefetch_count = 0, $global = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_long($prefetch_size);
		$args->write_short($prefetch_count);
		$args->write_bit($global);
		return array(70, 10, $args);
	}

	public static function fileQosOk($args) {
		$ret = array();
		return $ret;
	}

	public function fileConsume($ticket = 1, $queue = '', $consumer_tag = '', $no_local = false, $no_ack = false, $exclusive = false, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_shortstr($consumer_tag);
		$args->write_bit($no_local);
		$args->write_bit($no_ack);
		$args->write_bit($exclusive);
		$args->write_bit($nowait);
		return array(70, 20, $args);
	}

	public static function fileConsumeOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function fileCancel($consumer_tag, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_bit($nowait);
		return array(70, 30, $args);
	}

	public static function fileCancelOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function fileOpen($identifier, $content_size) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($identifier);
		$args->write_longlong($content_size);
		return array(70, 40, $args);
	}

	public static function fileOpenOk($args) {
		$ret = array();
		$ret[] = $args->read_longlong();
		return $ret;
	}

	public function fileStage() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(70, 50, $args);
	}

	public function filePublish($ticket = 1, $exchange = '', $routing_key = '', $mandatory = false, $immediate = false, $identifier) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_bit($mandatory);
		$args->write_bit($immediate);
		$args->write_shortstr($identifier);
		return array(70, 60, $args);
	}

	public function fileReturn($reply_code = 200, $reply_text = '', $exchange, $routing_key) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		return array(70, 70, $args);
	}

	public function fileDeliver($consumer_tag, $delivery_tag, $redelivered = false, $exchange, $routing_key, $identifier) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_longlong($delivery_tag);
		$args->write_bit($redelivered);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_shortstr($identifier);
		return array(70, 80, $args);
	}

	public function fileAck($delivery_tag = 0, $multiple = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_longlong($delivery_tag);
		$args->write_bit($multiple);
		return array(70, 90, $args);
	}

	public function fileReject($delivery_tag, $requeue = true) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_longlong($delivery_tag);
		$args->write_bit($requeue);
		return array(70, 100, $args);
	}

	public function streamQos($prefetch_size = 0, $prefetch_count = 0, $consume_rate = 0, $global = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_long($prefetch_size);
		$args->write_short($prefetch_count);
		$args->write_long($consume_rate);
		$args->write_bit($global);
		return array(80, 10, $args);
	}

	public static function streamQosOk($args) {
		$ret = array();
		return $ret;
	}

	public function streamConsume($ticket = 1, $queue = '', $consumer_tag = '', $no_local = false, $exclusive = false, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($queue);
		$args->write_shortstr($consumer_tag);
		$args->write_bit($no_local);
		$args->write_bit($exclusive);
		$args->write_bit($nowait);
		return array(80, 20, $args);
	}

	public static function streamConsumeOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function streamCancel($consumer_tag, $nowait = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_bit($nowait);
		return array(80, 30, $args);
	}

	public static function streamCancelOk($args) {
		$ret = array();
		$ret[] = $args->read_shortstr();
		return $ret;
	}

	public function streamPublish($ticket = 1, $exchange = '', $routing_key = '', $mandatory = false, $immediate = false) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($ticket);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		$args->write_bit($mandatory);
		$args->write_bit($immediate);
		return array(80, 40, $args);
	}

	public function streamReturn($reply_code = 200, $reply_text = '', $exchange, $routing_key) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_short($reply_code);
		$args->write_shortstr($reply_text);
		$args->write_shortstr($exchange);
		$args->write_shortstr($routing_key);
		return array(80, 50, $args);
	}

	public function streamDeliver($consumer_tag, $delivery_tag, $exchange, $queue) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($consumer_tag);
		$args->write_longlong($delivery_tag);
		$args->write_shortstr($exchange);
		$args->write_shortstr($queue);
		return array(80, 60, $args);
	}

	public function txSelect() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(90, 10, $args);
	}

	public static function txSelectOk($args) {
		$ret = array();
		return $ret;
	}

	public function txCommit() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(90, 20, $args);
	}

	public static function txCommitOk($args) {
		$ret = array();
		return $ret;
	}

	public function txRollback() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(90, 30, $args);
	}

	public static function txRollbackOk($args) {
		$ret = array();
		return $ret;
	}

	public function dtxSelect() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(100, 10, $args);
	}

	public static function dtxSelectOk($args) {
		$ret = array();
		return $ret;
	}

	public function dtxStart($dtx_identifier) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($dtx_identifier);
		return array(100, 20, $args);
	}

	public static function dtxStartOk($args) {
		$ret = array();
		return $ret;
	}

	public function tunnelRequest($meta_data) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_table($meta_data);
		return array(110, 10, $args);
	}

	public function testInteger($integer_1, $integer_2, $integer_3, $integer_4, $operation) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_octet($integer_1);
		$args->write_short($integer_2);
		$args->write_long($integer_3);
		$args->write_longlong($integer_4);
		$args->write_octet($operation);
		return array(120, 10, $args);
	}

	public static function testIntegerOk($args) {
		$ret = array();
		$ret[] = $args->read_longlong();
		return $ret;
	}

	public function testString($string_1, $string_2, $operation) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_shortstr($string_1);
		$args->write_longstr($string_2);
		$args->write_octet($operation);
		return array(120, 20, $args);
	}

	public static function testStringOk($args) {
		$ret = array();
		$ret[] = $args->read_longstr();
		return $ret;
	}

	public function testTable($table, $integer_op, $string_op) {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		$args->write_table($table);
		$args->write_octet($integer_op);
		$args->write_octet($string_op);
		return array(120, 30, $args);
	}

	public static function testTableOk($args) {
		$ret = array();
		$ret[] = $args->read_longlong();
		$ret[] = $args->read_longstr();
		return $ret;
	}

	public function testContent() {
		$args = new PhpAmqpLib_Wire_AMQPWriter();
		return array(120, 40, $args);
	}

	public static function testContentOk($args) {
		$ret = array();
		$ret[] = $args->read_long();
		return $ret;
	}
}
