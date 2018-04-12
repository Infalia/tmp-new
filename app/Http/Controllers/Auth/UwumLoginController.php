<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Overriders\UwumOAuth2Provider;
use App\User;

class UwumLoginController extends Controller
{
    public function redirectToUwumProvider(Request $requestHttp)
    {
        $provider = new UwumOAuth2Provider([
            'clientId' => env('UWUM_CLIENT_ID'), // The client ID assigned to you by UWUM Certificate Authority (actually your CN)
            'clientSecret' => '', // We need no clientSecret since we are using certificates for client authentication
            'redirectUri' => env('UWUM_CALLBACK_URL'), // Currently should be the same as declared in UWUM Certificate Authority
            'urlAuthorize' => env('UWUM_AUTH_URL'), // UWUM API endpoints
            'urlAccessToken' => env('UWUM_TOKEN_URL'),
            'cert' => env('CERT_PATH'), // Path to your pem (outside web directory)
            'urlResourceOwnerDetails' => '' // N/A
        ]);


        // If we don't have an authorization code yet then get one
        if (!isset($_GET['code'])) {
            // Fetch the authorization URL from the provider; this returns the urlAuthorize option and generates and applies
            // any necessary parameters. (e.g. state). At this point you set scopes (multiple scopes are space separated).
            $options = [
                'scope' => ['identification notify_email_detached']
            ];

            $authorizationUrl = $provider->getAuthorizationUrl($options);

            // Get the state generated for you and store it to the session.
            $requestHttp->session()->put('oauth2state', $provider->getState());

            // Redirect the user to the authorization URL.
            return redirect($authorizationUrl);

            exit;
            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $requestHttp->session()->get('oauth2state'))) {
            $requestHttp->session()->forget('oauth2state');
            exit('Invalid state');
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                        'code' => $_GET['code']
                    ]
                );

                $requestHttp->session()->put('uwumAccessToken', $accessToken);
                $requestHttp->session()->put('uwumRefreshToken', $accessToken->getRefreshToken());


                // echo '<h1>--- RAW DATA received from UWUM ---</h1>';
                // echo 'token='.$accessToken->getToken() . "\n<br />";
                // echo 'refresh token='.$accessToken->getRefreshToken() . "\n<br />";
                // echo 'expires='.$accessToken->getExpires() . "\n<br />";
                // echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n<br />";
                // echo 'values='; print_r($accessToken->getValues()) . "\n<br />";
                $values = $accessToken->getValues();
                


                // // We have an access token, which we may use in authenticated requests against the service provider's API.
                $request = $provider->getAuthenticatedRequest('POST', env('UWUM_VALIDATE_URL'), $accessToken);
                $httpResponse = $provider->getResponse($request);
                // //echo '<h1>--- VALIDATE access token ---</h1>';
                // //echo (string) $httpResponse->getBody();
                $accessTokenResponse = json_decode((string) $httpResponse->getBody(), true);



                // // Call any UWUM API (e.g. info)
                $request = $provider->getAuthenticatedRequest('GET', env('UWUM_INFO_URL').'?include_member=1', $accessToken);
                $httpResponse = $provider->getResponse($request);
                // //echo '<h1>--- CALLING GET/info ---</h1>';
                // //echo (string) $httpResponse->getBody();
                $userInfoResponse = json_decode((string) $httpResponse->getBody(), true);



                // // Call any UWUM API (e.g. notify_email)
                $request = $provider->getAuthenticatedRequest('GET', env('UWUM_NOTIFY_EMAIL_URL'), $accessToken);
                $httpResponse = $provider->getResponse($request);
                // //echo '<h1>--- CALLING GET/notify_email ---</h1>';
                // //echo (string) $httpResponse->getBody();
                $userEmailResponse = json_decode((string) $httpResponse->getBody(), true);

                

                if(1 == $accessTokenResponse['logged_in']) {
                    // If is logged in as an association
                    if(isset($accessTokenResponse['member_is_role']) && 1 == $accessTokenResponse['member_is_role']) {
                        $userId = $userInfoResponse['real_member']['id'];
                        $userName = $userInfoResponse['real_member']['name'];
                        $userEmail = null;

                        $requestHttp->session()->put('association.member_is_role', $accessTokenResponse['member_is_role']);
                        $requestHttp->session()->put('association.member_id', $userInfoResponse['member']['id']);
                        $requestHttp->session()->put('association.member_name', $userInfoResponse['member']['name']);
                        $requestHttp->session()->put('association.real_member_id', $userInfoResponse['real_member']['id']);
                        $requestHttp->session()->put('association.real_member_name', $userInfoResponse['real_member']['name']);
                    }
                    else {
                        $userId = $userInfoResponse['member']['id'];
                        $userName = $userInfoResponse['member']['name'];
                        $userEmail = null;

                        if(isset($userEmailResponse['result']['notify_email'])) {
                            $userEmail = $userEmailResponse['result']['notify_email'];
                        }

                        if($requestHttp->session()->exists('association')) {
                            $requestHttp->session()->forget('association');
                        }
                    }

                    $user = User::find($userId);


                    if(!empty($user)) {
                        $toBeUpdated = false;

                        // TMP user name is different from UWUM user name
                        if($user->name != $userName) {
                            $user->name = $userName;
                            $toBeUpdated = true;
                        }

                        if(!empty($userEmail)) {
                            // TMP user email is different from UWUM user email
                            if($user->email != $userEmail) {
                                $user->email = $userEmail;
                                $toBeUpdated = true;
                            }

                            $isEmailConfirmed = true;
                        }

                        if($toBeUpdated) {
                            $user->save();
                        }
                        
                        Auth::loginUsingId($userId);
                    }
                    else {
                        $user = new User;
                        $user->id = $userId;
                        $user->name = $userName;

                        if(!empty($userEmail)) {
                            $user->email = $userEmail;
                        }

                        $user->save();
                    }
                }


                return redirect(url('/'));

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                // Failed to get the access token or user details.
                print_r($e->getResponseBody());
                //print('<a href="grant.php">Refresh</a>');
                exit();
            }
        }
    }

    /**
     * Obtain the user information from UWUM.
     *
     * @return Response
     */
    public function handleUwumCallback(Request $request)
    {
        if(!isset($_REQUEST['state'], $_REQUEST['code'])) {
            die('Callback failed (state and code do not received correctly)');
        }

        $url = url('login/uwum').'?state='.$_REQUEST['state'].'&code='.$_REQUEST['code'];

        return redirect($url);
    }
}
