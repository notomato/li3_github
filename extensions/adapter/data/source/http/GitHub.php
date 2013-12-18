<?php

namespace li3_github\extensions\adapter\data\source\http;

use \lithium\util\String;

/**
 * Lithium GitHub Data Source.
 *
 * @package li3_github\extensions\adapter\data\source\http
 * @author John Anderson
 */
class GitHub extends \lithium\data\source\Http {

	protected $_strings = array(
		'users' => '/users/{:user}/{:type}',
		'user' => '/user/{:user}/{:type}',
		'issues' => '/issues',
		'repos' => '/repos/{:user}/{:repo}/{:type}/{:id}',
		'orgs' => '/orgs/{:org}/{:type}',
		'gist' => '/gists/{:id}/{:type}',
		'gists' => '/gists/{:type}'
	);

	protected $_params = array(
		'user', 'repo', 'type', 'id', 'org'
	);

	/**
	 * Class dependencies.
	 */
	protected $_classes = array(
		'service' => 'lithium\net\http\Service',
		'entity' => 'lithium\data\entity\Document',
		'set' => 'lithium\data\collection\DocumentSet',
        'schema' => 'lithium\data\DocumentSchema'
	);

	/**
	 * Constructor.
	 *
	 * @param array $config Configuration options.
	 */
	public function __construct(array $config = array()) {
		$defaults = array(
			'adapter'  => 'GitHub',
			'token'    => null,
			'scheme'   => 'https',
			'version'  => '1.1',
			'host'     => 'api.github.com',
			'port'     => 443,
			'path'     => '',
			'headers'  => array('Accept' => 'application/vnd.github.beta+json')
		);
		if (!empty($config['token'])) {
			$defaults['headers'] += array("Authorization" => "token {$config['token']}");
		}
		if (!empty($config['login']) && !empty($config['password'])) {
			$defaults['auth'] = "Basic";
		}
		parent::__construct($config + $defaults);
	}

	/**
	 * Data source READ operation.
	 *
	 * @param string $query
	 * @param array $options
	 * @return mixed
	 */
	public function read($query, array $options = array()) {
		extract($query->export($this));
		$path = $this->_path($source, $conditions);
		foreach ($this->_params as $param) {
			unset($conditions[$param]);
		}
		$options =  array('headers' => $this->_config['headers']);
        $data = $this->connection->get($path, $conditions, $options);

		if (empty($data)) {
			return null;
		}
		if (empty($data[0])) {
			return $this->item($query->model(), compact('data'), array('class' => 'entity'));
		}
		return $this->item($query->model(), (array) $data, array('class' => 'set'));
	}

	/**
	 * Data Source CREATE operation.
	 *
	 * @param string $query
	 * @param array $options
	 * @return mixed
	 */
	public function create($query, array $options = array()) {
		extract($query->export($this));
		$conditions = $query->entity()->_config;
		$path = $this->_path($source, $conditions);
		$options = array(
			'headers' => array('Content-Type' => 'application/json') + $this->_config['headers'],
			'follow_location' => false,
			'type' => 'json'
		);
		$result = $this->connection->post($path, json_encode($data['data']), $options);
		$data = json_decode($result);
		return isset($data);
	}

	/**
	 * Used for object formatting.
	 *
	 * @param string $entity
	 * @param array $data
	 * @param array $options
	 * @return mixed
	 */
	public function cast($entity, array $data, array $options = array()) {
		foreach($data as $key => $val) {
			if (!is_array($val)) {
				continue;
			}
			$data[$key] = $this->item($entity->model(), $val, array('class' => 'entity'));
		}
		return parent::cast($entity, $data, $options);
	}

    /**
     * Returns a newly-created `Document` object, bound to a model and populated with default data
     * and options.
     *
     * @param string $model A fully-namespaced class name representing the model class to which the
     *               `Document` object will be bound.
     * @param array $data The default data with which the new `Document` should be populated.
     * @param array $options Any additional options to pass to the `Document`'s constructor
     * @return object Returns a new, un-saved `Document` object bound to the model class specified
     *         in `$model`.
     */
    public function item($model, array $data = array(), array $options = array()) {
        $defaults = array('class' => 'entity');
        $options += $defaults;
        return $model::create($data, $options);
    }

	/**
	 * Convert conditions to a path
	 *
	 * @param string $source
	 * @param array $conditions
	 * @return string
	 */
	protected function _path($source, $conditions = array()) {
		if (!isset($this->_strings[$source])) {
			return null;
		}
		$string = $this->_strings[$source];
		$conditions = array_map(function($value) {
			return is_string($value) ? urlencode($value) : null;
		}, (array) $conditions);
		$path = String::insert($string, $conditions, array('clean' => true));
		$path = rtrim(str_replace('//', '/', $path), '/');
		return $path;
	}
}