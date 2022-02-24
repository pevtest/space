<?php
require_once('Application.php');
require_once('ApiClient.php');

// 1. Instantiate ApiClient
$graphQLApi = new GraphQLApi();
// $restApi = new RestApi();
// 2. Instantiate Application
$application = new Application($graphQLApi);
//$application = new Application($restApi);
// 3. Fetch data from received user parameters (limit and offset)

if(isset($_GET['limit']) && isset($_GET['offset']))
{
    $limit =  intVal($_GET['limit']);
    $offset = intval($_GET['offset']);  
    $capsules = $application->getCapsules($limit, $offset);
    // 4. Generate json output. Just plain text, no need for html and css
    $jsonOutput = json_encode($capsules);
    echo $jsonOutput;
} else {
    echo "Bad request.";
}

?>
