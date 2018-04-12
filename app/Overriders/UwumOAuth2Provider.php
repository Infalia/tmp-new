<?php
    namespace App\Overriders;


    /**
     * Overrides the generic service provider that may be used to interact with any OAuth 2.0 service provider,
     * using Bearer token authentication. This class adds certification path (cert) in $options.
     */
    class UwumOAuth2Provider extends \League\OAuth2\Client\Provider\GenericProvider
    {
        protected function getAllowedClientOptions(array $options)
        {
            $client_options = [
                'timeout',
                'proxy',
                'cert'
            ];

            return $client_options;
        }
    }