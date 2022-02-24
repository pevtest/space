<?php
interface ApiClient
{
    public function getCapsules(int $limit, int $offset): array;
}

class GraphQLApi implements ApiClient
	{
		public function getCapsules(int $limit, int $offset): array
		{
			// Fetches data from the SpaceX public GraphQL API.
			$endpoint = "https://api.spacex.land/graphql/";
			$qry = '{"query":"query {capsules(limit: '.$limit.', offset: '.$offset.') {id landings status type missions { flight name }}}"}';
			$headers = array();
			$headers[] = 'Content-Type: application/json';

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $qry);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			return json_decode($result, true);
		}
	}

class RestApi implements ApiClient
{
	public function getCapsules(int $limit, int $offset): array
	{
		$endpoint = "https://api.spacex.land/rest/capsules?id=&landings=0&mission=string&original_launch=&reuse_count=0&status=string&type=string&limit=".$limit."&offset=".$offset;
		
		$headers = array();
		$headers[] = 'accept: application/json';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}	
		
		return json_decode($result, true);
	}
}