<?php

$app->post('/api/BingMaps/getStaticMap', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['key','query','mapLayer','zoomLevel']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['key'=>'key', 'query'=>'query', 'mapLayer'=>'mapLayer','zoomLevel'=>'zoomLevel'];
    $optionalParams = [];
    $bodyParams = [
       'query' => ['key','mapLayer','zoomLevel']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    $client = $this->httpClient;
    $query_str = "https://dev.virtualearth.net/REST/V1/Imagery/Map/Road/{$data['query']}";


    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = [];

    $fileParams = array('fileName' => 'map.jpeg');
    $result = \Models\RequestFacade::makeRequest($client,$query_str,$requestParams,true,$fileParams);

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});