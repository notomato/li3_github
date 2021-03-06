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

Repos::finder('collaborators', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'collaborators';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('contributors', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'contributors';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('contributorsStats', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'stats';
	$params['options']['conditions']['id'] = 'contributors';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('activityStats', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'stats';
	$params['options']['conditions']['id'] = 'commit_activity';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('frequencyStats', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'stats';
	$params['options']['conditions']['id'] = 'code_frequency';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('participationStats', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'stats';
	$params['options']['conditions']['id'] = 'participation';
	$data = $chain->next($self, $params, $chain);
	return $data;
});

Repos::finder('punchCard', function($self, $params, $chain) {
	$params['options']['conditions']['type'] = 'stats';
	$params['options']['conditions']['id'] = 'punch_card';
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