<?php

namespace li3_github\models;

class Repos extends \lithium\data\Model {

	protected $_meta = array('connection' => 'github');
}

Repos::finder('issues', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'issues';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('commits', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'commits';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('forks', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'commits';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('issues', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'issues';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('milestones', function($self, $params, $chain) {
    $params['options']['conditions']['type'] = 'milestones';
    $data = $chain->next($self, $params, $chain);
    return $data;
});

Repos::finder('readme', function($self, $params, $chain) {
    $params['options']['conditions']['type'] = 'readme';
    $data = $chain->next($self, $params, $chain);
    return $data;
});