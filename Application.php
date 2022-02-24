<?php
require_once('ApiClient.php');

class Application
{
    private ApiClient $apiClient;

    //TODO: implement solution to the exercise
    
	public function __construct(ApiClient $apiClient) 
    {
        $this->apiClient = $apiClient;
    }
    
    public function getCapsules(int $limit, int $offset): array
    {
        return $this->apiClient->getCapsules($limit, $offset);
    }
}