<?php

namespace li3_github\models;

class Gist extends \lithium\data\Model {

	protected $_meta = array('connection' => 'github', 'source' => 'gist');
}

Gist::finder('comments', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'comments';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

?>