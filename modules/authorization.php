<?php

/**
 * Class AnxMonitoring_Authorization
 */
class AnxMonitoring_Authorization {

    /**
     * Simple token based authorization check
     *
     * @param $request
     * @return bool
     */
    public static function checkAccessToken($request) {
        $params = $request->get_params();

        // Access token must be configured
        if (!defined('ANX_MONITORING_ACCESS_TOKEN')) {
            return false;
        }

        // Access token must be configured
        if (!isset($params['ACCESS_TOKEN'])) {
            return false;
        }

        if ($params['ACCESS_TOKEN'] !== ANX_MONITORING_ACCESS_TOKEN) {
            return false;
        }

        return true;
    }

    /**
     * Returns a not authorized REST response
     *
     * @return WP_REST_Response
     */
    public static function notAuthorized() {
        return new WP_REST_Response(
            [
                'code' => 'rest_unauthorized',
                'message' => 'You are not authorized to do this',
                'data' => [
                    'status' => 401
                ]
            ],
            401
        );
    }
}