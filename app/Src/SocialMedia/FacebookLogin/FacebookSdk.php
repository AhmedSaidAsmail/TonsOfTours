<?php

namespace App\Src\SocialMedia\FacebookLogin;

use Facebook\Facebook;
use Illuminate\Http\Request;

class FacebookSdk
{

    /**
     * @return string
     */
    public static function linkGeneration()
    {
        try {
            $fb = self::getFb();
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl(route('customer.facebook.login'), $permissions);
            return $loginUrl;
        } catch (\Exception $ex) {
            return "#";
        }

    }

    /**
     * @return Facebook
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private static function getFb()
    {
        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.2',
        ]);
        return $fb;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function getUserData(Request $request)
    {
        try {
            $fb = self::getFb();
            $helper = $fb->getRedirectLoginHelper();
            $helper->getPersistentDataHandler()->set('state', $request->get('state'));
            $accessToken = $helper->getAccessToken();
            $fb->setDefaultAccessToken($accessToken);
            $res = $fb->get('/me?local=en_US&fields=name,email');
            $user = $res->getGraphUser();
            return [
                'name' => $user->getField('name'),
                'email' => $user->getField('email')
            ];
        } catch (\Exception $ex) {
            throw new FaceBookErrorException($ex->getMessage());
        }
    }

}