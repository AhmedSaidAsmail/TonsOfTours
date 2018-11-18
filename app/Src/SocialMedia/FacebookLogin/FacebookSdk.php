<?php

namespace App\Src\SocialMedia\FacebookLogin;

use Facebook\Facebook;
use Illuminate\Http\Request;

class FacebookSdk
{
    const FACEBOOK_APP_ID = '1559671154134765';

    const FACEBOOK_APP_SECRET = '462717d9b0c347b5f00d1eb146145a8e';

    /**
     * @return string
     */
    public static function linkGeneration()
    {
        try {
            $fb = self::getFb();
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl(route('customer.login.facebook'), $permissions);
            return htmlspecialchars($loginUrl);
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
            'app_id' => self::FACEBOOK_APP_ID,
            'app_secret' => self::FACEBOOK_APP_SECRET,
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