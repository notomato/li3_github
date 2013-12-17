# li3_github

This library provides a data source for the Github API.

## Configuration

Authentication is via Basic auth or personal access tokens. Add the following to your connections.php file or somewhere
in your bootstrap process.

    Connections::add('github', array(
        'development' => array(
            'type' => 'http',
            'adapter' => 'GitHub',
            'token' => 'xxxxx'
        ),
        'production' => array(
            'type' => 'http',
            'adapter' => 'GitHub',
            'login' => 'notomato',
            'password' => 'github_password'
        )
    ));

Note: you'll need to use a token if you have 2 factor authentication setup on your github account.

## Usage

    $repos = Users::repos(array(
        'conditions' => array(
            'user' => 'octocat'
        )
    ));

See source for more options.

## Todo

- other authentication methods
- more testing
- more api endpoints