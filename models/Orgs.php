<?php

namespace li3_github\models;

class Orgs extends \lithium\data\Model {

	protected $_meta = array('connection' => 'github');
}

Orgs::finder('repos', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'repos';
	$data = $chain->next($self, $params, $chain);
	return $data;
});