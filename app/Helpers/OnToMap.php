<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;


class OnToMap
{
    /**
     * Get OnToMap events.
     *
     * @return string, the request response.
     */
    public static function getEvents($params = array())
    {
        $client = new Client();

        try {
            $queryString = '';

            if(!empty($params)) {
                $queryString = '?'.http_build_query($params);
            }

            $result = $client->request('GET', env('OTM_EVENTS_URL').$queryString, [
                'cert' => env('OTM_CERT_PATH')
            ]);

            return (string) $result->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Get OnToMap mappings.
     *
     * @return string, the request response.
     */
    public static function getMappings()
    {
        $client = new Client();

        try {
            $result = $client->request('GET', env('OTM_MAPPING_URL'), [
                'cert' => env('OTM_CERT_PATH')
            ]);

            return (string) $result->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Post event to OnToMap.
     *
     * @return string, the request response.
     */
    public static function postEvent($events = array())
    {
        if(empty($events)) {
            return 'Your event list is empty';
        }

        $client = new Client();

        try {
            //$eventList = (object) $events;

            $result = $client->request('POST', env('OTM_EVENTS_URL'), [
                'json' => (object) $events,
                'cert' => env('OTM_CERT_PATH')
            ]);


            return (string) $result->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Post mapping to OnToMap.
     *
     * @return string, the request response.
     */
    public static function postMapping($mapping = array())
    {
        if(empty($mapping)) {
            return 'Your mapping is empty';
        }


        $client = new Client();

        try {
            $mappingList = (object) $mapping;
            
            $result = $client->request('POST', env('OTM_MAPPING_URL'), [
                'json' => $mappingList,
                'cert' => env('OTM_CERT_PATH')
            ]);


            return (string) $result->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }
}