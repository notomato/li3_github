<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_github\extensions\adapter\security\auth;

use li3_github\models\User;

class Http extends \lithium\security\auth\adapter\Http {

	/**
	 * Called by the `Auth` class to run an authentication check against the HTTP data using the
	 * credentials in a data container (a `Request` object), and returns an array of user
	 * information on success, or `false` on failure.
	 *
	 * @param object $request A env container which wraps the authentication credentials used
	 *               by HTTP (usually a `Request` object). See the documentation for this
	 *               class for further details.
	 * @param array $options Additional configuration options. Not currently implemented in this
	 *              adapter.
	 * @return array Returns an array containing user information on success, or `false` on failure.
	 */
	public function check($request, array $options = array()) {
		$user = User::first();

		if (isset($user->message)) {
			$message = "To access {$this->_config['realm']}, "
				. "use your GitHub username and password.";
			$this->_writeHeader("WWW-Authenticate: Basic realm=\"{$message}\"");
			return;
		}
		return compact('user');
	}
}

?>