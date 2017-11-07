<?php
namespace Models;
class RequestFacade {
    static function makeRequest( \GuzzleHttp\Client $client,$queryString,$requestParams,$fileReturn = false,$fileParams = array())
    {
        try {
            $resp = $client->get($queryString, $requestParams);
            $responseBody = $resp->getBody()->getContents();
            if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
                if($fileReturn)
                {
                    $uploadUrl = 'http://104.198.149.144:8080/';
                    $size = $resp->getHeader('Content-Length')[0];
                    $contentDisposition = $resp->getHeader('Content-Disposition');

                    //If name is not specified,by default send an empty value.
                    $fileName = ' ';

                    //If the file name is not specified from fileParams, we try to get it from the header.
                    if(!empty($contentDisposition) && empty($fileParams))
                    {
                        $fileHeaderPattern = '/filename=".+"/';
                        preg_match($fileHeaderPattern, $contentDisposition, $result);
                        $fileNamePattern = '/"(.*)"/';
                        preg_match($fileNamePattern, $result[0], $fileName);
                        if(!empty($fileName[0]))
                        {
                            $fileName = $fileName[0];
                        }
                    }

                    //specified name from fileParams
                    if(!empty($fileParams['fileName']))
                    {
                        $fileName = $fileParams['fileName'];
                    }
                    $uploadServiceResponse = $client->post($uploadUrl, [
                        'multipart' => [
                            [
                                'name' => 'length',
                                'contents' => $size
                            ],
                            [
                                "name" => "file",
                                "filename" => $fileName,
                                "contents" => $responseBody
                            ]
                        ]
                    ]);
                    $responseBody = $uploadServiceResponse->getBody()->getContents();
                }
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
                if(empty($result['contextWrites']['to'])) {
                    $result['contextWrites']['to']['status_msg'] = "Api return no results";
                }
            } else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
            }
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            if(empty(json_decode($responseBody))) {
                $out = $responseBody;
            } else {
                $out = json_decode($responseBody);
            }
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $out;
        } catch (GuzzleHttp\Exception\ServerException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            if(empty(json_decode($responseBody))) {
                $out = $responseBody;
            } else {
                $out = json_decode($responseBody);
            }
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $out;
        } catch (GuzzleHttp\Exception\ConnectException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
            $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';
        }
        return $result;
    }
}