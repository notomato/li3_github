<?php

namespace li3_github\models;

class User extends \lithium\data\Model {

	protected $_meta = array('connection' => 'github', 'source' => 'user');
}

User::finder('repos', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'repos';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

User::finder('orgs', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'orgs';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

?>