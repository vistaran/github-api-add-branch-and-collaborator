<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubRef.php');
	

class GitHubGitRefs extends GitHubService
{

	/**
	 * Get a Reference
	 * 
	 * @return GitHubRef
	 */
	public function getReference($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/refs/heads/skunkworkz/featureA", 'GET', $data, 200, 'GitHubRef');
	}
	
	/**
	 * Get all References
	 * 
	 */
	public function getAllReferences($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/refs", 'GET', $data, 200, 'GitHubRef');
	}

	public function post($owner, $repo, $branch_name, $sha)
	{
		$request_data = ['ref' => 'refs/heads/' . $branch_name, 'sha' => $sha];
		return $this->client->request("/repos/$owner/$repo/git/refs", 'POST', json_encode($request_data), 201, '');
	}
}

