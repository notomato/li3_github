<?php

namespace li3_github\models;

class Gists extends \lithium\data\Model {

	protected $_meta = array('connection' => 'github');
}

Gists::finder('public', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'public';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Gists::finder('starred', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'starred';
	$data = $chain->next($self, $params, $chain);
	return $data;
});