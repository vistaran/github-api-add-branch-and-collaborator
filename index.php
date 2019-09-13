<?php

require_once(__DIR__ . '/client/GitHubClient.php');

$repos = array(
	'socket.io-basic-realtime-messaging-demo'
);

$username = $argv[1];
$password = $argv[2];
$branch_name = $argv[3]; // collaborator
$collaborator = $argv[4]; // branch name

$client = new GitHubClient();
$client->setCredentials($username, $password);

/* get references */
$refs = $client->refs->getAllReferences($username, $repos[0]);
$first_ref = $refs[0];
$master_sha = $first_ref->getObject()->sha;

/* create branch */
$create_branch_response = $client->refs->post($username, $repos[0], $branch_name, $master_sha);

/* add collaborator */
$collaborator_response = $client->repos->collaborators->put($username, $repos[0], $collaborator, ['permission' => 'push']);

exit;
