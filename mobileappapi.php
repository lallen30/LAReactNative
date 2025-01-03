<?php
require 'vendor/autoload.php';

use Firebase\JWT\JWT;

/**
 *ƒˇ
 * @wordpress-plugin
 * Plugin Name:       Mobile app API
 * Description:       All functions which is used in mobile app with JWT Auth.
 * Version:           1.0
 * Author:            Knoxweb
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
// include("custom_dwolla_api.php");
// include("zoomcash-api.php");

add_action('rest_api_init', function () {
    // Remove the old CORS headers
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');

    // Add new CORS headers
    add_filter('rest_pre_serve_request', function ($value) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        // Respond to OPTIONS requests with 200 OK
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400'); // 1 day
            header('Content-Type: text/plain charset=UTF-8');
            header('Content-Length: 0');
            exit(0);
        }
        return $value;
    });
}, 15);



function test_jwt_auth_expire($issuedAt)
{
    return $issuedAt + (62732 * 10000);
}

add_filter('jwt_auth_expire', 'test_jwt_auth_expire');
add_action('rest_api_init', function () {

    register_rest_route('mobileapi/v1', '/register', array(
        'methods' => 'POST',
        'callback' => 'MobileApiMakeNewAuthor',
    ));


    register_rest_route('mobileapi/v1/', '/GetMyMessages', array(
        'methods'   => 'GET',
        'callback'  => 'GetMyMessages',
    ));

    register_rest_route('mobileapi/v1', '/retrieve_password', array(
        'methods' => 'POST',
        'callback' => 'RetrivePassword',
    ));
    register_rest_route('mobileapi/v1', '/GetUserImage', array(
        'methods' => 'POST',
        'callback' => 'GetUserImage',
    ));
    register_rest_route('mobileapi/v1', '/validate_token', array(
        'methods' => 'POST',
        'callback' => 'validate_token',
    ));

    register_rest_route('mobileapi/v1', '/create_contact', array(
        'methods' => 'POST',
        'callback' => 'create_contact'
    ));

    register_rest_route('mobileapi/v1', '/updateProfile', array(
        'methods' => 'POST',
        'callback' => 'updateProfile',
    ));

    register_rest_route('mobileapi/v1', '/getProfile/', array(
        'methods' => 'GET',
        'callback' => 'getProfile'
    ));

    register_rest_route('mobileapi/v1', '/verify_otp/', array(
        'methods' => 'POST',
        'callback' => 'verify_otp'
    ));

    register_rest_route('mobileapi/v1', '/create_profile/', array(
        'methods' => 'POST',
        'callback' => 'create_profile'
    ));

    register_rest_route('mobileapi/v1', '/getprofile_data/', array(
        'methods' => 'GET',
        'callback' => 'getprofile_data'
    ));

    register_rest_route('mobileapi/v1', '/createpicture/', array(
        'methods' => 'POST',
        'callback' => 'createpicture'
    ));

    register_rest_route('mobileapi/v1', '/contact_us', array(
        'methods' => 'POST',
        'callback' => 'contact_us',
    ));

    register_rest_route('mobileapi/v1', '/updateUserInfo', array(
        'methods' => 'POST',
        'callback' => 'updateUserInfo',
    ));
    register_rest_route('mobileapi/v1', '/GetSetting', array(
        'methods' => 'POST',
        'callback' => 'GetSetting',
    ));

    register_rest_route('mobileapi/v1', '/transferMoney', array(
        'methods' => 'POST',
        'callback' => 'transferMoney',
    ));

    // used
    register_rest_route('mobileapi/v1', '/getAllUser', array(
        'methods' => 'POST',
        'callback' => 'getAllUser',
    ));



    register_rest_route('mobileapi/v1', '/get_transactions', array(
        'methods' => 'POST',
        'callback' => 'get_transactions_callback',
    ));



    register_rest_route('mobileapi/v1', '/save_onesignal_id/', array(
        'methods' => 'POST',
        'callback' => 'save_onesignal_id'
    ));
    register_rest_route('mobileapi/v1', '/requestStatusUpdate/', array(
        'methods' => 'POST',
        'callback' => 'requestStatusUpdate'
    ));
    register_rest_route('mobileapi/v1', '/transferToDebitOrBank/', array(
        'methods' => 'POST',
        'callback' => 'transferToDebitOrBank'
    ));

    register_rest_route('mobileapi/v1', '/searchFeedNews/', array(
        'methods' => 'GET',
        'callback' => 'searchFeedNews'
    ));


    register_rest_route('mobileapi/v1', '/addWalletWithBank', array(
        'methods' => 'POST',
        'callback' => 'addWalletWithBank',
    ));

    register_rest_route('mobileapi/v1', '/getuserdata/', array(
        'methods' => 'GET',
        'callback' => 'getuserdata'
    ));


    // Used

    register_rest_route('mobileapi/v1', '/giftCardVerification', array(
        'methods' => 'POST',
        'callback' => 'giftCardVerification',
    ));

    register_rest_route('mobileapi/v1', '/addGiftCardBalance', array(
        'methods' => 'POST',
        'callback' => 'addGiftCardBalance',
    ));



    register_rest_route('mobileapi/v1', '/sendMoneyFromWallet', array(
        'methods' => 'POST',
        'callback' => 'sendMoneyFromWallet_callback',
    ));
    register_rest_route('mobileapi/v1', '/addBankToConnectedAccount', array(
        'methods' => 'POST',
        'callback' => 'addBankToConnectedAccount',
    ));


    register_rest_route('mobileapi/v1', '/createEvent', array(
        'methods' => 'POST',
        'callback' => 'createEvent',
    ));

    register_rest_route('mobileapi/v1/', '/listEvents', array(
        'methods' => 'GET',
        'callback' => 'listEvents'
    ));

    register_rest_route('mobileapi/v1/', '/getEventById', array(
        'methods' => 'GET',
        'callback' => 'getEventById'
    ));

    register_rest_route('mobileapi/v1/', '/getSingleEventById', array(
        'methods' => 'GET',
        'callback' => 'getSingleEventById'
    ));

    register_rest_route('mobileapi/v1', '/addFeaturedImage/', array(
        'methods' => 'POST',
        'callback' => 'addFeaturedImage'
    ));

    register_rest_route('mobileapi/v1/', '/userEventsList', array(
        'methods' => 'GET',
        'callback' => 'userEventsList'
    ));

    register_rest_route('mobileapi/v1/', '/favouriteListing', array(
        'methods' => 'GET',
        'callback' => 'favouriteListing'
    ));

    register_rest_route('mobileapi/v1', '/getTermsPage', array(
        'methods' => 'GET',
        'callback' => 'getTermsPage',
    ));

    register_rest_route('mobileapi/v1', '/getTermsPublishedDate/', array(
        'methods' => 'GET',
        'callback' => 'getTermsPublishedDate'
    ));


    register_rest_route('mobileapi/v1', '/getPrivacyPage', array(
        'methods' => 'GET',
        'callback' => 'getPrivacyPage',
    ));

    register_rest_route('mobileapi/v1', '/getPrivacyPublishedDate/', array(
        'methods' => 'GET',
        'callback' => 'getPrivacyPublishedDate'
    ));

    register_rest_route('mobileapi/v1/', '/delete_card', array(
        'methods' => 'POST',
        'callback' => 'deleteCard',
    ));

    register_rest_route('mobileapi/v1/', '/deleteTokenOnLogut', array(
        'methods' => 'POST',
        'callback' => 'deleteTokenOnLogut'
    ));


    register_rest_route('mobileapi/v1/', '/forgotPassword', array(
        'methods' => 'POST',
        'callback' => 'forgotPassword'
    ));


    register_rest_route('mobileapi/v1/', '/validateOTP', array(
        'methods' => 'POST',
        'callback' => 'validateOTP'
    ));


    register_rest_route('mobileapi/v1/', '/updatePassword', array(
        'methods' => 'POST',
        'callback' => 'updatePassword'
    ));



    register_rest_route('mobileapi/v1', '/getUserConnectedAccount', array(
        'methods' => 'POST',
        'callback' => 'getUserConnectedAccount',
    ));



    register_rest_route('mobileapi/v1', '/add_card', array(
        'methods' => 'POST',
        'callback' => 'callback_add_card',
    ));
    register_rest_route('mobileapi/v1', '/get_cards', array(
        'methods' => 'POST',
        'callback' => 'callback_get_cards',
    ));
    register_rest_route('mobileapi/v1', '/delete_stripe_card', array(
        'methods' => 'POST',
        'callback' => 'callback_delete_stripe_card',
    ));
    register_rest_route('mobileapi/v1', '/update_card', array(
        'methods' => 'POST',
        'callback' => 'callback_update_card',
    ));

    register_rest_route('mobileapi/v1', '/get_aboutus', array(
        'methods' => 'POST',
        'callback' => 'callback_get_aboutus',
    ));
    register_rest_route('mobileapi/v1', '/verifyemail_and_send_otp', array(
        'methods' => 'POST',
        'callback' => 'verifyemail_and_send_otp_callback',
    ));

    register_rest_route('mobileapi/v1', '/saveSetting', array(
        'methods' => 'POST',
        'callback' => 'saveSetting',
    ));

    register_rest_route('mobileapi/v1', '/saveSettingfriendAccess', array(
        'methods' => 'POST',
        'callback' => 'saveSettingfriendAccess',
    ));

    register_rest_route('mobileapi/v1', '/getWalletBalance', array(
        'methods' => 'POST',
        'callback' => 'getWalletBalance',
    ));

    register_rest_route('mobileapi/v1', '/getEvents', array(
        'methods' => 'GET',
        'callback' => 'getEvents',
    ));

    register_rest_route('mobileapi/v1', '/getCalendarEvent', array(
        'methods' => 'GET',
        'callback' => 'getCalendarEvent',
    ));

    register_rest_route('mobileapi/v1', '/getnews_single', array(
        'methods' => 'GET',
        'callback' => 'getNewsSingle',
    ));

    register_rest_route('mobileapi/v1', '/pinResetToken', array(
        'methods' => 'POST',
        'callback' => 'pinResetToken',
    ));

    register_rest_route('mobileapi/v1/', '/GetMyNotifications', array(
        'methods'   => 'GET',
        'callback'  => 'GetMyNotifications',
    ));

    register_rest_route('mobileapi/v1/', '/CheckNewNotificationsDots', array(
        'methods'   => 'GET',
        'callback'  => 'CheckNewNotificationsDots',
    ));

    register_rest_route('mobileapi/v1', '/getAllPost/', array(
        'methods' => 'GET',
        'callback' => 'getAllPost'
    ));

    register_rest_route('mobileapi/v1', '/getPostsByCategories/', array(
        'methods' => 'GET',
        'callback' => 'getPostsByCategories'
    ));

    register_rest_route('mobileapi/v1', '/getSinglePost/', array(
        'methods' => 'GET',
        'callback' => 'getSinglePost'
    ));


    register_rest_route('mobileapi/v1/', '/GetMyMessages', array(
        'methods'   => 'POST',
        'callback'  => 'GetMyMessages',
    ));

    register_rest_route('mobileapi/v1/', '/GetOurMessages', array(
        'methods'   => 'GET',
        'callback'  => 'GetOurMessages',
    ));

    register_rest_route('mobileapi/v1/', '/SaveMessages', array(
        'methods'   => 'POST',
        'callback'  => 'SaveMessages',
    ));

    register_rest_route('mobileapi/v1/', '/delete_user', array(
        'methods'   => 'POST',
        'callback'  => 'delete_user',
    ));

    register_rest_route('mobileapi/v1/', '/get_ai_welcome', array(
        'methods'   => 'GET',
        'callback'  => 'get_ai_welcome',
    ));

    register_rest_route('mobileapi/v1/', '/get_ai_api_url', array(
        'methods'   => 'GET',
        'callback'  => 'get_ai_api_url',
    ));

    register_rest_route('mobileapi/v1/', '/ask_openai', array(
        'methods'   => 'POST',
        'callback'  => 'ask_openai',
    ));

    register_rest_route('mobileapi/v1/', '/ask_bluestoneai', array(
        'methods'   => 'POST',
        'callback'  => 'ask_bluestoneai',
    ));

    register_rest_route('mobileapi/v1/', '/save_ai_qna', array(
        'methods'   => 'POST',
        'callback'  => 'save_ai_qna',
    ));

    register_rest_route('mobileapi/v1/', '/get_ai_credentials', array(
        'methods'   => 'GET',
        'callback'  => 'get_ai_credentials',
    ));
});

function save_ai_qna($request)
{
    global $wpdb;

    $param = $request->get_params();

    $user_id = isset($param['user_id']) ? $param['user_id'] : 0;

    if (!empty($param)) {
        $reply = $param['answer'];
        $question = $param['question'];

        // Insert data into the database
        $table_name = $wpdb->prefix . 'openai_gpt_responses';
        $insert_result = $wpdb->insert($table_name, [
            'time' => current_time('mysql'),
            'user_id' => $user_id,
            'question' => sanitize_text_field($question),
            'response' => sanitize_text_field($reply),
        ]);

        if ($insert_result === false) {
            return new WP_REST_Response([
                'code' => 500,
                'status' => 'error',
                'error_code' => 'db_insert_error',
                'msg' => 'Error inserting data into the database.',
            ], 500);
        }

        return new WP_REST_Response([
            'code' => 200,
            'status' => 'ok',
            'msg' => 'Response generated successfully.',
            'question' => $question,
            'reply' => $reply,
        ], 200);
    } else {
        return new WP_REST_Response([
            'code' => 403,
            'status' => 'error',
            'error_code' => 'no_answer',
            'msg' => 'No answer received from the endpoint.',
        ], 403);
    }
}


function ask_bluestoneai($request)
{
    global $wpdb;

    $param = $request->get_params();

    $question = '';
    if (isset($param['question'])) {
        $question = is_array($param['question']) ? (isset($param['question']['text']) ? $param['question']['text'] : '') : $param['question'];
    }

    $user_id = isset($param['user_id']) ? $param['user_id'] : 0;

    // Prepare the payload to send to the /qna endpoint
    $body = json_encode([
        "question" => $question
    ]);

    $ai_api_url = get_option('bluestoneapps_ai_api_url', '');
    $endpoint = $ai_api_url . '/qna';
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTcwNDc0OTA0NiwianRpIjoiYWI5NzRhNDMtYzA3Mi00ZDg2LTkzZWYtNTE0NTVlZjAzZTdmIiwidHlwZSI6ImFjY2VzcyIsInN1YiI6InVzZXIiLCJuYmYiOjE3MDQ3NDkwNDYsImNzcmYiOiJjMWFmM2U2NS1lYzAxLTQzZGQtOWE1Ni1mZWIxOTRmNDgzNWMiLCJleHAiOjE3MDQ3NDk5NDZ9.V7ZxazjdZ7A2RFwYMRVWvBYzX4aWbNbaJL6L7lpdW_Y';

    // Use wp_remote_post to send the request
    $response = wp_remote_post($endpoint, [
        'body'        => $body,
        'headers'     => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ],
        'timeout'     => 45,
        'redirection' => 5,
        'blocking'    => true,
    ]);

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        return new WP_REST_Response([
            'code' => 500,
            'status' => 'error',
            'error_code' => 'http_request_failed',
            'msg' => "HTTP Request failed: $error_message",
        ], 500);
    }

    // Decode the response
    $response_body = json_decode(wp_remote_retrieve_body($response), true);

    if (!empty($response_body['answer'])) {
        $reply = $response_body['answer'];

        // Insert data into the database
        $table_name = $wpdb->prefix . 'openai_gpt_responses';
        $insert_result = $wpdb->insert($table_name, [
            'time' => current_time('mysql'),
            'user_id' => $user_id,
            'question' => sanitize_text_field($question),
            'response' => sanitize_text_field($reply),
        ]);

        if ($insert_result === false) {
            return new WP_REST_Response([
                'code' => 500,
                'status' => 'error',
                'error_code' => 'db_insert_error',
                'msg' => 'Error inserting data into the database.',
            ], 500);
        }

        return new WP_REST_Response([
            'code' => 200,
            'status' => 'ok',
            'msg' => 'Response generated successfully.',
            'question' => $question,
            'reply' => $reply,
        ], 200);
    } else {
        return new WP_REST_Response([
            'code' => 403,
            'status' => 'error',
            'error_code' => 'no_answer',
            'msg' => 'No answer received from the endpoint.',
        ], 403);
    }
}


function ask_openai($request)
{
    global $wpdb;

    $param = $request->get_params();

    $question = '';
    if (isset($param['question'])) {
        if (is_array($param['question'])) {
            // If 'question' is an object, extract the 'text' field
            $question = isset($param['question']['text']) ? $param['question']['text'] : '';
        } else {
            // If 'question' is a string
            $question = $param['question'];
        }
    }

    $user_id = isset($param['user_id']) ? $param['user_id'] : 0;

    $data = array(
        "code" => 200,
        "status" => "ok",
        "msg" => "Response generated successfully.",
        'error_code' => "",
        'user_id' => $user_id,
        'question' => $question
    );

    $table_name = $wpdb->prefix . 'openai_gpt_responses';
    $prompt = sanitize_text_field($question);
    $response = bluestoneapps_ai_generate_text($prompt);

    if (is_wp_error($response)) {
        // Handle the error appropriately
        $data['code'] = "500";
        $data['status'] = "error";
        $data['error_code'] = "openai_error";
        $data['msg'] = $response->get_error_message();
        return new WP_REST_Response($data, 500);
    }

    if (!empty($response['choices'][0]['message']['content'])) {
        $reply = $response['choices'][0]['message']['content'];

        // Insert data into database and check for errors
        $insert_result = $wpdb->insert($table_name, array(
            'time' => current_time('mysql'),
            'user_id' => $user_id,
            'question' => $prompt,
            'response' => $reply
        ));

        if ($insert_result === false) {
            // Handle the database error appropriately
            $data['code'] = "500";
            $data['status'] = "error";
            $data['error_code'] = "db_insert_error";
            $data['msg'] = "Error inserting data into the database.";
            return new WP_REST_Response($data, 500);
        }

        $data['reply'] = $reply;
        return new WP_REST_Response($data, 200);
    } else {
        $data['code'] = "403";
        $data['status'] = "error";
        $data['error_code'] = "no_reply";
        $data['msg'] = "No reply received from OpenAI.";
        return new WP_REST_Response($data, 403);
    }
}


function bluestoneapps_ai_generate_text($prompt)
{
    $api_key = trim(get_option('openai_gpt_api_key'));

    $stored_instructions = get_option('openai_gpt_high_level_instructions', '');
    $stored_instructions = stripslashes($stored_instructions);

    $api_url = 'https://api.openai.com/v1/chat/completions';

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => $stored_instructions],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 500,
        'temperature' => 0.5
    ];

    $args = [
        'body'    => json_encode($data),
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key
        ],
        'timeout' => 30
    ];

    error_log('Using API Key: ' . $api_key);
    error_log('Sending Request Data: ' . print_r($data, true));

    $response = wp_remote_post($api_url, $args);

    if (is_wp_error($response)) {
        error_log('API Request Error: ' . $response->get_error_message());
    } else {
        error_log('API Response: ' . print_r($response, true));
    }

    $body = wp_remote_retrieve_body($response);

    return json_decode($body, true);
}



function delete_user($request)
{
    $data  = array("code" => 200, "status" => "ok", "msg" => "User Successfully removed.", 'error_code' => "");

    $param = $request->get_params();
    $user_id = $param['user_id'];

    require_once(ABSPATH . 'wp-admin/includes/user.php');

    // Check if the user exists
    if (!get_userdata($user_id)) {
        $data['code'] = "403";
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "User does not exist.";
        return new WP_REST_Response($data, 403);
    } else {

        // Delete the user and their meta data
        wp_delete_user($user_id, true);

        return new WP_REST_Response($data, 200);
    }
}

function callback_get_aboutus($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $aboutus_page_id = 7;
    $result = get_post($aboutus_page_id);

    if ($result) {
        // Process the post content to ensure Beaver Builder shortcodes and content filters are applied
        $content = apply_filters('the_content', $result->post_content);
        $content = do_shortcode($content);

        // Inline CSS and JS
        $css_urls = [
            'https://wordpress.betaplanets.com/wp-content/uploads/bb-plugin/cache/7-layout.css?ver=08b1a5c19d42947c5912caa6b9d91b79',
            'https://wordpress.betaplanets.com/wp-content/themes/bb-theme/style.css?ver=6.4.3',
            'https://wordpress.betaplanets.com/wp-content/themes/bb-theme-child/dist/knoxweb-builder.min.css?ver=1.0'
        ];

        $js_urls = [
            'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
            'https://wordpress.betaplanets.com/wp-content/uploads/bb-plugin/cache/7-layout.js?ver=493380e2ae7f8c36afb704ddf7ca748e',
            'https://wordpress.betaplanets.com/wp-content/themes/bb-theme-child/dist/knoxweb-builder.min.js?ver=1.0'
        ];

        $styles = '';
        foreach ($css_urls as $css_url) {
            $styles .= "<link rel='stylesheet' href='$css_url' type='text/css' media='all' />";
        }

        $scripts = '';
        foreach ($js_urls as $js_url) {
            $scripts .= "<script src='$js_url'></script>";
        }

        $content = $styles . $content . $scripts;

        $data['pageData'] = $result;
        $data['aboutus_content'] = $content;
    } else {
        $data['code'] = 404;
        $data['status'] = "error";
        $data['msg'] = "Page not found.";
        $data['error_code'] = "page_not_found";
    }

    error_log(print_r($data, true)); // Log the response for debugging

    return new WP_REST_Response($data, $data['code']);
}


function CheckNewNotificationsDots($request)
{
    global $wpdb;
    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "", "notification" => false, "requests" => false, "news" => 0);
    $param = $request->get_params();
    $token = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($token);
    if ($user_id) {
        $notifications = $wpdb->get_results("select * from wp_jet_push_notification where user_id='" . $user_id . "' and status='0'", ARRAY_A);
        if (count($notifications) > 0) {
            $data['notification'] = true;
        }
        $requests = $wpdb->get_results("select * from Request_transfer where user_id='" . $user_id . "' and view_status='0'", ARRAY_A);
        if (count($requests) > 0) {
            $data['requests'] = true;
        }
        $data['news'] = wp_count_posts('news')->publish;
        return new WP_REST_Response($data, 200);
    }
    $data['status'] = "error";
    $data['error_code'] = "user_expire";
    $data['errormsg'] = "Something went wrong.";
    return new WP_REST_Response($data, 403);
}

function GetMyNotifications($request)
{
    global $wpdb;
    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "");
    $param = $request->get_params();
    $token = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($token);
    if ($user_id) {
        $user = get_userdata($user_id);
        $role = 'customer';
        if (in_array('barber', (array) $user->roles)) {
            $role = 'barber';
        } else {
            $role = $user->roles[0];
        }
        $where = ' where id > 0 ';
        if ($role == 'barber') {
            $data['view_type'] = 'barber';
            $where .= ' AND 	user_id=' . $user_id;
        } else {
            $where .= ' AND 	user_id=' . $user_id;
            $data['view_type'] = 'customer';
        }
        $data['q'] = "select * from wp_jet_push_notification $where ORDER BY id DESC";
        $notifications = $wpdb->get_results("select * from wp_jet_push_notification $where ORDER BY id DESC", ARRAY_A);
        $data['notifications'] = false;
        $notification = array();
        if (count($notifications) > 0) {
            foreach ($notifications as $b) {
                $user_sent = get_userdata($b['sent_by']);
                if (in_array('barber', (array) $user_sent->roles)) {
                    $b['from_user_name'] = get_user_meta($b['sent_by'], 'shop_name', true);
                } else {
                    $b['from_user_name'] = get_user_meta($b['sent_by'], 'first_name', true) . " " . get_user_meta($b['sent_by'], 'last_name', true);
                    if (trim($b['from_user_name']) == '') {
                        $b['from_user_name'] = get_user_meta($b['sent_by'], 'nickname', true);
                    }
                }

                $b['to_user_name'] = get_user_meta($b['user_id'], 'first_name', true) . " " . get_user_meta($b['user_id'], 'last_name', true);
                $b['to_user'] = $b['user_id'];
                if (trim($b['to_user_name']) == '') {
                    $b['to_user_name'] = get_user_meta($b['user_id'], 'nickname', true);
                }
                $useravatar = get_user_meta($b['sent_by'], 'simple_local_avatar', true);
                if ($useravatar) {
                    $img = wp_get_attachment_image_src($useravatar, array(
                        '150',
                        '150'
                    ), true);
                    $user_avatar = $img[0];
                    $b['from_user_name_img'] = $user_avatar;
                } else {
                    $b['from_user_name_img'] = 'http://1.gravatar.com/avatar/1aedb8d9dc4751e229a335e371db8058?s=96&d=mm&r=g';
                }
                $notification[] = $b;
            }
            $wpdb->update("wp_jet_push_notification", array("status" => 1), array("user_id" => $user_id));
            $data['notifications'] = $notification;
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['errormsg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}

function saveSettingfriendAccess($request)
{
    $data  = array("code" => 200, "status" => "ok", "msg" => "Setting saved!", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $friendAccess = $param['friendAccess'];
    if ($user_id) {
        update_user_meta($user_id, "friendAccess", $friendAccess);
        return new WP_REST_Response($data, 200);
    }
    $data['code'] = 403;
    $data['status'] = 'error';
    $data['msg'] = "Token is expired. Please login again";
    $data['error_code'] = "token_expired";
    return new WP_REST_Response($data, $data['code']);
}

function saveSetting($request)
{
    $data  = array("code" => 200, "status" => "ok", "msg" => "Setting saved!", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $is_pin = $param['is_pin'];
    $pin = $param['pin'];
    $oldpin = $param['oldpin'];
    if ($user_id) {
        $savedPin = get_user_meta($user_id, 'pin', true);
        if ($param['is_validate'] == true) {
            if ($pin != $savedPin) {
                $validation = ValidatePinAttempt($user_id, true);
                if ($validation) {
                    $data['force_reset'] = false;
                    $data['msg'] = "Pin not matched";
                    $data['error_code'] = "pin_error";
                    return new WP_REST_Response($data, 403);
                } else {
                    $data['force_reset'] = true;
                    $data['error_code'] = "pin_error";
                    $data['msg'] = "Your pin is blocked now , you need to reset it";
                    return new WP_REST_Response($data, 403);
                }
            }
        } else {
            if ($oldpin == '') {
                unset($param['token']);
                unset($param['oldpin']);
                foreach ($param as $key => $value) {
                    update_user_meta($user_id, $key, $value);
                    update_user_meta($user_id, "pin_attempt", 0);
                }
                update_user_meta($user_id, "pin", "");
                return new WP_REST_Response($data, 200);
            }

            if ($oldpin != $savedPin) {
                $validation = ValidatePinAttempt($user_id, true);
                if (!$validation) {
                    $data['force_reset'] = true;
                    $data['error_code'] = "pin_error";
                    $data['msg'] = "Your pin is blocked now , you need to reset it";
                    return new WP_REST_Response($data, 403);
                }
                $data['force_reset'] = true;
                $data['error_code'] = "pin_error";
                $data['msg'] = "Please provide correct OLD pin.";
                $data["user_id"] = $user_id;
                return new WP_REST_Response($data, 403);
            }
        }
        unset($param['token']);
        unset($param['oldpin']);
        update_user_meta($user_id, "pin", $param['pin']);
        update_user_meta($user_id, "pin_attempt", 0);
        unset($param['pin']);
        foreach ($param as $key => $value) {
            update_user_meta($user_id, $key, $value);
        }

        return new WP_REST_Response($data, 200);
    }
    $data['code'] = 403;
    $data['status'] = 'error';
    $data['msg'] = "Token is expired. Please login again";
    $data['error_code'] = "token_expired";
    return new WP_REST_Response($data, $data['code']);
}

function ValidatePinAttempt($user_id, $check = false)
{
    $pin_attempt = get_user_meta($user_id, 'pin_attempt', true);
    if ($pin_attempt >= 4) {
        return false;
    } elseif ($check) {
        $pin_attempt = $pin_attempt + 1;
        update_user_meta($user_id, "pin_attempt", $pin_attempt);
    }
    return true;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function pinResetToken($request)
{
    $data  = array("code" => 200, "status" => "ok", "msg" => "Email send to your registered email address.", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $is_pin = $param['is_pin'];
    $pin = $param['pin'];
    if ($user_id) {
        $the_user = get_user_by('id', $user_id);
        $opt_generate = generateRandomString(30);
        update_user_meta($user_id, "pin_reset_token", $opt_generate);
        $message = "<p>Please click here to reset your Zoom Pay security PIN <a href='" . site_url('/reset-pin/?token=' . $opt_generate) . "'>" . site_url('/reset-pin/?token=' . $opt_generate) . "</a></p>";
        sendEmail($the_user->user_email, "Pin Reset request", $message);
        //sendEmail("ajayphpstudy@gmail.com","Pin Reset request",$message);
        return new WP_REST_Response($data, 200);
    }
    $data['code'] = 403;
    $data['status'] = 'error';
    $data['msg'] = "Token is expired. Please login again";
    $data['error_code'] = "token_expired";
    return new WP_REST_Response($data, $data['code']);
}

function getEvents($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $month = $param['month'];
    $year = $param['year'];



    $sql_query = "
        SELECT
        bp.ID,
        bp.post_title,
        bp.post_content,
        bp_meta_event_date.meta_value as event_date,
        bp_meta_event_to_time.meta_value as event_to_time,
        bp_meta_event_from_time.meta_value as event_from_time,
        bp_meta_event_street_address.meta_value as event_street_address,
        bp_meta_event_apt_suite.meta_value as event_apt_suite,
        bp_meta_event_city.meta_value as event_city,
        bp_meta_event_state.meta_value as event_state,
        bp_meta_event_zip.meta_value as event_zip,
        bp_meta_event_longitude.meta_value as event_longitude,
        bp_meta_event_latitude.meta_value as event_latitude,
        bp_meta_event_price.meta_value as event_price
        FROM
        bluestoneapps_posts bp
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_date ON bp_meta_event_date.post_id = bp.ID AND bp_meta_event_date.meta_key = '_event_date'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_to_time ON bp_meta_event_to_time.post_id = bp.ID AND bp_meta_event_to_time.meta_key = '_event_to_time'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_from_time ON bp_meta_event_from_time.post_id = bp.ID AND bp_meta_event_from_time.meta_key = '_event_from_time'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_street_address ON bp_meta_event_street_address.post_id = bp.ID AND bp_meta_event_street_address.meta_key = '_event_street_address'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_apt_suite ON bp_meta_event_apt_suite.post_id = bp.ID AND bp_meta_event_apt_suite.meta_key = '_event_apt_suite'

        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_city ON bp_meta_event_city.post_id = bp.ID AND bp_meta_event_city.meta_key = '_event_city'

        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_state ON bp_meta_event_state.post_id = bp.ID AND bp_meta_event_state.meta_key = '_event_state'

        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_zip ON bp_meta_event_zip.post_id = bp.ID AND bp_meta_event_zip.meta_key = '_event_zip'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_longitude ON bp_meta_event_longitude.post_id = bp.ID AND bp_meta_event_longitude.meta_key = '_event_longitude'

        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_latitude ON bp_meta_event_latitude.post_id = bp.ID AND bp_meta_event_latitude.meta_key = '_event_latitude'
        LEFT JOIN
        bluestoneapps_postmeta bp_meta_event_price ON bp_meta_event_price.post_id = bp.ID AND bp_meta_event_price.meta_key = '_event_price'
        WHERE bp.post_status = 'publish'
        AND bp.post_type = 'bs_calendar_event'
        ORDER BY
        bp.post_date DESC";



    $listings = $wpdb->get_results($sql_query);
    if (count($listings) > 0) {
        $lists = array();
        foreach ($listings as $listing) {
            $content = apply_filters('the_content', $listing->post_content);
            $lists[] = array(
                'event_id' => $listing->ID,
                'event_title' => $listing->post_title,
                'event_content' => $content,
                'event_date' => $listing->event_date,
                'event_to_time' => $listing->event_to_time,
                'event_from_time' => $listing->event_from_time,
                'event_street_address' => $listing->event_street_address,
                'event_apt_suite' => $listing->event_apt_suite,
                'event_city' => $listing->event_city,
                'event_state' => $listing->event_state,
                'event_zip' => $listing->event_zip,
                'event_longitude' => $listing->event_longitude,
                'event_latitude' => $listing->event_latitude,
                'event_price' => $listing->event_price
            );
        }

        $data['listing'] = array_values($lists); // strip the keys and return just the values

        $data['status_code'] = 200;
        $data['month'] = $month;
        $data['year'] = $year;

        return new WP_REST_Response($data, 200);
    } else {
        $data['status_code'] = 201;
        $data['msg'] = 'No events found';
        $data['month'] = $month;
        $data['year'] = $year;

        return new WP_REST_Response($data, 201);
    }
}

function getNewsSingle($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $news_id = $param['news_id'];

    //$user_id = '22';


    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $table_name = $wpdb->prefix . "posts";
        $where_condition = " post_status='publish' AND ID ='$news_id' AND post_type='news'";
        $sql_query = "SELECT ID, post_title, post_content,   FROM $table_name WHERE $where_condition";
        $listings = $wpdb->get_results($sql_query);
        if (count($listings) > 0) {
            $feature_image = get_the_post_thumbnail_url($listings[0]->ID, 'full');
            $listingData['news_id'] = $listings[0]->ID;
            $listingData['news_title'] = $listings[0]->post_title;
            $listingData['news_fulldescription'] = $listings[0]->post_content;
            $listingData['news_datetime'] = $listings[0]->post_date;
            $data['status_code'] = 200;
            $data['listing'] = $listingData;
            return new WP_REST_Response($data, 200);
        } else {
            $data['status_code'] = 201;
            $data['msg'] = 'No news found';
            return new WP_REST_Response($data, 401);
        }
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
}

function getCalendarEvents($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $user_id = '22';


    // $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $page_no = (isset($param['page_no']) ? $param['page_no'] : 1);
        $max_num_pages = 5;
        $paged = ($page_no) ? $page_no : 1;
        $post_per_page = 5;
        $offset = ($paged - 1) * $post_per_page;
        $pagination = " LIMIT $offset,$post_per_page ";
        $where_condition = " post_status='publish' AND post_type='bs_calendar_event'";
        $listingData = $array;
        // Search for title and description

        if (isset($param['search'])) {
            $search = $param['search'];
            if (!empty($search)) {
                $where_condition .= " AND (post_title like '%$search%' OR post_content like '%$search%')";
            }
        }
        $order = "";
        $table_name = $wpdb->prefix . "posts";
        $sql_query = "SELECT *  FROM $table_name WHERE $where_condition ORDER BY post_date DESC $pagination";
        $listings = $wpdb->get_results($sql_query);
        if (count($listings) > 0) {
            foreach ($listings as $listing) {
                // print_r($arrayTerm);die;
                //print_r($param['category']);die;
                if (!empty($param['category'])) {
                    // $listingData = array();
                    $post_term = get_the_terms($listing->ID, 'news_categories');
                    $arrayTerm = array();
                    foreach ($post_term as $one) {
                        $arrayTerm[] = $one->term_id;
                        // print_r();die;
                    }
                    // /print_r($arrayTerm);die;
                    if (in_array($param['category'], $arrayTerm)) {
                        $feature_image = get_the_post_thumbnail_url($listing->ID, 'full');
                        $listingData['news_id'] = $listing->ID;
                        $listingData['news_title'] = $listing->post_title;
                        $listingData['post_excerpt'] = $listing->post_excerpt;
                        $listingData['post_content'] = $listing->post_content;
                        $listingData['feature_image'] = $feature_image;
                        $listingData['post_date'] = date('d M Y', strtotime($listing->post_date));
                        $lists[] = $listingData;
                    }
                } else {
                    // $listingData = array();
                    $feature_image = get_the_post_thumbnail_url($listing->ID, 'full');
                    $listingData['news_id'] = $listing->ID;
                    $listingData['news_title'] = $listing->post_title;
                    $listingData['post_excerpt'] = $listing->post_excerpt;
                    $listingData['post_content'] = $listing->post_content;
                    $listingData['feature_image'] = $feature_image;
                    $listingData['post_date'] = date('d M Y', strtotime($listing->post_date));
                    $lists[] = $listingData;
                }
            }
            $data['listing'] = $lists;
            $newsTerms = get_terms(array(
                'taxonomy' => 'news_categories',
                'hide_empty' => false,
            ));
            // print_r();die;

            $data['terms'] = $newsTerms;
            $data['status_code'] = 200;
            return new WP_REST_Response($data, 200);
        } else {
            $data['status_code'] = 201;
            $data['msg'] = 'No news found';
            return new WP_REST_Response($data, 201);
        }
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
} // Single news get

function callback_update_card($request)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $data  = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    if ($user_id) {
        global $wpdb, $helper_obj;
        $card_type = $param['card_type'];
        $card_id = $param['card_id'];
        $name = $param['name'];
        $expMonth = $param['expMonth'];
        $expYear = $param['expYear'];
        if ($expMonth > 12) {
            $data["status"]     = "error";
            $data["errormsg"]   = "Please provide valid month.";
            $data["error_code"] = "403";
        }
        if ($expYear < date('Y')) {
            $data["status"]     = "error";
            $data["errormsg"]   = "Please provide valid year.";
            $data["error_code"] = "403";
        }
        if ($expYear > date('Y') + 50) {
            $data["status"]     = "error";
            $data["errormsg"]   = "Please provide valid year.";
            $data["error_code"] = "403";
        }
        require_once('stripe/init.php');
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        try {
            if ($card_type == 'credit_card') {
                $stripe_customer_id = $helper_obj->get_stripe_customer_id($user_id);
                $update = \Stripe\Customer::updateSource($stripe_customer_id, $card_id, array(
                    'name'      => $name,
                    'exp_month' => $expMonth,
                    'exp_year'  => $expYear
                ));
            } else {
                $stripe_account_id = $helper_obj->get_stripe_account_id($user_id);
                $update = \Stripe\Account::updateExternalAccount($stripe_account_id, $card_id, array(
                    'name'      => $name,
                    'exp_month' => $expMonth,
                    'exp_year'  => $expYear
                ));
            }
            $data['cardInfo'] = json_decode(json_encode($update, true), true);
            $data['msg'] = "Card updated successfully.";
            return new WP_REST_Response($data, $data['code']);
        } catch (Stripe_CardError $e) {
            // $error[] = $e->getMessage();
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Stripe_CardError";
            return new WP_REST_Response($data, $data['code']);
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            // $error[] = $e->getMessage();
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Stripe_InvalidRequestError";
            return new WP_REST_Response($data, $data['code']);
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            // $error[] = $e->getMessage();
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Stripe_AuthenticationError";
            return new WP_REST_Response($data, $data['code']);
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            // $error[] = $e->getMessage();
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Stripe_ApiConnectionError";
            return new WP_REST_Response($data, $data['code']);
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            // $error[] = $e->getMessage();
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Stripe_Error";
            return new WP_REST_Response($data, $data['code']);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $data['code'] = 403;
            $data['status'] = 'error';
            $data['msg'] = $e->getMessage();
            $data['error_code'] = "Exception";
            return new WP_REST_Response($data, $data['code']);
        }
    } else {
        $data['code'] = 403;
        $data['status'] = 'error';
        $data['msg'] = "Token is expired. Please login again";
        $data['error_code'] = "token_expired";
        return new WP_REST_Response($data, $data['code']);
    }
}

function callback_delete_stripe_card($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    if ($user_id) {
        if (!isset($param['card_type']) || empty($param['card_type']) || !isset($param['card_id']) || empty($param['card_id'])) {
            $data['status'] = "error";
            $data['code']   = 403;
            $data['error_code'] = "missing_parameter";
            $data['msg'] = "Missing parameters(Card Type Or Card ID).";
            return new WP_REST_Response($data, $data['code']);
        }
        global $wpdb, $helper_obj;
        $card_id = $param['card_id'];
        $card_type = $param['card_type'];
        require_once('stripe/init.php');
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $stripe_customer_id = $helper_obj->get_stripe_customer_id($user_id);
        $stripe_account_id = $helper_obj->get_stripe_account_id($user_id);
        if ($card_type == 'credit_card') {
            try {
                \Stripe\Customer::deleteSource($stripe_customer_id, $card_id);
                $data['msg'] = "Card is removed successfully.";
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_CardError $e) {
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_CardError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_InvalidRequestError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_AuthenticationError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_ApiConnectionError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_Error';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Exception';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            }
        } elseif ($card_type == 'debit_card') {
            try {
                \Stripe\Account::deleteExternalAccount($stripe_account_id, $card_id);
                $data['msg'] = "Card is removed successfully.";
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_CardError $e) {
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_CardError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_InvalidRequestError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_AuthenticationError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_ApiConnectionError';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Stripe_Error';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $msg = $e->getMessage();
                $data['status'] = "error";
                $data['code']   = 403;
                $data['error_code'] = 'Exception';
                $data['msg'] = $msg;
                return new WP_REST_Response($data, $data['code']);
            }
        }
    } else {
        $data['status'] = "error";
        $data['code']   = 403;
        $data['error_code'] = "token_expired";
        $data['msg'] = "User token expired. Please login & try again.";
        return new WP_REST_Response($data, $data['code']);
    }
}

function callback_get_cards($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    if ($user_id) {
        global $wpdb, $helper_obj;
        $stripe_customer_id = $helper_obj->get_stripe_customer_id($user_id);
        $stripe_account_id = $helper_obj->get_stripe_account_id($user_id);
        require_once 'stripe/init.php';
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key"        => $secret_key,
            "publishable_key"   => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $debit_cards = array();
        $credit_cards = array();
        $bank_account = array();
        if ($stripe_customer_id) {
            try {
                $result1 = \Stripe\Customer::allSources($stripe_customer_id);
                $result1 = json_decode(json_encode($result1, true), true);
                $credit_cards = $result1['data'];
            } catch (Exception $e) {
                $data['credit_card_e'] = $e;
                $credit_cards = array();
                $data['credit_card_error'] = $e->getMessage();
            }
        }
        if ($stripe_account_id) {
            try {
                $result2 = \Stripe\Account::allExternalAccounts($stripe_account_id, [
                    'limit' => 100,
                    // 'object' => 'bank_account'
                    'object' => 'card'
                ]);
                $result2 = json_decode(json_encode($result2, true), true);
                $debit_cards = $result2['data'];
            } catch (Exception $e) {
                $debit_cards = array();
                // Something else happened, completely unrelated to Stripe
            }
            try {
                $result_bank = \Stripe\Account::allExternalAccounts($stripe_account_id, [
                    'limit' => 100,
                    'object' => 'bank_account'
                    //'object' => 'card'
                ]);
                $result2 = json_decode(json_encode($result_bank, true), true);
                $bank_account = $result_bank['data'];
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $bank_account = array();
            }
        }
        $data['debit_cards'] = $debit_cards;
        $data['bank_account'] = $bank_account;
        $data['credit_cards'] = $credit_cards;
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['code']   = 403;
        $data['error_code'] = "token_expired";
        $data['msg'] = "User token expired. Please login & try again.";
        return new WP_REST_Response($data, $data['code']);
    }
}

function callback_add_card($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    if ($user_id) {
        // exit;
        global $wpdb, $helper_obj;
        $card_token = $param['stripeToken'];
        require_once 'stripe/init.php';

        $userInfo = get_user_informations($user_id);
        $data['userInfo'] = $userInfo;
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $stripe_customer_id = get_user_meta($user_id, 'stripe_id', true);
        if (isset($param['card_type']) && !empty($param['card_type'])) {
            if ($param['card_type'] == 'credit_card') {
                if (!$stripe_customer_id) {
                    try {
                        $customer = \Stripe\Customer::create(array(
                            'email' => $userInfo['email'],
                            'name' => $userInfo['name'],
                            'source' => $card_token,
                        ));
                        update_user_meta($user_id, 'stripe_id', $customer->id);
                        $stripe_customer_id = $customer->id;
                        $data['msg'] = "Credit Card is added successfully.";
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_CardError $e) {
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_CardError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_InvalidRequestError $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_InvalidRequestError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_AuthenticationError $e) {
                        // Authentication with Stripe's API failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_AuthenticationError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_ApiConnectionError $e) {
                        // Network communication with Stripe failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_ApiConnectionError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_Error $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_Error';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Exception';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    }
                } else {
                    try {
                        $card = \Stripe\Customer::createSource($stripe_customer_id, ['source' => $card_token]);
                        $data['msg'] = "Card is added successfully.";
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_CardError $e) {
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_CardError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_InvalidRequestError $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_InvalidRequestError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_AuthenticationError $e) {
                        // Authentication with Stripe's API failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_AuthenticationError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_ApiConnectionError $e) {
                        // Network communication with Stripe failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_ApiConnectionError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_Error $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_Error';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Exception';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    }
                }
            } elseif ($param['card_type'] == 'debit_card') {
                $stripe_account_id = $helper_obj->get_stripe_account_id($user_id);
                if (!$stripe_account_id) {
                    $acct_data = [
                        "type" => "custom",
                        "country" => "US",
                        "email" => $userInfo['email'],
                        'metadata' => ['user_id' => $user_id, 'stripeid_cust_id' => $stripe_customer_id],
                        "external_account" => $card_token,
                        'capabilities' => [
                            'card_payments' => ['requested' => true],
                            'transfers' => ['requested' => true],
                        ],
                        'business_profile' => [
                            'mcc' => '7298',
                        ],
                        "tos_acceptance" => [
                            "date" => strtotime(date('d-m-Y')),
                            "ip" => $_SERVER['REMOTE_ADDR'],
                        ],
                        'settings' => [
                            'payouts' => [
                                'schedule' => [
                                    'interval' => 'manual',
                                ],
                            ],
                        ],
                    ];
                    try {
                        $data['acct_data'] = $acct_data;
                        $acct = \Stripe\Account::create($acct_data);
                        update_user_meta($user_id, 'stripe_account_id', $acct->id);
                        $stripe_account_id = $acct->id;
                        $data['msg'] = "Dabit Card is added successfully.";
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_CardError $e) {
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_CardError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_InvalidRequestError $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_InvalidRequestError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_AuthenticationError $e) {
                        // Authentication with Stripe's API failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_AuthenticationError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_ApiConnectionError $e) {
                        // Network communication with Stripe failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_ApiConnectionError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_Error $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_Error';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Exception';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    }
                } else {
                    try {
                        $card = \Stripe\Account::createExternalAccount($stripe_account_id, ['external_account' => $card_token]);
                        $data['msg'] = "Debit Card is added successfully.";
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_CardError $e) {
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_CardError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_InvalidRequestError $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_InvalidRequestError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_AuthenticationError $e) {
                        // Authentication with Stripe's API failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_AuthenticationError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_ApiConnectionError $e) {
                        // Network communication with Stripe failed
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_ApiConnectionError';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Stripe_Error $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Stripe_Error';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    } catch (Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        $msg = $e->getMessage();
                        $data['status'] = "error";
                        $data['code']   = 403;
                        $data['error_code'] = 'Exception';
                        $data['msg'] = $msg;
                        return new WP_REST_Response($data, $data['code']);
                    }
                }
            }
        }
    } else {
        $data['status'] = "error";
        $data['code']   = 403;
        $data['error_code'] = "token_expired";
        $data['msg'] = "User token expired. Please login & try again.";
        return new WP_REST_Response($data, $data['code']);
    }
}

function sendEmail($email, $subject, $text)
{

    $message = '<table width="600px" style="margin: 0 auto; border-collapse: collapse; border: 1px solid #dbdbdb;">
      <tr>
        <td>
           <table width="600" style="background: #000;">
            <tr>
              <td>
                 <img src="https://styletemplate.betaplanets.com/wp-content/uploads/2022/05/logo2.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding:50px 0;">
          <table width="600" style="background: #fff; border-collapse: collapse;">
             <tr>
              <td>
                <img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/gray-border.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
             <tr>
              <td style="padding:20px;">
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px; ">' . $text . '</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px; ">If you have any questions please contact us at support@zoompay.com</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Thanks,</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Zoom Pay Team</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100" style="background: #000; border-collapse: collapse;text-align:center;color:#fff;">
            <tr>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/apple.jpg" alt=""></a>
              </td>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/play.jpg" alt=""></a>                
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <img src="<img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/deco-line.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
            <tr>
              <td colspan="2" style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">
                <p style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">Copyright © 2021 Zoompay. All rights reserved. <br> You are receiving this mail bacause you opted in via our website.</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';

    //$message = "<p>Your otp is <strong> " . $secCode . " </strong></p>";

    $from_email = 'no-reply@knoxweb.com';

    //$to = $data['email'];

    //$subject = "Verify OTP Code";

    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    $headers .= 'From: ' . $from_email . "\r\n" .
        'Reply-To: ' . $from_email . "\r\n";


    wp_mail($email, $subject, $message, $headers);
}

// add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));

function updatePassword($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $password = $param['password'];

    $email = $param['email'];
    $test_user = get_user_by('email', $param['email']);
    if ($test_user != null) {
        wp_set_password($password, $test_user->ID);
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function validateOTP($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $otp = $param['otp'];

    $email = $param['email'];

    $test_user = get_user_by('email', $param['email']);
    $user = get_users(array(
        'meta_key' => 'user_otp',
        'meta_value' => $otp
    ));




    if (count($user) > 0) {
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "Otp Invalid.";
        $data["error_code"] = "otp_invalid";
        return new WP_REST_Response($data, 403);
    }
}

function forgotPassword($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $email = $param['email'];

    $test_user = get_user_by('email', $param['email']);

    /*$user_id = GetMobileAPIUserByIdToken($usertoken);

    if ($user_id)

    {*/
    if ($test_user != null) {
        $secCode = mt_rand(100000, 999999);
        update_user_meta($test_user->ID, 'user_otp', $secCode);
        $message = '<table width="600px" style="margin: 0 auto; border-collapse: collapse; border: 1px solid #dbdbdb;">
      <tr>
        <td>
           <table width="600" style="background: #000;">
            <tr>
              <td>
                 <img src="https://styletemplate.betaplanets.com/wp-content/uploads/2022/05/logo2.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding:50px 0;">
          <table width="600" style="background: #fff; border-collapse: collapse;">
            <tr>
              <td>
                <p style="font-family: "Poppins", sans-serif; font-size: 32px; font-weight: 700; color: #000; text-align: center; margin-bottom: 0; ">Hello !</p>
              </td>
            </tr>
             <tr>
              <td>
                <img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/gray-border.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
             <tr>
              <td style="padding:20px;">
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px; ">Your otp is <strong> ' . $secCode . ' </strong></p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px; ">If you have any questions please contact us at support@Zoompay.com</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Thanks,</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Zoompay Team</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100" style="background: #000; border-collapse: collapse;text-align:center;color:#fff;">
            <tr>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/apple.jpg" alt=""></a>
              </td>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/play.jpg" alt=""></a>                
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <img src="<img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/deco-line.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
            <tr>
              <td colspan="2" style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">
                <p style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">Copyright © 2021 Zoompay. All rights reserved. <br> You are receiving this mail bacause you opted in via our website.</p>
              </td>
            </tr>
             
          </table>
        </td>
      </tr>
    </table>';
        //$message = "<p>Your otp is <strong> " . $secCode . " </strong></p>";
        $from_email = 'no-reply@knoxweb.com';
        //$to = $data['email'];
        $subject = "Verify OTP Code";
        $headers = array(
            'Content-Type: text/html; charset=UTF-8'
        );
        $headers .= 'From: ' . $from_email . "\r\n" .
            'Reply-To: ' . $from_email . "\r\n";
        wp_mail($email, $subject, $message, $headers);
        $data["otp"] = $secCode;
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function searchFeedNews($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $string = $param['string'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    if ($user_id) {
        $query_args = array(
            's' => $string,
            'post_type' => 'news',
        );
        $wc_query = new WP_Query($query_args);
        if ($wc_query->have_posts()) :
            while ($wc_query->have_posts()) :
                $wc_query->the_post();
                global $post;
                $post_id = $post->ID;
                if ($post_id != 0) {
                    $feature_image = get_the_post_thumbnail_url($post_id, 'full');
                    $postData['news_id'] = $post_id;
                    $postData['news_title'] = $post->post_title;
                    $postData['news_shortdescription'] = $post->post_excerpt;
                    $postData['news_fulldescription'] = $post->post_content;
                    $postData['news_featured_image'] = $feature_image;
                    $postData['news_datetime'] = date('d M Y', strtotime($post->post_date));
                    $lists[] = $postData;
                }
            endwhile;
        endif;
        $data['posts'] = $lists;
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function transferToDebitOrBank($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $amount = $param['amount'];

    $status = $param['status'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id =40;


    if ($user_id) {
        require_once 'stripe/init.php';
        $data['msg'] = 'sucess';
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $stripe_destination_id = get_user_meta($user_id, 'stripe_account_id', true);
        $error = array();
        try {
            $balance = \Stripe\Balance::retrieve(
                ['stripe_account' => $stripe_destination_id]
            );
            $balance = $balance->available[0]->amount;
        } catch (Stripe_CardError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API

            $error[] = $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed

            $error[] = $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed

            $error[] = $e->getMessage();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send

            // yourself an email

            $error[] = $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe

            $error[] = $e->getMessage();
        }
        //print_r($balance);

        if (count($error) > 0) {
            $res['status'] = "error";
            $res['msg'] = join(',', $error);
            $res['error_code'] = "stripe_error";
            return new WP_REST_Response($res, 403);
        }
        if ($balance > 0) {
            try {
                $payout = \Stripe\Payout::create([
                    'amount' => 1000,
                    'currency' => 'usd',
                    'method' => 'instant',
                ], [
                    'stripe_account' => 'acct_1HKIN9JD3AiOJo0h',
                ]);
            } catch (Stripe_CardError $e) {
                $error[] = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API

                $error[] = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed

                $error[] = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed

                $error[] = $e->getMessage();
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send

                // yourself an email

                $error[] = $e->getMessage();
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe

                $error[] = $e->getMessage();
            }
            //print_r($balance);

            if (count($error) > 0) {
                $res['status'] = "error";
                $res['msg'] = join(',', $error);
                $res['error_code'] = "stripe_error";
                return new WP_REST_Response($res, 403);
            } else {
                $data['msg'] = "Balance transffered successfully!";
                return new WP_REST_Response($data, 200);
            }
        } else {
            $res['status'] = "error";
            $res['msg'] = "Insufficient Balance on stripe payout";
            $res['error_code'] = "stripe_error";
            return new WP_REST_Response($res, 403);
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function requestStatusUpdate($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $usertoken = $param['token'];
    $request_id = $param['request_id'];
    $status = $param['status'];
    $amount = $param['amount'];
    $receiver = (int)$param['receiver'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    // $user_id = 20;
    if ($user_id) {
        if ($status == "accept") {
            $wpdb->update('Request_transfer', array(
                'status' => $status
            ), array(
                'id' => $request_id
            ));
            sendPushServer($user_id, 'money_request_accept', 'Request Accepted', "Your request of $" . $amount . " is accpted!", $receiver, $request_id);
            $user = get_user_by('id', $receiver);
            $email = $user->user_email;
            $subject = 'Request Accepted';
            sendEmail($email, $subject, "Your request of $" . $amount . " is accpted!");
            //sendRequestedMoney($user_id,$receiver,$amount);
            return new WP_REST_Response($data, 200);
        } else {
            $first_name = get_user_meta($user_id, 'first_name', true);
            $last_name = get_user_meta($user_id, 'last_name', true);
            $name = $first_name . " " . $last_name;
            $wpdb->update('Request_transfer', array(
                'status' => $status
            ), array(
                'id' => $request_id
            ));
            sendPushServer($user_id, 'money_request_denied', 'Request Denied', $name . " had rejected your transfer", $receiver, $request_id);
            $user = get_user_by('id', $receiver);
            $email = $user->user_email;
            $subject = 'Request Denied';
            sendEmail($email, $subject, $name . " had rejected your transfer");
            return new WP_REST_Response($data, 200);
        }
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function save_onesignal_id($request)
{

    global $wpdb;

    $param = $request->get_params();

    $oneSignal = $param['oneSignID'];

    $token = $param['token'];

    $timezone = $param['timezone'];

    $param['status'] = "ok";

    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $row_pre_one = $wpdb->query("delete from wp_usermeta where meta_key='one_signal_id' and meta_value='" . $oneSignal . "' and user_id!='" . $user_id . "'");
        $row_pre_one2 = $wpdb->query("delete from wp_usermeta where meta_key='one_signal_id_android' and meta_value='" . $oneSignal . "' and user_id!='" . $user_id . "'");
        update_user_meta($user_id, 'last_app_update', date('Y-m-d h:i:s'));
        //$DeviceUdid
        @$type = $param['type'];
        if ($type == "android") {
            update_user_meta($user_id, 'one_signal_id_android', $oneSignal);
        } else {
            $type == "ios";
            update_user_meta($user_id, 'one_signal_id', $oneSignal);
        }
        // Manage Token with Devices

        $res = $wpdb->get_row("select * from wp_user_devices where token='" . $oneSignal . "'");
        if (count($res) > 0) {
            $wpdb->query("UPDATE `wp_user_devices` SET `type` = '" . $type . "',`user_id` = '" . $user_id . "',`timezone` = '" . $timezone . "' WHERE `wp_user_devices`.`token` = '" . $oneSignal . "';");
        } else {
            $wpdb->insert("wp_user_devices", array(
                'user_id' => $user_id,
                'token' => $oneSignal,
                'type' => $type,
                "timezone" => $timezone
            ));
        }
        if ($timezone != '') {
            update_user_meta($user_id, 'time_zone', $timezone);
        }
        return new WP_REST_Response($param, 200);
    } else {
        $param['status'] = "error";
        $param['error_code'] = "user_expire";
        return new WP_REST_Response($param, 403);
    }
}

function sendPushServer($user_id = null, $type = null, $msg = null, $title = null, $touser, $post_id = null)
{
    global $wpdb;
    if ($touser != $user_id && $touser != 0) {
        $query = "SELECT * FROM wp_user_devices WHERE user_id='" . $touser . "' and status = 1";
        $token = array();
        $results = $wpdb->get_results($query);
        // print_r($results);
        foreach ($results as $data) {
            $token[] = $data->token;
        }
        //print_r($token);
        if (count($token) > 0) {
            if (is_array($post_id)) {
                $insert = $wpdb->insert('wp_jet_push_notification', array(
                    'user_id'   => $touser,
                    'date'      => date("F j, Y H:i:s"),
                    'title'     => $title,
                    'message'   => $msg,
                    'type'      => $type,
                    'post_id'   => $post_id['request_id'],
                    'from'      => 'request',
                    'status'    => '0',
                    'sent_by'   => $user_id,
                ));
                $data = array(
                    'type' => $type,
                    "data_noti" => $post_id
                );
            } else {
                $insert = $wpdb->insert('wp_jet_push_notification', array( //rj
                    'user_id'   => $touser,
                    'date'      => date("F j, Y H:i:s"),
                    'title'     => $title,
                    'message'   => $msg,
                    'type'      => $type,
                    'post_id'   => $post_id,
                    'from'      => 'request',
                    'status'    => '0',
                    'sent_by'   => $user_id,
                ));
                $data = array(
                    'type'      => $type,
                    "request_id" => $post_id
                );
            }
            if ($type == 'money_received') {
                sendMessageNewSound($msg, $token, $data, $title);
            } else {
                sendMessage($msg, $token, $data, $title);
            }
        }
    }
}

function sendMessageNewSound($msgData, $device_token, $data, $title)
{

    $content = array(
        "en" => $msgData
    );

    $heading = array(
        "en" => $title
    );

    $fields = array(
        'app_id' => "ae7e1dd2-ca8c-478b-894b-85329418ec01",
        'data' => $data,
        'contents' => $content,
        'headings' => $heading,
        'include_player_ids' => $device_token,
        'ios_sound' => 'cashreg.wav',
        'sound' => "cashreg.wav"

    );

    $fields = json_encode($fields);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NmYzM2U3MDQtNzFiOC00OGI1LWJmYWYtZjMxMTk0MGZlOTU5'
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HEADER, false);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

function sendMessage($msgData, $device_token, $data, $title)
{
    $content = array(
        "en" => $msgData
    );
    $heading = array(
        "en" => $title
    );
    $fields = array(
        'app_id'    => "ae7e1dd2-ca8c-478b-894b-85329418ec01",
        'data'      => $data,
        'contents'  => $content,
        'headings'  => $heading,
        'include_player_ids' => $device_token,
    );
    $fields = json_encode($fields);
    /*print("\nJSON sent:\n");
    print($fields);*/
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NmYzM2U3MDQtNzFiOC00OGI1LWJmYWYtZjMxMTk0MGZlOTU5'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function get_transactions_callback($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $usertoken = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    // $user_id = 40;
    if ($user_id) {
        $wallet_balance = get_user_meta($user_id, 'wallet_balance', true);
        global $helper_obj;
        $wallet_balance = $helper_obj->get_wallet_balance($user_id);
        if ($wallet_balance == '') {
            $data['wallet_balance'] = 0.00;
        } else {
            $data['wallet_balance'] = money_format('%i', $wallet_balance);
        }
        //Add Pagination
        $page_no = (isset($param['page_no']) ? $param['page_no'] : 1);
        $max_num_pages = 5;
        $paged = ($page_no) ? $page_no : 1;
        $post_per_page = 8;
        $offset = ($paged - 1) * $post_per_page;
        $pagination = " LIMIT $offset,$post_per_page ";
        //Add Pagination
        // $wallet_transactions = "SELECT * FROM transfer_transaction wtt WHERE wtt.user_id = '$user_id'  order by created_at desc $pagination";
        $wallet_transactions = "SELECT *  FROM wp_ewallet as we INNER JOIN transfer_transaction as tt ON  we.user_id = tt.user_id WHERE tt.user_id = '$user_id' order by created_at desc $pagination";
        $data['wallet_transactions'] = $wallet_transactions;
        $wallet_transactions = $wpdb->get_results($wallet_transactions);
        if (count($wallet_transactions) > 0) {
            $arrayData = array();
            foreach ($wallet_transactions as $wallet_transaction) {
                // $data['history_get'] = $wallet_transaction;
                $oneArray = array();
                $oneArray['id'] = $wallet_transaction->id;
                $oneArray['history_get'] = $wallet_transaction;
                $oneArray['user_id'] = $wallet_transaction->user_id;
                $oneArray['to_user'] = $wallet_transaction->to_user;
                $oneArray['balance'] = money_format('%i', $wallet_transaction->balance);
                $oneArray['transaction_id'] = $wallet_transaction->transaction_id;
                if ($oneArray['user_id'] == $user_id) {
                    $oneArray['other_userInfo'] = get_user_informations($oneArray['to_user']);
                } else {
                    $oneArray['other_userInfo'] = get_user_informations($oneArray['user_id']);
                }
                $oneArray['type'] = $wallet_transaction->type;
                if ($wallet_transaction->to_user == $user_id) {
                    $oneArray['status'] = 1;
                } else {
                    $oneArray['status'] = $wallet_transaction->status;
                }
                // $usaTypeTime = date('h:i A', strtotime( $wallet_transaction->created_at ) );
                $usaTypeDate = date('m-d-Y h:i A', strtotime($wallet_transaction->created_at));
                // $oneArray['created_at'] = $wallet_transaction->created_at;
                $oneArray['created_at'] = $usaTypeDate;
                $oneArray['updated_at'] = $wallet_transaction->updated_at;

                $arrayData[] = $oneArray;
            }
            $data['total_transactions'] = count($arrayData);
            $data['transactions'] = $arrayData;
        } else {
            $data['transactions'] = null;
        }
        $data['status_code'] = 200;
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function getWalletBalance($request)
{
    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "");
    $param = $request->get_params();
    $usertoken = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    if ($user_id) {
        global $wpdb;
        // $data['select'] = $select = "Select SUM(balance) as wallet_balance from wp_ewallet where user_id='$user_id'";
        // $wallet_balance = $wpdb->get_var($select);

        global $helper_obj;
        $wallet_balance = $helper_obj->get_wallet_balance($user_id);
        $data['wallet_balance'] = $wallet_balance;
        return new WP_REST_Response($data, 200);
    }
    $data["status"] = "error";
    $data["errormsg"] = "user not found.";
    $data["error_code"] = "user_expire";
    return new WP_REST_Response($data, 403);
}

function getAllUser($request)
{
    // global $wpdb;
    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "");
    $param = $request->get_params();
    $usertoken = $param['token'];
    $search_keywords = $param['search_keywords'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    if ($user_id) {
        global $dwolla_obj, $helper_obj, $wpdb;
        $include_user_ids = array();
        if ($search_keywords == '') {
            $selectUseridto_Query = "SELECT to_user_id FROM `transfer_transaction` where user_id='" . $user_id . "' and to_user_id!=0 and payment_status='1' ORDER BY `id` DESC";
            $selectUseridto_results = $wpdb->get_results($selectUseridto_Query, ARRAY_A);
            if (count($selectUseridto_results) > 0) {
                foreach ($selectUseridto_results as $sUR) {
                    $include_user_ids[] = $sUR['to_user_id'];
                }
            }

            $selectUserid_Query = "SELECT user_id FROM `transfer_transaction` where to_user_id='" . $user_id . "' and payment_status='1' ORDER BY `id` DESC";
            $selectUserid_results = $wpdb->get_results($selectUserid_Query, ARRAY_A);
            if (count($selectUserid_results) > 0) {
                foreach ($selectUserid_results as $sUR) {
                    $include_user_ids[] = $sUR['user_id'];
                }
            }
        }
        //return new WP_REST_Response(array_unique(), 200);





        // Pagination
        $max_num_pages = 5;
        $paged = (isset($param['page_no']) && !empty($param['page_no'])) ? $param['page_no'] : 1;
        $post_per_page = 10;
        $offset = ($paged - 1) * $post_per_page;
        $inner_joins = "";
        $wheres = "";
        if (isset($param['search_keywords']) && !empty($param['search_keywords'])) {
            // $meta_query = array('relation' => 'OR');

            $inner_joins .= " INNER JOIN wp_usermeta um2 ON (u1.ID = um2.user_id) ";
            $inner_joins .= " INNER JOIN wp_usermeta um3 ON (u1.ID = um3.user_id) ";
            $wheres .= " AND (";
            $wheres .= " (u1.user_email='$search_keywords') OR (u1.display_name='$search_keywords') ";
            $wheres .= " OR (um2.meta_key = 'first_name' && um2.meta_value='$search_keywords') OR (um2.meta_key = 'last_name' && um2.meta_value='$search_keywords')";
            $wheres .= " OR (um3.meta_key = 'zoompay_marker' && um3.meta_value='$search_keywords')";
            $wheres .= ")";
        }
        $in_user_ids = array(1);
        $in_user_ids[] = $user_id;
        $str = implode(',', $include_user_ids);
        $str_2 = implode(',', $in_user_ids);
        if ($search_keywords != '') {
            $select = "SELECT DISTINCT u1.* FROM `wp_users` u1 INNER JOIN wp_usermeta um1 ON (u1.ID = um1.user_id) $inner_joins WHERE  u1.ID NOT IN ($str_2) $wheres ORDER BY ID ASC LIMIT $offset,$post_per_page";
        } else {
            if (count($include_user_ids) > 0) {
                $select = "SELECT DISTINCT u1.* FROM `wp_users` u1 INNER JOIN wp_usermeta um1 ON (u1.ID = um1.user_id) $inner_joins WHERE u1.ID IN ($str) AND u1.ID NOT IN ($str_2)  ORDER BY ID ASC LIMIT $offset,$post_per_page";
            } else {
                $data['users'] = array();
                return new WP_REST_Response($data, 200);
            }
        }
        $data['select'] = $select;
        $result = $wpdb->get_results($select, ARRAY_A);
        $all_users = array();
        foreach ($result as $user) {
            $userInfo = array();
            $friendAccess = get_user_meta($user['ID'], 'friendAccess', true);
            if ($friendAccess == "no") {
            } else {
                $userInfo = get_user_informations($user['ID']);
                $userdata = get_userdata($user['ID']);
                if ($userInfo['first_name'] == '') {
                    $userInfo['display_name'] = $userdata->display_name;
                } else {
                    $userInfo['display_name'] = $userInfo['first_name'] . " " . $userInfo['last_name'];
                }
                $userInfo['marker'] = get_user_meta($user['ID'], 'zoompay_marker', true);
                $all_users[] = $userInfo;
            }
        }
        // $data['user'] = $userD;
        $data['users'] = (array)$all_users;
        return new WP_REST_Response($data, 200);
    } else {
        $data["status"] = "error";
        $data["errormsg"] = "user not found.";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, 403);
    }
}

function addBalance($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $amount = $param['amount'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id = 40;


    if ($user_id) {
        $data['status'] = "ok";
        $data['payment'] = '';
        $data['msg'] = '';
        require_once 'stripe/init.php';
        $data['msg'] = 'sucess';
        $card_id = $param['card_id'];
        //$card_id = "card_1HKIMrL7z4XD4IUQI1pPwZjL";

        $stripe_customer_id = get_user_meta($user_id, 'stripe_id', true);
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        //echo $customerid;

        try {
            $charge = \Stripe\Charge::create(array(
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $card_id,
                'capture' => $capture,
                'customer' => $stripe_customer_id,
            ));
        } catch (Stripe_CardError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API

            $error[] = $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed

            $error[] = $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed

            $error[] = $e->getMessage();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send

            // yourself an email

            $error[] = $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe

            $error[] = $e->getMessage();
        }
        if (count($error) == 0) {
            $data['msg'] = "Balance added successfully";
            return new WP_REST_Response($data, 200);
        } else {
            $data['status'] = "error";
            $data['msg'] = join(",", $error);
            return new WP_REST_Response($data, 403);
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}

function GetSetting($request)
{
    global $wpdb, $helper_obj;
    $data = array("code" => 200, "status" => "ok", "errormsg" => "",  'error_code' => "");
    $param = $request->get_params();
    $secret_key = get_option('options_secret_key');
    $publishable_key = get_option('options_publisher_key');


    $add_to_wallet_fees = get_option('options_add_to_wallet_fees');
    $transfer_to_user_fees = get_option('options_transfer_to_user_fees');
    $withdrawal_fees = get_option('options_withdrawal_fees');

    $data['add_to_wallet_fees'] = $add_to_wallet_fees;
    $data['transfer_to_user_fees'] = $transfer_to_user_fees;
    $data['withdrawal_fees'] = $withdrawal_fees;

    //   $secret_key = 'sk_test_51HHvw3ImftlG8CCc5Is3qNBr5wLzGiDsNYkpqsf8KQQSrSP1BkeBFUmZicw3serZmkigd1TjAulqFtN3O7OJUhAn0011281xMZ';
    $data['secret_key'] = $secret_key;
    $data['publishable_key'] = $publishable_key;
    $data['stripe_keys'] = array(
        'secret_key'        => $secret_key,
        'publishable_key'   => $publishable_key,
    );

    $data['stripe_account_id'] = '';
    if (isset($param['token']) && !empty($param['token'])) {
        $user_id = GetMobileAPIUserByIdToken($param['token']);
        if ($user_id) {
            require_once 'stripe/init.php';
            \Stripe\Stripe::setApiKey($secret_key);
            $stripe_account_id = $helper_obj->get_stripe_account_id($user_id);
            if ($stripe_account_id != false) {
                // $stripe_account_id = 'acct_1JjI9XRRTs58vhPH';
                $data['stripe_account_id'] = $stripe_account_id;
                // $data['stripe_accountInfo'] = $helper_obj->stripeObj->accounts->retrieve($stripe_account_id, []);
                // \Stripe\Account::retrieve('acct_1JZU5YREchrFCNYZ');
                $data["account_added"] = true;
                try {
                    $data['stripe_accountInfo'] = \Stripe\Account::retrieve($stripe_account_id);
                    $account_links = \Stripe\AccountLink::create(array(
                        'account'       => $stripe_account_id,
                        'refresh_url'   => site_url() . '/stripe-connect/update_kyc.php',
                        'return_url'    => site_url() . '/stripe-connect/thankyou.php',
                        'type'          => 'account_onboarding',
                        'collect'       => 'eventually_due',
                    ));
                    // print_r($account_links);
                    $account_links = json_decode(json_encode($account_links, true), true);
                    $data['kyc_url'] = $account_links['url'];
                } catch (Exception $e) {
                    // print_r($e);
                    $data['e'] = $e->getMessage();
                }
            } else {
                $data["account_added"] = false;
            }
            $data['stripe_account_id'] = $stripe_account_id;
        }
    }

    return new WP_REST_Response($data, 200);
}

function updateUserInfo($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $key = $param['key'];

    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        update_user_meta($user_id, 'setting', $key);
        return new WP_REST_Response($data, 200);
    } else {
        $data = array(
            "status" => "error",
            "errormsg" => "user token expired",
            'error_code' => "user_expire"
        );
        return new WP_REST_Response($data, 403);
    }
}

function getProfile($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $param = $request->get_params();
    $user_id = GetMobileAPIUserByIdToken($param['token']);
    if ($user_id) {
        global $helper_obj;
        $loginInfo = get_user_informations($user_id);
        $loginInfo['token'] = $param['token'];
        $validation = ValidatePinAttempt($user_id, false);
        $loginInfo['pin_blocked'] = false;
        if (!$validation) {
            $loginInfo['pin_blocked'] = true;
        }
        $data['loginInfo'] = $loginInfo;
        return new WP_REST_Response($data, $data['code']);
    } else {
        $data["code"] = 403;
        $data["status"] = "error";
        $data["msg"] = "Token is expired. Please login again";
        $data['error_code'] = "token_expired";
        return new WP_REST_Response($data, $data['403']);
    }
}







function create_contact($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();
    $token = $param['token'];

    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $new_post = array(
            'post_title' => "Request From " . $param['name'],
            'post_content' => $param['post_content'],
            'post_status' => 'publish',
            'post_author' => $user_id,
            'post_type' => 'services_request',
            'post_category' => array(
                0
            )
        );
        $post_id = wp_insert_post($new_post);
        if ($post_id) {
            $data['post'] = $post_id;
            update_post_meta($post_id, "name", $param['name']);
            update_post_meta($post_id, "email", $param['email']);
            update_post_meta($post_id, "contact_number", $param['contact_number']);
            update_post_meta($post_id, "message", $param['post_content']);
            update_post_meta($post_id, "service", $param['service']);
            return new WP_REST_Response($data, 200);
        } else {
            $data['post'] = $new_post;
            $data['errormsg'] = "Conatct not created, something went wrong.";
            return new WP_REST_Response($data, 403);
        }
    } else {
        $data = array(
            "status" => "error",
            "errormsg" => "user token expired",
            'error_code' => "user_expire"
        );
    }

    return new WP_REST_Response($data, 403);
}

function submitComment($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $post_id = $param['post_id'];

    $comment = $param['comment'];

    $user_id = GetMobileAPIUserByIdToken($token);

    if (!$user_id) {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid token');
        $data['error_code'] = "invalid_token";
        return new WP_REST_Response($data, 403);
    }

    // get user by user id


    $user_temp = get_user_by('ID', $user_id);

    $user = $user_temp->data;

    if (empty($user)) {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid user');
        $data['error_code'] = "invalid_user";
        return new WP_REST_Response($data, 403);
    }

    // check if comment and post id exist


    if ($comment == '' || $post_id == '') {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request');
        $data['error_code'] = "invalid_request";
        return new WP_REST_Response($data, 403);
    }

    $args = array(
        'comment_post_ID' => $post_id,
        'comment_author' => $user->user_login,
        'comment_author_email' => $user->user_email,
        'comment_author_url' => 'http://',
        'comment_content' => $comment,
        'comment_type' => '',
        //'comment_parent' => 0,

        'user_id' => $user->ID,
        'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        'comment_date' => current_time('mysql'),
        'comment_approved' => 1,

    );

    //print_r($args); exit;


    if (wp_insert_comment($args)) {
        $data = array(
            "status" => "ok",
            "msg" => "comment submitted successfully",
            "errormsg" => "",
            'error_code' => ""
        );
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Comment could not be submitted');
        $data['error_code'] = "invalid_request";
        return new WP_REST_Response($data, 403);
    }
}



function validate_token($request)

{

    $param = $request->get_params();

    $token = $param['token'];

    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $res['status'] = "ok";
        return new WP_REST_Response($res, 200);
    } else {
        $res['status'] = "error";
        $res['msg'] = "Your session expired, please login again";
        return new WP_REST_Response($res, 200);
    }
}

// Create new user


function MobileApiMakeNewAuthor($request)
{
    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "");
    $param = $request->get_params();
    $user_name = $param['email'];
    $user_email = $param['email'];
    $password = $param['password'];

    $first_name = $param['first_name'];
    $last_name = $param['last_name'];
    $user_nicename = $param['first_name'] . " " . $param['last_name'];
    $display_name = $param['first_name'] . " " . $param['last_name'];

    $project = $param['project'];
    $company = $param['company'];


    if (!is_email($user_email)) {
        $data['status'] = "error";
        $data['errormsg'] = __('This is not a Valid Email.');
        $data['error_code'] = "invalid_email";
        return new WP_REST_Response($data, 403);
    }

    $user_id = username_exists($user_name);
    if ($password == " ") {
        $data['status'] = "error";
        $data['errormsg'] = __('Please provide password.');
        $data['error_code'] = "password_blank";
        return new WP_REST_Response($data, 403);
    }

    $is_email_verfied = false;
    if (isset($param['sent_opt']) && !empty($param['sent_opt']) && isset($param['user_otp']) && !empty($param['user_otp'])) {
        if ($param['sent_opt'] != $param['user_otp']) {
            $data['code'] = 403;
            $data['status'] = "error";
            $data['msg'] = "OTP is not match. Try Again";
            $data['error_code'] = "otp_not_match";
            return new WP_REST_Response($data, $data['code']);
        } else {
            $is_email_verfied = true;
        }
    }

    if (!$user_id and email_exists($user_email) == false) {
        //$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_id = wp_create_user($user_name, $password, $user_email);
        $user = new WP_User($user_id);
        $user->set_role('subscriber');
        update_user_meta($user_id, 'first_name', $first_name);
        update_user_meta($user_id, 'last_name', $last_name);
        update_user_meta($user_id, 'user_create_profile_flag', 0);
        update_user_meta($user_id, 'is_email_verfied', $is_email_verfied);
        if (isset($param['accept_terms_conditions']) && !empty($param['accept_terms_conditions'])) {
            $accept_terms_conditions = $param['accept_terms_conditions'];
        }
        update_user_meta($user_id, 'accept_terms_conditions', $accept_terms_conditions);

        wp_update_user(array(
            'ID' => $user_id,
            'user_nicename' => $user_nicename,
            'display_name' => $display_name,
        ));

        $data["msg"] = "User registered successfully.";
        $loginInfo["user_id"]   = $user_id;
        $loginInfo['user_email'] = $user_email;
        $loginInfo['email'] = $user_email;
        $loginInfo['phone'] = "";
        $loginInfo['join_year'] = "";
        $loginInfo['last_name'] = $last_name;
        $loginInfo['first_name'] = $first_name;
        $loginInfo['name'] = $display_name;
        $loginInfo['display_name'] = $display_name;
        $loginInfo['roles'][] = 'subscriber';
        $loginInfo['role'] = 'player';
        $loginInfo['join_year'] = date('Y-m-d H:i:s');
        $loginInfo['user_avatar'] = "https://secure.gravatar.com/avatar/0d064948369d58f8675f464f26a7b2b4?s=96&d=mm&r=g";
        $loginInfo['phone'] = "";
        $loginInfo['street1'] = "";
        $loginInfo['street2'] = "";
        $loginInfo['city'] = "";
        $loginInfo['state'] = "";
        $loginInfo['zipcode'] = "";
        $loginInfo['dob'] = "";
        $loginInfo['about'] = "";
        $loginInfo['setting'] = "";
        $loginInfo['city_state'] = "";
        $loginInfo['token'] = generate_token($user_name, $password);

        $data["loginInfo"] = $loginInfo;

        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Account exists with this email.');
        $data['status_code'] = 201;
        $data['error_code'] = "user_already";
        return new WP_REST_Response($data, 403);
    }
}

function verifyemail_and_send_otp_callback($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $param = $request->get_params();
    $user_name = $param['email'];
    $user_email = $param['email'];
    $password = $param['password'];

    if (!is_email($user_email)) {
        $data['status'] = "error";
        $data['msg'] = __('This is not a Valid Email.');
        $data['error_code'] = "invalid_email";
        return new WP_REST_Response($data, 403);
    }

    if ($password == " ") {
        $data['status'] = "error";
        $data['msg'] = __('Please provide password.');
        $data['error_code'] = "password_blank";
        return new WP_REST_Response($data, 403);
    }

    $user_id = username_exists($user_name);
    if (!$user_id and email_exists($user_email) == false) {
        $opt_generate = mt_rand(1000, 9999);
        $message = "<p>Your otp is <strong> " . $opt_generate . " </strong></p>";
        $from_email = 'no-reply@knoxweb.com';
        //php mailer variables
        $subject = "Verify OTP Code";
        $headers = array(
            'Content-Type: text/html; charset=UTF-8'
        );
        $headers[] = 'From:' . $from_email . "\r\n" . 'Reply-To:' . $from_email . "\r\n";
        //Here put your Validation and send mail
        $data['email_results'] = wp_mail($user_email, $subject, $message, $headers);
        $data["otp"] = $opt_generate;
        $data["msg"] = "One-time password OTP(" . $opt_generate . ") is sent to the email address.";
        $data['step1'] = $param;
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['msg'] = __('Account exists with this email.');
        $data['code'] = 201;
        $data['error_code'] = "user_already";
        return new WP_REST_Response($data, 403);
    }
}

function user_id_exists($user)
{

    global $wpdb;

    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $user));

    if ($count == 1) {
        return true;
    } else {
        return false;
    }
}


function get_ai_credentials($request)
{

    $param = $request->get_params();
    // $data['ai_api_key'] =   get_option('options_ai_api_key');
    // $data['ai_api_url'] =  get_option('options_ai_api_url');
    // $data['chatGPTModel'] =   get_option('options_chatGPTModel');

    $data['bot_name'] =   get_field('bot_name', 'option');
    $data['home_content'] =   get_field('home_content', 'option');
    $data['subscribe_content'] =   get_field('subscribe_content', 'option');
    $data['intro_message'] =   get_option('openai_gpt_intro_message', '');
    $data['prompt'] =    get_option('high_level_instructions', '');

    $data['ai_token'] =   get_field('token', 'option');
    $data['ai_api_url'] =   get_option('bluestoneapps_ai_api_url', '');
    return successResponse('Api Credentials retrieve successfully', $data);
}


function GetMobileAPIUserByIdToken($token)
{
    $user_id = 0;
    if ($token) {
        try {
            $decoded = JWT::decode($token, JWT_AUTH_SECRET_KEY, array('HS256'));
            if (is_object($decoded) && isset($decoded->data) && isset($decoded->data->user) && isset($decoded->data->user->id)) {
                $user_id = $decoded->data->user->id;
            }
        } catch (Exception $e) {
            error_log('JWT decode error: ' . $e->getMessage());
        }
    }
    if (user_id_exists($user_id)) {
        return $user_id;
    } else {
        return 'not_found';
    }
}


// forgot password


function RetrivePassword($request)

{

    global $wpdb, $current_site;

    $data = array(
        "status" => "ok",
        "msg" => "you will be recieve login instructions."
    );

    $param = $request->get_params();

    $user_login = sanitize_text_field($param['user_login']);

    if (!is_email($user_login)) {
        $data = array(
            "status" => "error",
            "msg" => "Please provide valid email."
        );
        return new WP_REST_Response($data, 403);
    }

    if (empty($user_login)) {
        $data = array(
            "status" => "error",
            "msg" => "User email is empty."
        );
        return new WP_REST_Response($data, 403);
    } elseif (strpos($user_login, '@')) {
        $user_data = get_user_by('email', trim($user_login));
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    if (!$user_data) {
        $data = array(
            "status" => "error",
            "msg" => "User not found using email."
        );
        return new WP_REST_Response($data, 403);
    }

    // redefining user_login ensures we return the right case in the email


    $user_login = $user_data->user_login;

    $user_email = $user_data->user_email;

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if (!$allow) {
        $data = array(
            "status" => "error",
            "msg" => "Password reset not allowed."
        );
        return new WP_REST_Response($data, 403);
    } elseif (is_wp_error($allow)) {
        $data = array(
            "status" => "error",
            "msg" => "Something went wrong"
        );
        return new WP_REST_Response($data, 403);
    }

    //$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));


    // if ( empty($key) ) {


    // Generate something random for a key...


    $key = get_password_reset_key($user_data);

    $password = wp_generate_password(6, false);

    wp_set_password($password, $user_data->ID);

    // do_action('retrieve_password_key', $user_login, $key);


    // Now insert the new md5 key into the db


    //$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));


    // }
    $message = __('Hello ,') . "\r\n\r\n";

    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";

    //$message .= network_home_url( '/' ) . "\r\n\r\n";


    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";

    $message .= sprintf(__('New Password : %s'), $password) . "\r\n\r\n";

    //$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";


    $message .= __('Thank you') . "\r\n\r\n";

    // $message .= network_site_url("resetpass/?key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";


    /* <http://vipeel.testplanets.com/resetpass/?key=wDDY0rDxwfaWPOFZrrmf&login=ajaytest%40gmail.com> */

    if (is_multisite()) {
        $blogname = $GLOBALS['current_site']->site_name;
    } else

    // The blogname option is escaped with esc_html on the way into the database in sanitize_option


    // we want to reverse this for the plain text arena of emails.



    {
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    }

    $title = sprintf(__('[%s] Password Reset'), $blogname);

    $title = apply_filters('retrieve_password_title', $title);

    $message = apply_filters('retrieve_password_message', $message, $key);

    if ($message && !wp_mail($user_email, $title, $message)) {
        $data = array(
            "status" => "error",
            "msg" => "The e-mail could not be sent.."
        );
        return new WP_REST_Response($data, 403);
    }

    // wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );
    return new WP_REST_Response($data, 200);
}

//apply_filters('jwt_auth_token_before_dispatch', $data, $user);


add_filter('jwt_auth_token_before_dispatch', 'mobileapi_jwt_auth_token_before_dispatch', 10, 2);

function mobileapi_jwt_auth_token_before_dispatch($data, $user)
{
    $response = array("code" => 200, "status" => "ok", "msg" => "", "error_code" => "");
    // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    global $helper_obj;
    $user_id = $user->ID;
    $userData = json_decode(json_encode($user, true), true);
    $loginInfo = get_user_informations($user_id, $userData);
    $loginInfo['token'] = $data['token'];
    $response['loginInfo'] = $loginInfo;
    $response['msg'] = "You are login successfully.";
    return $response;
}

function GetUserImage($request)

{

    $param = $request->get_params();

    $token = $param['token'];

    $user_id = GetMobileAPIUserByIdToken($token);

    $useravatar = get_user_meta($user_id, 'simple_local_avatar', true);

    if ($useravatar) {
        $img = wp_get_attachment_image_src($useravatar, array(
            '150',
            '150'
        ), true);
        $data['user_avatar'] = $img[0];
    } else {
        $data['user_avatar'] = 'https://beaconapp.betaplanets.com/wp-content/uploads/2019/05/1aedb8d9dc4751e229a335e371db8058.jpg';
    }

    return new WP_REST_Response($data, 200);
}

add_filter('rest_prepare_beacon_services', 'func_rest_prepare_beacon_services', 10, 3);

add_filter('rest_prepare_products', 'func_rest_prepare_beacon_services', 10, 3);

function func_rest_prepare_beacon_services($data, $post, $request)
{

    $commentCount = wp_count_comments($post->ID);

    $data->data['comment_count'] = $commentCount->approved;

    global $wpdb;

    if ($data->data['featured_media'] > 0) {
        $image_attributes = wp_get_attachment_image_src($data->data['featured_media'], 'large');
        $data->data['media_url'] = $image_attributes[0];
    } else {
        $data->data['media_url'] = 'https://via.placeholder.com/150';
    }

    $data->data['price'] = "$" . get_post_meta($post->ID, 'price', true);

    $data->data['city'] = get_post_meta($post->ID, 'city', true);

    $data->data['state'] = get_post_meta($post->ID, 'state', true);

    $data->data['category'] = get_post_meta($post->ID, 'category', true);

    $term = get_term($data->data['category'], 'service_category');

    $data->data['category_name'] = $term->name;

    $first_name = get_user_meta($data->data['author'], 'first_name', true);

    $last_name = get_user_meta($data->data['author'], 'last_name', true);

    $name = $first_name . " " . $last_name;

    $nameL = $first_name . $last_name;

    if ($nameL == '') {
        $data->data['author_name'] = get_user_meta($data->data['author'], 'nickname', true);
    } else {
        $data->data['author_name'] = $name;
    }

    $useravatar = get_user_meta($data->data['author'], 'simple_local_avatar', true);

    if ($useravatar) {
        $img = wp_get_attachment_image_src($useravatar, array(
            '150',
            '150'
        ), true);
        $user_avatar = $img[0];
        $data->data['author_avatar_urls'] = $user_avatar;
        //$response->data['author_avatar']=$user_avatar;



    } else {
        $data->data['author_avatar_urls'] = 'https://beaconapp.betaplanets.com/wp-content/uploads/2019/05/1aedb8d9dc4751e229a335e371db8058.jpg';
    }

    return $data;
}

//do_action( 'rest_insert_attachment', $attachment, $request, true );


add_action('rest_insert_attachment', 'func_rest_insert_attachment', 10, 3);

function func_rest_insert_attachment($attachment, $request, $is_create)
{

    if (isset($request['post']) && $request['post'] != '') {
        set_post_thumbnail($request['post'], $attachment->ID);
    }

    if (isset($request['type']) && $request['type'] == "edit") {
        if (isset($request['old_image']) && $request['old_image'] != "") {
            wp_delete_attachment($request['old_image'], true);
        }
    }

    //_wp_attachment_wp_user_avatar


    if (isset($request['_wp_attachment_wp_user_avatar']) && $request['_wp_attachment_wp_user_avatar'] != '') {
        //set_post_thumbnail($request['post'],$attachment->ID);

        update_post_meta($attachment->ID, '_wp_attachment_wp_user_avatar', $request['_wp_attachment_wp_user_avatar']);
        //wp_user_avatar

        update_user_meta($request['_wp_attachment_wp_user_avatar'], 'simple_local_avatar', $attachment->ID);
    }
}

////apply_filters( "rest_{$this->post_type}_query", $args, $request );


add_filter('rest_beacon_services_query', 'func_rest_beacon_services_query', 10, 2);

add_filter('rest_products_query', 'func_rest_beacon_services_query', 10, 2);

function func_rest_beacon_services_query($args, $request)

{

    $param = $request->get_params();

    $token = $param['token'];

    if ($token != '' && $param['mypost'] == 1) {
        $user_id = GetMobileAPIUserByIdToken($token);
        if ($user_id) {
            $args['author'] = $user_id;
        } else {
            $args['author'] = 72348237483278274827482374;
        }
    }

    return $args;
}

function verify_email($data = array())
{
    $message = "<p>Your otp is <strong> " . $data['otp'] . " </strong></p>";
    $from_email = 'no-reply@knoxweb.com';

    //php mailer variables
    $to = $data['email'];
    $subject = "Verify OTP Code";
    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );
    $headers[] = 'From:' . $from_email . "\r\n" . 'Reply-To:' . $from_email . "\r\n";
    //Here put your Validation and send mail
    return wp_mail($to, $subject, $message, $headers);
}

function verify_otp($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $opt = $param['otp'];

    $user_id = $param['user_id'];

    if ($user_id) {
        $opt_check = get_user_meta($user_id, 'otp', true);
        if ($opt_check == $opt) {
            $data = array(
                "status" => "ok",
                "msg" => "Verfied email",
                "errormsg" => "",
                'error_code' => "",
                'status_code' => 200
            );
            update_user_meta($user_id, 'verfied', '1');
            $receiver_data = get_userdata($user_id);
            $receiver_email = $receiver_data->user_email;
            $receiver_first_name = get_user_meta($user_id, 'first_name', true);
            $receiver_last_name = get_user_meta($user_id, 'last_name', true);
            $transaction_id = "";
            $message_contents2 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Welcome " . $receiver_first_name . " " . $receiver_last_name . "</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Account is created successfully</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>If you have any question please contact us</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Thanks</p>";
            $subject2 = 'Account Registered successfully';
            sendEmailNotification($subject2, $message_contents2, $transaction_id, $receiver_email);
            return new WP_REST_Response($data, 200);
        } else {
            $data['status'] = "error";
            $data['errormsg'] = __('Cound not verfied email');
            $data['error_code'] = "invalid_request";
            $data['status_code'] = 201;
            return new WP_REST_Response($data, 403);
        }
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('User id does not exist.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
}

function get_token_by_user_id($user_id)
{
    $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : false;
    /** First thing, check the secret key if not exist return a error*/
    if (!$secret_key) {
        return new WP_Error(
            'jwt_auth_bad_config',
            __('JWT is not configurated properly, please contact the admin', 'wp-api-jwt-auth'),
            array('status' => 403)
        );
    }
    $issuedAt = time();
    $notBefore = apply_filters('jwt_auth_not_before', $issuedAt, $issuedAt);
    $expire = apply_filters('jwt_auth_expire', $issuedAt + (DAY_IN_SECONDS * 7), $issuedAt);
    $token = array(
        'iss' => get_bloginfo('url'),
        'iat' => $issuedAt,
        'nbf' => $notBefore,
        'exp' => $expire,
        'data' => array(
            'user' => array(
                'id' => $user_id,
            ),
        ),
    );
    /** Let the user modify the token data before the sign. */
    return $token = JWT::encode(apply_filters('jwt_auth_token_before_sign', $token, $user), $secret_key);
    /** The token is signed, now create the object with no sensible user data to  */
}

// Generate Tokens
function generate_token($username, $password)
{
    $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : false;

    if (!$secret_key) {
        return new WP_Error(
            'jwt_auth_bad_config',
            __('JWT is not configurated properly, please contact the admin', 'wp-api-jwt-auth'),
            array('status' => 403)
        );
    }

    $user = wp_authenticate($username, $password);

    if (is_wp_error($user)) {
        return $user; // Return the error to handle it properly in the calling function
    }

    $issuedAt = time();
    $notBefore = apply_filters('jwt_auth_not_before', $issuedAt, $issuedAt);
    $expire = apply_filters('jwt_auth_expire', $issuedAt + (DAY_IN_SECONDS * 7), $issuedAt);

    $token = array(
        'iss' => get_bloginfo('url'),
        'iat' => $issuedAt,
        'nbf' => $notBefore,
        'exp' => $expire,
        'data' => array('user' => array('id' => $user->ID)),
    );

    return JWT::encode(apply_filters('jwt_auth_token_before_sign', $token, $user), $secret_key);
}

function createpicture($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    //print_r($param);die;


    $token = $param['token'];

    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        $wordpress_upload_dir = wp_upload_dir();
        $profilepicture = $_FILES['file'];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        $new_file_mime = mime_content_type($profilepicture['tmp_name']);
        if ($profilepicture['error']) {
            $data = array(
                "status" => "ok",
                "errormsg" => $profilepicture['error'],
                'error_code' => "403"
            );
            return new WP_REST_Response($data, 403);
        }
        if ($profilepicture['size'] > wp_max_upload_size()) {
            $data = array(
                "status" => "ok",
                "errormsg" => '',
                'error_code' => "It is too large than expected."
            );
            return new WP_REST_Response($data, 403);
        }
        if (!in_array($new_file_mime, get_allowed_mime_types())) {
            $data = array(
                "status" => "ok",
                "errormsg" => '',
                'error_code' => "WordPress doesn\'t allow this type of uploads."
            );
            return new WP_REST_Response($data, 403);
        }
        while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
        }
        if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {
            $upload_id = wp_insert_attachment(array(
                'guid' => $new_file_path,
                'post_mime_type' => $new_file_mime,
                'post_title' => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            ), $new_file_path);
            // wp_generate_attachment_metadata() won't work if you do not include this file

            require_once(ABSPATH . 'wp-admin/includes/image.php');
            // Generate and save the attachment metas into the database

            wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));
            // Show the uploaded file in browser

            wp_redirect($wordpress_upload_dir['url'] . '/' . basename($new_file_path));
        }
        //update_user_meta(34, $wpdb->get_blog_prefix() . 'user_avatar', $upload_id);

        update_user_meta($user_id, 'simple_local_avatar', $upload_id);
        $useravatar = get_user_meta($user_id, 'simple_local_avatar', true);
        if ($useravatar) {
            $img = wp_get_attachment_image_src($useravatar, array(
                '150',
                '150'
            ), true);
            $data['user_avatar'] = $img[0];
        } else {
            $data['user_avatar'] = 'http://1.gravatar.com/avatar/1aedb8d9dc4751e229a335e371db8058?s=96&d=mm&r=g';
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data = array(
            "status" => "error",
            "errormsg" => "user token expired",
            'error_code' => "user_expire"
        );
        return new WP_REST_Response($data, 403);
    }
}


function create_contact_messages_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bluestoneapp_contact_messages';
    
    // Check if table exists and if phone column exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;
    $phone_column_exists = false;
    
    if ($table_exists) {
        $columns = $wpdb->get_results("SHOW COLUMNS FROM $table_name");
        foreach ($columns as $column) {
            if ($column->Field === 'phone') {
                $phone_column_exists = true;
                break;
            }
        }
    }
    
    // If table doesn't exist or phone column is missing, (re)create the table
    if (!$table_exists || !$phone_column_exists) {
        // Drop the table if it exists
        $wpdb->query("DROP TABLE IF EXISTS $table_name");
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            phone varchar(20) DEFAULT NULL,
            subject varchar(200) NOT NULL,
            message text NOT NULL,
            date_submitted datetime NOT NULL,
            status varchar(20) NOT NULL DEFAULT 'unread',
            PRIMARY KEY (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // Verify table was created and has phone column
        $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;
        if ($table_exists) {
            $columns = $wpdb->get_results("SHOW COLUMNS FROM $table_name");
            foreach ($columns as $column) {
                if ($column->Field === 'phone') {
                    return true;
                }
            }
        }
        return false;
    }
    
    return true;
}

function contact_us($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bluestoneapp_contact_messages';

    // Ensure table exists with correct structure
    if (!create_contact_messages_table()) {
        return new WP_Error(
            'table_creation_failed',
            __('Could not create contact messages table', 'bluestoneapp-contact-us'),
            array('status' => 500)
        );
    }

    // Get parameters from request
    $params = $request->get_params();
    
    // Validate required fields
    $required_fields = ['name', 'email', 'subject', 'message'];
    foreach ($required_fields as $field) {
        if (empty($params[$field])) {
            return new WP_Error(
                'missing_field',
                sprintf(__('%s is required', 'bluestoneapp-contact-us'), ucfirst($field)),
                array('status' => 400)
            );
        }
    }

    // Validate email format
    if (!is_email($params['email'])) {
        return new WP_Error(
            'invalid_email',
            __('Invalid email address', 'bluestoneapp-contact-us'),
            array('status' => 400)
        );
    }

    // Prepare data for insertion
    $data = array(
        'name' => sanitize_text_field($params['name']),
        'email' => sanitize_email($params['email']),
        'phone' => isset($params['phone']) ? sanitize_text_field($params['phone']) : null,
        'subject' => sanitize_text_field($params['subject']),
        'message' => sanitize_textarea_field($params['message']),
        'date_submitted' => current_time('mysql'),
        'status' => 'unread'
    );

    // Insert into database
    $result = $wpdb->insert($table_name, $data);

    if ($result === false) {
        $last_error = $wpdb->last_error;
        return new WP_Error(
            'db_error',
            __('Failed to save contact message: ' . $last_error, 'bluestoneapp-contact-us'),
            array('status' => 500)
        );
    }

    // Send email notification if enabled
    $options = get_option('bluestoneapp_contact_options');
    if ($options && isset($options['enable_notifications']) && $options['enable_notifications']) {
        $to = isset($options['notification_email']) ? $options['notification_email'] : get_option('admin_email');
        $email_subject = isset($options['email_subject']) ? $options['email_subject'] : 'New Contact Form Submission: {subject}';
        $email_template = isset($options['email_template']) ? $options['email_template'] : 
            'Name: {name}<br/>Email: {email}<br/>Phone: {phone}<br/>Subject: {subject}<br/>Message: {message}';
        
        $subject = str_replace(
            array('{name}', '{email}', '{phone}', '{subject}'),
            array($data['name'], $data['email'], $data['phone'], $data['subject']),
            $email_subject
        );
        $message = str_replace(
            array('{name}', '{email}', '{phone}', '{subject}', '{message}'),
            array($data['name'], $data['email'], $data['phone'], $data['subject'], $data['message']),
            $email_template
        );
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    }

    return array(
        'success' => true,
        'message' => __('Contact message sent successfully', 'bluestoneapp-contact-us'),
        'id' => $wpdb->insert_id
    );
}


function create_profile($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $first_name = $param['first_name'];

    $last_name = $param['last_name'];

    $phone = $param['phone'];

    $street1 = $param['street1'];

    $street2 = $param['street2'];

    $city = $param['city'];

    $zip_code = $param['zip_code'];

    //$phone_number = $param['phone_number'];
    // $message_contents =  $param['message'];


    // $user_id = 22;


    $user_id = GetMobileAPIUserByIdToken($token);

    if ($user_id) {
        update_user_meta($user_id, 'first_name', $first_name);
        update_user_meta($user_id, 'last_name', $last_name);
        update_user_meta($user_id, 'phone', $phone);
        update_user_meta($user_id, 'street1', $street1);
        update_user_meta($user_id, 'street2', $street2);
        update_user_meta($user_id, 'city', $city);
        update_user_meta($user_id, 'zip_code', $zip_code);
        update_user_meta($user_id, 'user_create_profile_flag', 1);
        $firstname = get_user_meta($user_id, 'first_name', true);
        $lastname = get_user_meta($user_id, 'last_name', true);
        $phone_no = get_user_meta($user_id, 'phone', true);
        $street_1 = get_user_meta($user_id, 'street1', true);
        $street_2 = get_user_meta($user_id, 'street2', true);
        $city = get_user_meta($user_id, 'city', true);
        $zipcode = get_user_meta($user_id, 'zip_code', true);
        $user_create_profile_flag = get_user_meta($user_id, 'user_create_profile_flag', true);
        $data['profile_data'] = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $phone_no,
            'street1' => $street_1,
            'street2' => $street_2,
            'city' => $city,
            'zip_code' => $zipcode,
            'user_create_profile_flag' => $user_create_profile_flag
        );
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
}

function getprofile_data($request)
{
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $user_id = GetMobileAPIUserByIdToken($token);

    // $user_id = 22;
    if ($user_id) {
        $firstname = get_user_meta($user_id, 'first_name', true);
        $lastname = get_user_meta($user_id, 'last_name', true);
        $phone_no = get_user_meta($user_id, 'phone', true);
        $street_1 = get_user_meta($user_id, 'street1', true);
        $street_2 = get_user_meta($user_id, 'street2', true);
        $city = get_user_meta($user_id, 'city', true);
        $zipcode = get_user_meta($user_id, 'zip_code', true);
        $data['profile_data'] = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $phone_no,
            'street1' => $street_1,
            'street2' => $street_2,
            'city' => $city,
            'zip_code' => $zipcode
        );
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
}

function getuserdata($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $token = $param['token'];

    $userid = $param['userid'];

    $user_id = GetMobileAPIUserByIdToken($token);

    //$user_id = 20;
    if ($user_id) {
        $user_info = get_userdata($userid);
        if ($user_info) {
            $firstname = get_user_meta($userid, 'first_name', true);
            $lastname = get_user_meta($userid, 'last_name', true);
            $phone_no = get_user_meta($userid, 'phone', true);
            $useravatar = get_user_meta($userid, 'simple_local_avatar', true);
            if ($useravatar) {
                $img = wp_get_attachment_image_src($useravatar, array(
                    '150',
                    '150'
                ), true);
                $user_image = $img[0];
            } else {
                $user_image = 'http://1.gravatar.com/avatar/1aedb8d9dc4751e229a335e371db8058?s=96&d=mm&r=g';
            }
            $data['profile_data'] = array(
                'userid' => $userid,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'phone' => $phone_no,
                'email' => $user_info->user_email,
                'profile_image' => $user_image
            );
        } else {
            $data['profile_data'] = false;
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Invalid request.');
        $data['error_code'] = "";
        return new WP_REST_Response($data, 403);
    }
}



/* Add wallet money throug api */

function addWalletWithBank($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $amount = $param['amount'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id = 64;


    if ($user_id) {
        $data['status'] = "ok";
        $data['payment'] = '';
        $data['msg'] = '';
        require_once 'stripe/init.php';
        $data['msg'] = 'sucess';
        $stripe_customer_id = get_user_meta($user_id, 'stripe_id', true);
        $stripe_account_id = get_user_meta($user_id, 'stripe_account_id', true);
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        //echo $customerid;

        try {
            $charge = \Stripe\Charge::create(array(
                'amount' => number_format($amount, 2) * 100,
                'currency' => 'usd',
                'source' => $stripe_account_id,
                'capture' => $capture,
                'customer' => $stripe_customer_id,
            ));
        } catch (Stripe_CardError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API

            $error[] = $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed

            $error[] = $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed

            $error[] = $e->getMessage();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send

            // yourself an email

            $error[] = $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe

            $error[] = $e->getMessage();
        }
        if (count($error) == 0) {
            $data['transaction_data'] = $charge;
            $wpdb->insert('wp_ewallet', array(
                'user_id' => $user_id,
                'balance' => $amount,
                'transaction_id' => $charge->id,
                'type' => 'stripe', // stripe or wallet

                'status' => 7,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
                // ... and so on


            ));
            $sender_data = get_userdata($user_id);
            $sender_email = $sender_data->user_email;
            $sender_first_name = get_user_meta($user_id, 'first_name', true);
            $sender_last_name = get_user_meta($user_id, 'last_name', true);
            $transaction_id = $charge->id;
            $message_contents2 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Hi " . $sender_first_name . " " . $sender_last_name . "</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Amount of $" . $param['amount'] . " is added to wallet </p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Here is transaction id for following: " . $transaction_id . "</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Thanks</p>";
            $subject2 = 'Balance added to wallet successfully';
            sendEmailNotification($subject2, $message_contents2, $transaction_id, $sender_email);
            $wallet_balance = get_user_meta($user_id, 'wallet_balance', true);
            if ($wallet_balance == '') {
                update_user_meta($user_id, 'wallet_balance', $amount);
            } else {
                // Add this amount to wallet balance

                $wallet_balance = $wallet_balance + $amount;
                update_user_meta($user_id, 'wallet_balance', $wallet_balance);
            }
            /*  } */
            $wpdb->insert("transfer_transaction", array(
                'user_id' => $user_id,
                'amount' => $param['amount'],
                'destination_account_id' => "",
                'sender_customer_id' => "",
                'card_id' => $charge->id,
                'type' => 1,
                'date_added' => date('Y-m-d H:i:s')
            ));
            $data['msg'] = "Balance added successfully";
            return new WP_REST_Response($data, 200);
        } else {
            $data['status'] = "error";
            $data['msg'] = join(",", $error);
            return new WP_REST_Response($data, 403);
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}


function giftCardVerification($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $card_code = $param['card_code'];

    /* print_r($card_code);
    
    
    
    die(); */

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    // $user_id = 20;


    if ($user_id) {
        $my_args = array(
            'post_type' => 'gift_cards',
            "s" => $card_code,
        );
        $custom_query = new WP_Query($my_args);
        $card_id = "";
        if ($custom_query->have_posts()) {
            while ($custom_query->have_posts()) {
                $custom_query->the_post();
                $card_id = $custom_query->posts[0]->ID;
            }
            $used_by = get_field('used_by', $card_id);
            $card_value = get_field('card_value', $card_id);
            if ($used_by == "") {
                $data['msg'] = "valid gift card";
                $data['card_value'] = $card_value;
                $data['status_code'] = 200;
                return new WP_REST_Response($data, 200);
            } else {
                $data['errormsg'] = "Gift card already Used";
                $data['msg'] = "expired";
                $data['status_code'] = 202;
                return new WP_REST_Response($data, 202);
            }
        } else {
            $data['errormsg'] = "Code is not valid";
            $data['status_code'] = 201;
            $data['msg'] = "Invalid code";
            return new WP_REST_Response($data, 201);
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}

function addGiftCardBalance($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $card_code = $param['card_code'];

    $amount = $param['amount'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id = 20;


    // Add to wallet


    if ($user_id) {
        //$result = $wpdb->get_row ( "SELECT * FROM  wp_ewallet WHERE user_id = '$user_id'" );

        $wallet_balance = get_user_meta($user_id, 'wallet_balance', true);
        $my_args = array(
            'post_type' => 'gift_cards',
            "s" => $card_code,
        );
        $custom_query = new WP_Query($my_args);
        $card_id = "";
        if ($custom_query->have_posts()) {
            while ($custom_query->have_posts()) {
                $custom_query->the_post();
                $card_id = $custom_query->posts[0]->ID;
            }
            $used_by = get_field('used_by', $card_id);
            $card_value = get_field('card_value', $card_id);
            if ($used_by == "") {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $wallet_transaction_id = 'gift_' . substr(str_shuffle($permitted_chars), 0, 24);
                $wpdb->insert('wp_ewallet', array(
                    'user_id' => $user_id,
                    'balance' => $amount,
                    'transaction_id' => $wallet_transaction_id,
                    'type' => 'gift_card', // stripe , wallet ,gift_card

                    'status' => 4,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ));
                // Add to transaction history

                //$wpdb->insert("wp_gift_cards_uses",array('user_id'=>$user_id,'card_code'=>$card_code));

                $used_by = update_field('used_by', $user_id, $card_id);
                $wpdb->insert("transfer_transaction", array(
                    'user_id' => $user_id,
                    'amount' => $param['amount'],
                    'destination_account_id' => "",
                    'sender_customer_id' => "",
                    'card_id' => "",
                    'type' => 1,
                    'date_added' => date('Y-m-d H:i:s')
                ));
                $sender_data = get_userdata($user_id);
                $sender_email = $sender_data->user_email;
                $sender_first_name = get_user_meta($user_id, 'first_name', true);
                $sender_last_name = get_user_meta($user_id, 'last_name', true);
                $message_contents2 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Hi " . $sender_first_name . " " . $sender_last_name . "</p></br>";
                $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Amount of $" . $param['amount'] . " is added to wallet by gift card " . $card_code . "</p></br>";
                $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Here is transaction id for following: " . $wallet_transaction_id . "</p></br>";
                $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Thanks</p>";
                $subject2 = 'Gift Card Balance added to wallet successfully';
                sendEmailNotification($subject2, $message_contents2, $wallet_transaction_id, $sender_email);
                $data['msg'] = "Balance added successfully";
                return new WP_REST_Response($data, 200);
            } else {
                $data['errormsg'] = "Gift card already Used";
                $data['msg'] = "expired";
                $data['status_code'] = 202;
            }
        } else {
            $data['errormsg'] = "Code is not valid";
            $data['status_code'] = 201;
            $data['msg'] = "Invalid code";
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}
/* function addGiftCardBalance($request){



    global $wpdb;   



    $data = array("status" => "ok", "errormsg" => "", 'error_code' => "");

    $param = $request->get_params();



    $usertoken = $param['token'];



    $card_code = $param['card_code'];



    $amount = $param['amount'];



    $user_id = GetMobileAPIUserByIdToken($usertoken);



    if ($user_id) {


        $result = $wpdb->get_row ( "SELECT * FROM  wp_ewallet WHERE user_id = '$user_id'" );


        $res = $wpdb->get_row("SELECT * FROM wp_gift_cards_uses WHERE card_code='" . $card_code . "' and user_id='" . $user_id . "'");


        if (count($res) > 0) {


            $data['errormsg'] = "Gift card already Used";


            $data['msg'] = "expired";


            $data['status_code'] = 202;


            return new WP_REST_Response($data, 200);


        }else{  


            if(count($result) > 0 ){


                $amount_get = $result->balance;


                $amount_total = $amount_get + $amount;


                $updated_at = date('Y-m-d h:i:s');


                $data_update = array('balance' => $amount_total ,'updated_at' => $updated_at);


                $data_where = array('user_id' => $user_id);


                $wpdb->update('wp_ewallet',$data_update, $data_where); 


            } else{


                $wpdb->insert('wp_ewallet', array(


                    'user_id' => $user_id,


                    'balance' => $amount,


                    'transaction_id' => $card_code, 


                    'created_at' => date('Y-m-d h:i:s'),


                    'updated_at' => date('Y-m-d h:i:s')


                ));


            }


            


            // Add to transaction history


            


            $wpdb->insert("wp_gift_cards_uses",array('user_id'=>$user_id,'card_code'=>$card_code));


            


            $wpdb->insert("transfer_transaction",array('user_id'=>$user_id,'amount'=>$param['amount'],'destination_account_id'=>"",'sender_customer_id'=>"",'card_id'=>"",'type'=>1,'date_added'=> date( 'Y-m-d H:i:s' )));


            


            $data['msg'] = "Balance added successfully";


            return new WP_REST_Response($data, 200);


        }



    } else {


        $data['status'] = "error";


        $data['error_code'] = "user_expire";


        $data['msg'] = "Something went wrong.";


        return new WP_REST_Response($data, 403);



    }



} */

function sendMoneyFromWallet_callback($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $usertoken = $param['token'];
    $amount = $param['amount'];
    $receiver = $param['receiver'];
    $request_id = $param['request_id'];
    $description = $param['description'];
    $pin = $param['pin'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    if ($user_id) {
        // $user_id = 184;

        if ($amount['total'] < 1) {
            $data['error_code'] = "amount_error";
            $data['errormsg'] = "amount should be eqat to OR greator then 1";
            return new WP_REST_Response($data, 403);
        }


        $savedPin = get_user_meta($user_id, 'pin', true);
        $is_pin = get_user_meta($user_id, 'is_pin', true);
        if ($is_pin == 1) {
            if ($pin != $savedPin) {
                $validation = ValidatePinAttempt($user_id, true);
                if ($validation) {
                    $data['force_reset'] = false;
                    $data['errormsg'] = "Please provide a correct pin";
                    $data['error_code'] = "pin_error";
                    return new WP_REST_Response($data, 403);
                } else {
                    $data['force_reset'] = true;
                    $data['error_code'] = "pin_error";
                    $data['errormsg'] = "Due to multiple wrong attempt your pin is disabled now , Please reset it from setting";
                    return new WP_REST_Response($data, 403);
                }
            }
        }


        global $helper_obj;
        // $wallet_balance = "";
        $wallet_balance = $helper_obj->get_wallet_balance($user_id);
        if ($wallet_balance != '') {
            $amount_get = $wallet_balance;
            if ($amount['total'] > $amount_get) {
                $data['status'] = "error";
                $data['sender_balance'] = money_format('%i', $amount_get);
                $data['msg'] = 'Your Balance is low.Please Add some funds';
                $data['status_code'] = 201;
                return new WP_REST_Response($data, 200);
            }
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $wallet_transaction_id = 'wal_' . substr(str_shuffle($permitted_chars), 0, 24);
            $wpdb->insert('wp_ewallet', array(
                'user_id' => $user_id,
                'balance' => $amount['amount'],
                'transaction_id' => $wallet_transaction_id,
                'type' => 'wallet', // stripe or wallet,
                'status' => 3,
                'to_user' => $receiver,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ));



            // send fees to admin
            $wpdb->insert('wp_ewallet', array(
                'user_id' => $user_id,
                'balance' => $amount['admin_fees'],
                'transaction_id' => $wallet_transaction_id,
                'type' => 'wallet', // stripe or wallet,
                'status' => 5,
                'to_user' => 3,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ));
            //receive transaction
            $r = $wpdb->insert("transfer_transaction", array(
                'user_id' => $user_id,
                'to_user_id' => $receiver,
                'amount' => $amount['amount'],
                'card_id' => "",
                "transaction_type" => "wallet",
                'fee' => $amount['fee'],
                'total_amount' => $amount['total'],
                'admin_fees' => $amount['admin_fees'],
                'type' => 4,
                'charge_id' => $wallet_transaction_id,
                'request_id' => $request_id,
                "payment_status" => 1,
                'description' => $description,
                'date_added' => date('Y-m-d H:i:s'),
                'payment_date' => date('Y-m-d h:i:s')
            ));
            $lastid = $wpdb->insert_id;
            if ($request_id > 0) {
                $wpdb->update('Request_transfer', array('status' => "accepted", "transfer_id" => $lastid), array('request_id' => $request_id));
            }

            $sender_data = get_userdata($user_id);
            $sender_email = $sender_data->user_email;
            $sender_first_name = get_user_meta($user_id, 'first_name', true);
            $sender_last_name = get_user_meta($user_id, 'last_name', true);
            $receiver_data = get_userdata($receiver);
            $receiver_email = $receiver_data->user_email;
            $receiver_first_name = get_user_meta($receiver, 'first_name', true);
            $receiver_last_name = get_user_meta($receiver, 'last_name', true);
            $transaction_id = $wallet_transaction_id;
            $message_contents1 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Hi " . $sender_first_name . " " . $sender_last_name . "</p></br>";
            $message_contents1 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Amount of $" . $param['amount'] . " is Sent to the " . $receiver_first_name . " " . $receiver_last_name . " from wallet</p></br>";
            $message_contents1 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Here is transaction id for following <strong> " . $transaction_id . " </strong></p></br><p>Thanks</p>";
            $message_contents2 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Hi " . $receiver_first_name . " " . $receiver_last_name . "</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Amount of $" . $param['amount'] . " is Received from the " . $sender_first_name . " " . $sender_last_name . " into wallet</p></br>";
            $message_contents2 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Here is transaction id for following <strong> " . $transaction_id . " </strong></p></br><p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Thanks</p>";
            $subject1 = 'Money Sent successfully';
            sendEmailNotification($subject1, $message_contents1, $transaction_id, $sender_email);
            $subject2 = 'Money Received successfully';
            sendEmailNotification($subject2, $message_contents2, $transaction_id, $receiver_email);
            $appTitle = $sender_first_name . ' ' . $sender_last_name . ' has sent you money';
            // $appTitle = "Amount of $".$param['amount']." is received!";
            sendPushServer($user_id, 'money_received', 'Money Received ', $appTitle, $receiver, $lastid);
            $data['status'] = "ok";
            $data['sender_wallet_balance'] = $helper_obj->get_wallet_balance($user_id);
            $data['msg'] = 'Balance transfer successfully';
            $data['status_code'] = 200;
            $data['receiver_wallet_balance'] = $helper_obj->get_wallet_balance($receiver);
            return new WP_REST_Response($data, 200);
        } else {
            $data['status'] = "error";
            $data['sender_balance'] = 0;
            $data['msg'] = 'Your Balance is low.Please Add';
            $data['status_code'] = 202;
            return new WP_REST_Response($data, 200);
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}




function updateProfile($request)
{
    $data = array("code" => 200, "status" => "ok", "errormsg" => "", 'error_code' => "");
    $param = $request->get_params();
    if (isset($param['token']) && !empty($param['token'])) {
        $user_id = GetMobileAPIUserByIdToken($param['token']);
    } else if (isset($param['login_user_id']) && !empty($param['login_user_id'])) {
        $user_id = $param['login_user_id'];
        $param['token'] = get_token_by_user_id($user_id);
    }
    if ($user_id) {
        global $wpdb;
        if (isset($param['first_name']) && !empty($param['first_name'])) {
            update_user_meta($user_id, 'first_name', $param['first_name']);
        }
        if (isset($param['last_name']) && !empty($param['last_name'])) {
            update_user_meta($user_id, 'last_name', $param['last_name']);
        }
        if (isset($param['phone']) && !empty($param['phone'])) {
            update_user_meta($user_id, 'phone', $param['phone']);
        }
        if (isset($param['street1']) && !empty($param['street1'])) {
            update_user_meta($user_id, 'street1', $param['street1']);
        }
        if (isset($param['street2']) && !empty($param['street2'])) {
            update_user_meta($user_id, 'street2', $param['street2']);
        }
        if (isset($param['city']) && !empty($param['city'])) {
            update_user_meta($user_id, 'city', $param['city']);
        }
        if (isset($param['state']) && !empty($param['state'])) {
            update_user_meta($user_id, 'state', $param['state']);
        }
        if (isset($param['zipcode']) && !empty($param['zipcode'])) {
            update_user_meta($user_id, 'zipcode', $param['zipcode']);
        }
        if (isset($param['project']) && !empty($param['project'])) {
            update_user_meta($user_id, 'project', $param['project']);
        }
        if (isset($param['company']) && !empty($param['company'])) {
            update_user_meta($user_id, 'company', $param['company']);
        }
        // Handle profile image upload
        if (isset($_FILES['profile_img'])) {
            $upload = wp_handle_upload($_FILES['profile_img'], array('test_form' => false));
            if (!isset($upload['error']) && isset($upload['url'])) {
                $data['profile_img'] = $upload['url'];
                update_user_meta($user_id, 'user_avatar', $upload['url']);
            } else {
                // Handle upload error
                $data['errormsg'] = 'Image upload failed: ' . $upload['error'];
            }
        }
        $data['msg'] = "User profile has been updated successfully.";
        global $helper_obj;
        $loginInfo = get_user_informations($user_id);
        $loginInfo['token'] = $param['token'];
        $data['loginInfo'] = $loginInfo;
        return new WP_REST_Response($data, $data['code']);
    } else {
        $data['code'] = 403;
        $data["status"] = "error";
        $data["errormsg"] = "Token is expired. Please login again";
        $data["error_code"] = "user_expire";
        return new WP_REST_Response($data, $data['code']);
    }
}

function addBankToConnectedAccount($request)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    //$type = $param['type'];


    $b_tok = $param['stripeToken'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id = 20;


    if ($user_id) {
        $stripe_account_id = get_user_meta($user_id, 'stripe_account_id', true);
        $stripeid = get_user_meta($user_id, 'stripe_id', true);
        $data['status'] = "ok";
        $data['payment'] = '';
        $data['msg'] = '';
        require_once 'stripe/init.php';
        $data['msg'] = 'sucess';
        $stripeid = get_user_meta($user_id, 'stripe_id', true);
        $user_info = get_userdata($user_id);
        $email = $user_info->user_email;
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key,
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $customerid = $stripeid;
        try {
            if ($stripe_account_id == '') {
                $first_name = get_user_meta($user_id, 'first_name', true);
                $last_name = get_user_meta($user_id, 'last_name', true);
                if (!$stripeid) {
                    $customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'name' => $first_name,
                    ));
                    update_user_meta($user_id, 'stripe_id', $customer->id);
                    $customerid = $customer->id;
                }
                $acct = \Stripe\Account::create([
                    "type" => "custom",
                    "country" => "US",
                    "email" => $email,
                    "business_type" => "individual",
                    "individual" => [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email
                    ],
                    "requested_capabilities" => ['card_payments', 'transfers'],
                    'metadata' => ['user_id' => $user_id, 'stripeid_cust_id' => $customerid],
                    "external_account" => $b_tok,
                    "tos_acceptance" => [
                        "date" => strtotime(date('d-m-Y')),
                        "ip" => $_SERVER['REMOTE_ADDR'],
                    ],
                ]);
                update_user_meta($user_id, 'stripe_account_id', $acct->id);
                $stripe_account_id = $acct->id;
            } else {
                $card = \Stripe\Account::createExternalAccount(
                    $stripe_account_id,
                    ['external_account' => $b_tok]
                );
            }
        } catch (Stripe_CardError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_InvalidRequestError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            $error[] = $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $error[] = $e->getMessage();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error[] = $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error[] = $e->getMessage();
        }
        if (count($error) == 0) {
            $data['msg'] = "ACCOUNT added successfully";
            return new WP_REST_Response($data, 200);
        } else {
            $data['status'] = "error";
            $data['msg'] = join(",", $error);
            return new WP_REST_Response($data, 403);
        }
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}

function createEvent($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );

    $param = $request->get_params();

    $usertoken = $param['token'];

    $media = $param['media'];

    $user_id = GetMobileAPIUserByIdToken($usertoken);

    //$user_id = 20;


    $event_date = date('Y-m-d', strtotime($param['event_date']));

    if ($user_id) {
        $new_event = array(
            "post_title" => $param['title'],
            "post_content" => $param['description'],
            "post_status" => "publish",
            "post_author" => $user_id,
            "post_type" => 'events'
        );
        $event_id = wp_insert_post($new_event);
        $key = get_option('options_google_map_key');
        $address = $param['address_street1'] . " " . $param['address_street2'] . " " . $param['city'] . ", " . $param['state'] . " " . $param['zip'];
        $prepAddr = str_replace(' ', '+', $address);
        $geo = wp_remote_fopen('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($prepAddr) . '&key=' . urlencode($key));
        // We convert the JSON to an array

        $geo = json_decode($geo, true);
        // If everything is cool

        if ($geo['status'] = 'OK') {
            $lat = $geo['results'][0]['geometry']['location']['lat'];
            $lon = $geo['results'][0]['geometry']['location']['lng'];
            update_field('event_lat', $lat, $event_id);
            update_field('event_lon', $lon, $event_id);
        }
        update_field('event_date', $event_date, $event_id);
        update_field('from_time', $param['from_time'], $event_id);
        update_field('to_time', $param['to_time'], $event_id);
        update_field('address_street1', $param['address_street1'], $event_id);
        update_field('address_street2', $param['address_street2'], $event_id);
        update_field('city', $param['city'], $event_id);
        update_field('state', $param['state'], $event_id);
        update_field('zip', $param['zip'], $event_id);
        update_field('duration', $param['duration'], $event_id);
        update_field('price', $param['price'], $event_id);
        update_post_meta($event_id, "attachment_id", $media);
        $sender_data = get_userdata($user_id);
        $sender_email = $sender_data->user_email;
        $sender_first_name = get_user_meta($user_id, 'first_name', true);
        $sender_last_name = get_user_meta($user_id, 'last_name', true);
        $transfer_id = "";
        $message_contents1 = "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Hi " . $sender_first_name . " " . $sender_last_name . "</p></br>";
        $message_contents1 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>New Event is created successfully.</p></br>";
        $message_contents1 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Event details:</p></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Title</i>:<b>" . $param['title'] . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Description</i>:<b>" . $param['description'] . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Event Date</i>:<b>" . $event_date . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Time</i>:<b>" . $param['from_time'] . "-" . $param['to_time'] . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>City</i>:<b>" . $param['city'] . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Price</i>:<b>" . $param['price'] . "</b></br>";
        $message_contents1 .= "<i style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Duration</i>:<b>" . $param['duration'] . "</b></br>";
        $message_contents1 .= "<p style='font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px;'>Thanks</p>";
        $subject1 = 'Event created successfully';
        sendEmailNotification($subject1, $message_contents1, $transfer_id, $sender_email);
        $data['event_id'] = $event_id;
        $data['msg'] = "Event added successfully";
        $data['status'] = "ok";
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['error_code'] = "user_expire";
        $data['msg'] = "Something went wrong.";
        return new WP_REST_Response($data, 403);
    }
}
function listEvents($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);

    //  $user_id = 60;


    if ($user_id) {
        $event_lists = array();
        $event_list = array();
        $args = array(
            'post_type' => 'bs_calendar_event',
            'post_status' => array(
                'publish'
            )
        );
        $event_posts = get_posts($args);
        if (count($event_posts) > 0) {
            foreach ($event_posts as $event) {
                $event_list['event_id'] = $event->ID;
                $event_list['user_id'] = $event->post_author;
                $event_list['event_title'] = $event->post_title;
                $event_list['description'] = $event->post_content;
                $event_list['event_date'] = get_field('event_date', $event->ID);
                // $event_list['event_month'] = date("F", strtotime(get_field('event_date', $event->ID)));
                // $event_list['event_day'] = date("d", strtotime(get_field('event_date', $event->ID)));
                // $event_list['from_time_hour'] = date('H:i A', strtotime(get_field('from_time', $event->ID)));
                // $event_list['to_time_hour'] = date('H:i A', strtotime(get_field('to_time', $event->ID)));
                // $event_list['from_time'] = get_field('from_time', $event->ID);
                // $event_list['to_time'] = get_field('to_time', $event->ID);
                // $event_list['address_street1'] = get_field('address_street1', $event->ID);
                // $event_list['address_street2'] = get_field('address_street2', $event->ID);
                // $event_list['state'] = get_field('state', $event->ID);
                // $event_list['zip'] = get_field('zip', $event->ID);
                // $event_list['duration'] = get_field('duration', $event->ID);
                // $event_list['price'] = get_field('price', $event->ID);
                // $event_list['event_lat'] = get_field('event_lat', $event->ID);
                // $event_list['event_lon'] = get_field('event_lon', $event->ID);
                // $event_list['favpost'] = (int)HasWtiAlreadyVotedfav($event->ID, $user_id);
                // $event_list['media'] = "";
                // $event_attachments['media'] = get_post_meta($event->ID, "attachment_id", true);
                // if (!empty($event_attachments['media'])) {
                //     $event_list['media'] = $event_attachments['media'];
                // }
                $event_lists[] = $event_list;
                $event_list['media'] = "";
            }
            $data['events'] = $event_lists;
        } else {
            $data['no_event'] = 'No event found';
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Please try again.');
        $data['error_code'] = "Invalid events";
        return new WP_REST_Response($data, 403);
    }
}

function getSingleEventById($request)
{

    // print_r($request);die;


    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);

    // $user_id = 22;


    if ($user_id) {
        $event_id = $param['event_id'];
        $event = get_post($event_id);
        // print_r($event->ID);die;

        $event_list = array();
        $event_list['event_id'] = $event->ID;
        $event_list['user_id'] = $event->post_author;
        $event_list['event_title'] = $event->post_title;
        $event_list['description'] = $event->post_content;
        $event_list['event_date'] = get_field('event_date', $event->ID);
        $event_list['from_time'] = get_field('from_time', $event->ID);
        $event_list['to_time'] = get_field('to_time', $event->ID);
        $event_list['event_month'] = date("F", strtotime(get_field('event_date', $event->ID)));
        $event_list['event_day'] = date("d", strtotime(get_field('event_date', $event->ID)));
        $event_list['from_time_hour'] = date('H:i A', strtotime(get_field('from_time', $event->ID)));
        $event_list['to_time_hour'] = date('H:i A', strtotime(get_field('to_time', $event->ID)));
        $event_list['address_street1'] = get_field('address_street1', $event->ID);
        $event_list['address_street2'] = get_field('address_street2', $event->ID);
        $event_list['state'] = get_field('state', $event->ID);
        $event_list['zip'] = get_field('zip', $event->ID);
        $event_list['duration'] = get_field('duration', $event->ID);
        $event_list['price'] = get_field('price', $event->ID);
        $event_list['event_lat'] = get_field('event_lat', $event->ID);
        $event_list['event_lon'] = get_field('event_lon', $event->ID);
        $event_list['favpost'] = (int)HasWtiAlreadyVotedfav($event->ID, $user_id);
        $event_list['media'] = "";
        $event_attachments['media'] = get_post_meta($event->ID, "attachment_id", true);
        if (!empty($event_attachments['media'])) {
            $event_list['media'] = $event_attachments['media'];
        }
        $data['events'] = $event_list;
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = 'Please try again.';
        $data['error_code'] = "Invalid events";
        return new WP_REST_Response($data, 403);
    }

    //print_r($param);


    // $user_id = 60;


    $user_id = GetMobileAPIUserByIdToken($param['token']);
}

function getEventById($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $param = $request->get_params();

    //print_r($param);


    // $user_id = 60;


    $user_id = GetMobileAPIUserByIdToken($param['token']);

    if ($user_id) {
        $event_id = $param['event_id'];
        $event_list = array();
        $ckEventIsBooked = "SELECT * FROM bookings WHERE event_id = $event_id AND payment_status = 2";
        $isBooked = $wpdb->get_results($ckEventIsBooked);
        $event = get_post($event_id);
        if (($event) > 0 && count($isBooked) > 0 && count($isBooked) != '') {
            $event_list['event_images'] = array();
            $event_list['event_id'] = $event->ID;
            $event_list['user_id'] = $event->post_author;
            $event_list['event_title'] = $event->post_title;
            $event_list['description'] = $event->post_content;
            $event_list['event_date'] = get_field('event_date', $event->ID);
            $event_list['from_time'] = get_field('from_time', $event->ID);
            $event_list['to_time'] = get_field('to_time', $event->ID);
            $event_list['event_month'] = date("F", strtotime(get_field('event_date', $event->ID)));
            $event_list['event_day'] = date("d", strtotime(get_field('event_date', $event->ID)));
            $event_list['from_time_hour'] = date('H:i A', strtotime(get_field('from_time', $event->ID)));
            $event_list['to_time_hour'] = date('H:i A', strtotime(get_field('to_time', $event->ID)));
            $event_list['address_street1'] = get_field('address_street1', $event->ID);
            $event_list['address_street2'] = get_field('address_street2', $event->ID);
            $event_list['state'] = get_field('state', $event->ID);
            $event_list['zip'] = get_field('zip', $event->ID);
            $event_list['duration'] = get_field('duration', $event->ID);
            $event_list['price'] = get_field('price', $event->ID);
            $event_list['event_lat'] = get_field('event_lat', $event->ID);
            $event_list['event_lon'] = get_field('event_lon', $event->ID);
            $event_list['favpost'] = (int)HasWtiAlreadyVotedfav($event->ID, $user_id);
            $event_list['media'] = "";
            $count = get_post_meta($event->ID, 'count_images', true);
            $event_attachments['media'] = get_post_meta($event->ID, "attachment_id", true);
            if (!empty($event_attachments['media'])) {
                $event_list['media'] = $event_attachments['media'];
            }
            $data['event'] = $event_list;
        } else {
            $data['no_event'] = 'No event found';
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = 'Please try again.';
        $data['error_code'] = "Invalid events";
        return new WP_REST_Response($data, 403);
    }
}

function addFeaturedImage($request)

{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => "",

    );

    $param = $request->get_params();

    $token = $param['token'];

    $post_id = $param['post_id'];

    $type = $param['type'];

    //echo $user_id = GetMobileAPIUserByIdToken($token);


    $user_id = GetMobileAPIUserByIdToken($token);

    //$user_id = 386;


    if ($user_id) {
        $wordpress_upload_dir = wp_upload_dir();
        $profilepicture = $_FILES['file'];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        /*print_r(get_allowed_mime_types());
        
        
        
        die;*/
        //$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );

        //mimeType = $profilepicture->getClientmimeType();

        $new_file_mime = $profilepicture['type'];
        if ($profilepicture['error']) {
            $data = array(
                "status" => "ok",
                "errormsg" => $profilepicture['error'],
                'error_code' => "403"
            );
            return new WP_REST_Response($data, 403);
        }
        if ($profilepicture['size'] > wp_max_upload_size()) {
            $data = array(
                "status" => "ok",
                "errormsg" => '',
                'error_code' => "It is too large than expected."
            );
            return new WP_REST_Response($data, 403);
        }
        /*if( !in_array( $new_file_mime, get_allowed_mime_types() ) ){
        
        
        
        $data  = array(
        
        
        
            "status" => "ok",
        
        
        
            "errormsg" => '',
        
        
        
            'error_code' => "WordPress doesn\'t allow this type of uploads."
        
        
        
          );
        
        
        
        return new WP_REST_Response($data, 403);
        
        
        
        }*/
        while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
        }
        if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {
            $upload_id = wp_insert_attachment(array(
                'guid' => $new_file_path,
                'post_mime_type' => $new_file_mime,
                'post_title' => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            ), $new_file_path);
            // wp_generate_attachment_metadata() won't work if you do not include this file

            require_once(ABSPATH . 'wp-admin/includes/image.php');
            // Generate and save the attachment metas into the database

            wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));
            if ($type == "image") {
                set_post_thumbnail($post_id, $upload_id);
            }
            $type = get_post_mime_type($upload_id);
            switch ($type) {
                case 'image/jpeg':
                case 'image/png':
                case 'image/gif':
                    $img = wp_get_attachment_image_src($upload_id, array(
                        '150',
                        '150'
                    ), true);
                    $data['upload_preview'] = $img[0];
                    $data['upload_id'] = $upload_id;
                    return new WP_REST_Response($data, 200);
                    break;
                case 'video/mpeg':
                case 'video/mp4':
                case 'video/quicktime':
                    $img = wp_get_attachment_url($upload_id);
                    $data['upload_preview'] = $img;
                    $data['upload_id'] = $upload_id;
                    return new WP_REST_Response($data, 200);
                    break;
                default:
                    return null;
            }
        }
    } else {
        $data = array(
            "status" => "error",
            "errormsg" => "user token expired",
            'error_code' => "user_expire",
        );
    }

    return new WP_REST_Response($data, 403);
}

function userEventsList($request)
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );


    $param = $request->get_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);
    //$user_id = 20;


    if ($user_id) {
        $event_lists = array();
        $event_list = array();
        $args = array(
            'post_type' => 'events',
            'post_status' => 'publish',
            'author' => $user_id
        );
        $event_posts = get_posts($args);
        if (count($event_posts) > 0) {
            foreach ($event_posts as $event) {
                $event_list['event_id'] = $event->ID;
                $event_list['user_id'] = $event->post_author;
                $event_list['event_title'] = $event->post_title;
                $event_list['description'] = $event->post_content;
                $event_list['event_date'] = get_field('event_date', $event->ID);
                $event_list['from_time'] = get_field('from_time', $event->ID);
                $event_list['to_time'] = get_field('to_time', $event->ID);
                $event_list['event_month'] = date("F", strtotime(get_field('event_date', $event->ID)));
                $event_list['event_day'] = date("d", strtotime(get_field('event_date', $event->ID)));
                $event_list['from_time_hour'] = date('H:i A', strtotime(get_field('from_time', $event->ID)));
                $event_list['to_time_hour'] = date('H:i A', strtotime(get_field('to_time', $event->ID)));
                $event_list['address_street1'] = get_field('address_street1', $event->ID);
                $event_list['address_street2'] = get_field('address_street2', $event->ID);
                $event_list['state'] = get_field('state', $event->ID);
                $event_list['zip'] = get_field('zip', $event->ID);
                $event_list['duration'] = get_field('duration', $event->ID);
                $event_list['price'] = get_field('price', $event->ID);
                $event_list['event_lat'] = get_field('event_lat', $event->ID);
                $event_list['event_lon'] = get_field('event_lon', $event->ID);
                $event_list['favpost'] = (int)HasWtiAlreadyVotedfav($event->ID, $user_id);
                $event_list['media'] = "";
                $event_attachments['media'] = get_post_meta($event->ID, "attachment_id", true);
                if (!empty($event_attachments['media'])) {
                    $event_list['media'] = $event_attachments['media'];
                }
                $event_lists[] = $event_list;
            }
            $data['events'] = $event_lists;
        } else {
            $data['no_event'] = 'No event found';
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Please try again.');
        $data['error_code'] = "Invalid events";
        return new WP_REST_Response($data, 403);
    }
}


function sendEmailNotification($subject = null, $message_contents = null, $transaction_id = null, $to = null)
{

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""

    );

    $from_email = 'no-reply@knoxweb.com';

    //$to = get_option('admin_email');


    //$to = 'nkumar@contriverz.com';


    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    $headers[] = 'From: ' . $from_email . "\r\n" .
        'Reply-To: ' . $from_email . "\r\n";


    $message = '<table width="600px" style="margin: 0 auto; border-collapse: collapse; border: 1px solid #dbdbdb;">
      <tr>
        <td>
           <table width="600" style="background: #000;">
            <tr>
              <td>
                 <img src="https://styletemplate.betaplanets.com/wp-content/uploads/2022/05/logo2.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding:50px 0;">
          <table width="600" style="background: #fff; border-collapse: collapse;">
      
             <tr>
              <td style="padding:20px;">
              ' . $message_contents . '
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 30px 0; line-height: 24px; ">If you have any questions please contact us at support@Zoompay.com</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Thanks,</p>
                <p style="font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 300; color: #000; text-align: left; margin: 0 0 10px 0; line-height: 24px; ">Zoompay Team</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100" style="background: #000; border-collapse: collapse;text-align:center;color:#fff;">
            <tr>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/apple.jpg" alt=""></a>
              </td>
              <td style="padding-top: 50px;">
                <a href="#"><img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/play.jpg" alt=""></a>                
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <img src="<img src="https://styletemplate.betaplanets.com/wp-content/uploads/2021/06/deco-line.png" alt="" style="display: block; margin: 10px auto;">
              </td>
            </tr>
            <tr>
              <td colspan="2" style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">
                <p style="font-family: "Poppins", sans-serif; font-size: 14px; text-align: center; color: #fff; line-height: 24px;">Copyright © 2021 Zoompay. All rights reserved. <br> You are receiving this mail bacause you opted in via our website.</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';

    $mail = wp_mail($to, $subject, $message, $headers);
}



/* Add on 04-12-2020 */

function getTermsPage($request)
{
    global $wpdb;

    $data = array(
        "status" => 200,
        "message" => "",
        'error_code' => ""
    );

    $param = $request->get_params();
    $token = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($token);

    $pagesArgs = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'include' => array(125253) // Directly query for the specific page ID
    );

    $pages = get_posts($pagesArgs);

    if (!empty($pages)) {
        $terms_page = $pages[0];
        $data['terms_page'] = array(
            array(
                'post_title' => $terms_page->post_title,
                'post_content' => $terms_page->post_content
            )
        );
    } else {
        $data['status'] = 404;
        $data['message'] = "Terms of Service page not found";
        $data['error_code'] = "terms_not_found";
    }

    return new WP_REST_Response($data, $data['status']);
}

function getPrivacyPage($request)
{
    global $wpdb;

    $data = array(
        "status" => 200,
        "message" => "",
        'error_code' => ""
    );

    $param = $request->get_params();
    $token = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($token);

    // Get the privacy policy page ID from WordPress settings
    $privacy_page_id = get_option('wp_page_for_privacy_policy');

    if (!$privacy_page_id) {
        $data['status'] = 404;
        $data['message'] = "Privacy policy page not set in WordPress settings.";
        return new WP_REST_Response($data, 404);
    }

    $privacy_page = get_post($privacy_page_id);

    if (!$privacy_page) {
        $data['status'] = 404;
        $data['message'] = "Privacy policy page not found.";
        return new WP_REST_Response($data, 404);
    }

    $data['privacy_page'] = array(
        array(
            'post_title' => $privacy_page->post_title,
            'post_content' => $privacy_page->post_content
        )
    );

    return new WP_REST_Response($data, 200);
}

function getTermsPublishedDate($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $aboutus_page_id = 3;
    $result = get_post($aboutus_page_id);
    if ($result) {
        $modified_date = get_the_modified_date('Y-m-d H:i:s', $aboutus_page_id);
        $data['privacy_modified_date'] = $modified_date;
    } else {
        $data['code'] = 404;
        $data['status'] = "error";
        $data['msg'] = "Privacy policy page not found";
    }
    return new WP_REST_Response($data, $data['code']);
}

function getPrivacyPublishedDate($request)
{
    $data = array("code" => 200, "status" => "ok", "msg" => "", 'error_code' => "");
    $aboutus_page_id = 3;
    $result = get_post($aboutus_page_id);
    if ($result) {
        $modified_date = get_the_modified_date('Y-m-d H:i:s', $aboutus_page_id);
        $data['privacy_modified_date'] = $modified_date;
    } else {
        $data['code'] = 404;
        $data['status'] = "error";
        $data['msg'] = "Privacy policy page not found";
    }
    return new WP_REST_Response($data, $data['code']);
}

/* Below code add on 09-02-2021 */
function deleteCard($request)
{

    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $usertoken = $param['token'];
    $card = $param['card'];
    $type = $param['type'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    if ($user_id) {
        require_once('stripe/init.php');
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $error = array();
        if ($type == "forinstant") {
            try {
                $stripe_account_id = get_user_meta($user_id, 'stripe_account_id', true);
                \Stripe\Account::deleteExternalAccount($stripe_account_id, $card);
            } catch (Stripe_CardError $e) {
                $error[] = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $error[] = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $error[] = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $error[] = $e->getMessage();
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $error[] = $e->getMessage();
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $error[] = $e->getMessage();
            }
        } elseif ($type == "forpayment") {
            try {
                $stripeid = get_user_meta($user_id, 'stripe_id', true);
                \Stripe\Customer::deleteSource($stripeid, $card);
            } catch (Stripe_CardError $e) {
                $error[] = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $error[] = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $error[] = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $error[] = $e->getMessage();
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $error[] = $e->getMessage();
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $error[] = $e->getMessage();
            }
        } elseif ($type == "bank_account") {
            try {
                $stripe_account_id = get_user_meta($user_id, 'stripe_account_id', true);
                \Stripe\Account::deleteExternalAccount($stripe_account_id, $card);
            } catch (Stripe_CardError $e) {
                $error[] = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $error[] = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                $error[] = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $error[] = $e->getMessage();
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $error[] = $e->getMessage();
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $error[] = $e->getMessage();
            }
        }
        if (count($error) > 0) {
            $data = array(
                "status" => "error",
                "errormsg" => "we cannot delete the default external account for your default currency.",
                'error_code' => "403",
                "error" => join(',', $error)
            );
            return new WP_REST_Response($data, 403);
        }
        return new WP_REST_Response($data, 200);
    }
    $data = array(
        "status" => "error",
        "errormsg" => "user not found",
        'error_code' => "403",
        'free_count' => false
    );
    return new WP_REST_Response($data, 403);
}
/* Upper code add on 09-02-2021 */





function getUserConnectedAccount($request)
{
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $usertoken = $param['token'];
    $user_id = GetMobileAPIUserByIdToken($usertoken);
    $user_id = 133;
    if ($user_id) {
        require_once('stripe/init.php');
        $secret_key = get_option('options_secret_key');
        $publishable_key = get_option('options_publisher_key');
        $stripe = array(
            "secret_key" => $secret_key,
            "publishable_key" => $publishable_key
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $stripeid = get_user_meta($user_id, 'stripe_id', true);
        // $stripe_account_id = "acct_1JZDeuREByjMjOky"; 
        $stripe_account_id = get_user_meta($user_id, 'stripe_account_id', true);
        //	die();
        //$retrieve = \Stripe\Accounts::retrieve('acct_1JZU5YREchrFCNYZ');
        $acct = \Stripe\Account::retrieve('acct_1JZU5YREchrFCNYZ');
        ///	$acct = \Stripe\Account::retrieve('acct_1JVUS1RNK73M8PPb');
        $card_payments  = $acct->capabilities['card_payments'];
        $transfers         = $acct->capabilities['transfers'];
        $data = array(
            "status" => "ok",
            "card_payments" => $card_payments,
            "transfers"        => $transfers,
            "account_links" => $acct
        );
        return new WP_REST_Response($data, 200);
    } else {
        $data = array(
            "status" => "error",
            "errormsg" => "user token expired",
            'error_code' => "user_expire"
        );
        return new WP_REST_Response($data, 403);
    }
}

function testToken()
{
    $plaid_client_id = get_option('plaid_client_id', true);
    $plaid_secret      = get_option('plaid_secret', true);
    $plaid_url           = get_option('plaid_url', true);

    $p_data2 = array(
        "client_id" => $plaid_client_id,
        "secret" => $plaid_secret,
        "account_id" => "vE7N43eLoQhmn8G5rGo6tVl5w8kqPJfoLvLNN",
        "access_token" => "access-sandbox-12d26b0b-dbc8-4c75-90dc-bb1c199c17e1"
    );
    // 	print_r($p_data2);
    die();
    $data_fields = json_encode($p_data2);
    $ch = curl_init('https://sandbox.plaid.com/processor/stripe/bank_account_token/create');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_fields)
        )
    );
    $token_json = curl_exec($ch);
    $result_data = json_decode($token_json, true);
    curl_close($ch);
    // 	print_r($result_data);
    $b_tok     = $result_data["stripe_bank_account_token"];
}

function get_user_informations($user_id, array $results = null, array $arg = null)
{
    global $wpdb;
    $data = array();
    if ($results == null || count($results) == 0) {
        $results = json_decode(json_encode(get_userdata($user_id), true), true);
    }

    $udata = get_userdata($user_id);
    $registered = $udata->user_registered;

    $data['join_year'] = date("M Y", strtotime($registered));
    $data['user_id'] = $user_id;
    $userdata = $results['data'];
    $data['user_email'] = $userdata['user_email'];
    $data['email'] = $userdata['user_email'];
    $data['last_name'] = get_user_meta($user_id, 'last_name', true);
    $data['first_name'] = get_user_meta($user_id, "first_name", true);
    $data['name'] = trim($data['first_name'] . " " . $data['last_name']);
    $data['display_name'] = trim($data['first_name'] . " " . $data['last_name']);

    if ($data['name'] == '') {
        $data['name'] = $data['email'];
    }
    $data['roles'] = $results['roles'];
    $data['role'] = 'player';
    if (in_array('coach', $results['roles'])) {
        $data['role'] = 'coach';
    }

    // Retrieve the avatar URL
    $avatar_meta = get_user_meta($user_id, 'simple_local_avatar', true);
    if (is_array($avatar_meta) && isset($avatar_meta['full'])) {
        $data['user_avatar'] = $avatar_meta['full'];
    } else {
        $data['user_avatar'] = get_avatar_url($user_id); // Fallback to Gravatar or default avatar
    }

    $data['phone'] = get_user_meta($user_id, 'phone', true);
    $data['project'] = get_user_meta($user_id, 'project', true);
    $data['company'] = get_user_meta($user_id, 'company', true);
    $data['street1'] = get_user_meta($user_id, 'street1', true);
    $data['street2'] = get_user_meta($user_id, 'street2', true);
    $data['city'] = get_user_meta($user_id, 'city', true);
    $data['state'] = get_user_meta($user_id, 'state', true);
    $data['zipcode'] = get_user_meta($user_id, 'zipcode', true) ?: "";
    $data['about'] = get_user_meta($user_id, 'description', true);
    $data['setting'] = get_user_meta($user_id, 'setting', true);
    $data['city_state'] = $data['city'] . ", " . $data['state'];

    return $data;
}


function getAllPost()
{

    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );


    $post_lists = array();
    $post_list = array();
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $post_posts = get_posts($args);

    if (count($post_posts) > 0) {

        foreach ($post_posts as $post) {
            $post_list['post_id'] = $post->ID;
            $post_list['post_title'] = $post->post_title;
            $post_lists[] = $post_list;
        }

        $data['posts'] = $post_lists;
    } else {
        $data['no_post'] = 'No post found';
    }
    return new WP_REST_Response($data, 200);
}

function getPostsByCategories()
{
    global $wpdb;

    $data = array(
        "status" => "ok",
        "errormsg" => "",
        "error_code" => ""
    );

    $categories = get_categories(array(
        'orderby' => 'name',
        'order' => 'ASC'
    ));

    if (count($categories) > 0) {
        $category_data = array();

        foreach ($categories as $category) {
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category' => $category->term_id
            );

            $posts_in_category = get_posts($args);
            $post_list = array();

            if (count($posts_in_category) > 0) {
                foreach ($posts_in_category as $post) {
                    $post_data = array(
                        'post_id' => $post->ID,
                        'post_title' => $post->post_title,
                        'post_content' => $post->post_content,
                        'featured_image' => get_the_post_thumbnail_url($post->ID, 'full'),
                        'post_date' => get_the_date('m-d-Y', $post) // ISO 8601 format

                    );
                    $post_list[] = $post_data;
                }
            }

            $category_data[] = array(
                'category_id' => $category->term_id,
                'category_name' => $category->name,
                'posts' => $post_list
            );
        }

        $data['categories'] = $category_data;
    } else {
        $data['no_categories'] = 'No categories found';
    }

    return new WP_REST_Response($data, 200);
}


function getSinglePost($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    $param = $request->get_params();
    $post_id = $param['post_id'];
    $table_name = $wpdb->prefix . "posts";
    $where_condition = " post_status='publish' AND ID ='$post_id' AND post_type='post'";
    $sql_query = "SELECT ID, post_title, post_content,   FROM $table_name WHERE $where_condition";
    $listings = $wpdb->get_results($sql_query);
    if (count($listings) > 0) {
        $listingData['feature_image'] = get_the_post_thumbnail_url($listings[0]->ID, 'full');
        $listingData['post_id'] = $listings[0]->ID;
        $listingData['post_title'] = $listings[0]->post_title;
        $listingData['post_fulldescription'] = $listings[0]->post_content;
        $listingData['post_datetime'] = $listings[0]->post_date;
        $data['status_code'] = 200;
        $data['listing'] = $listingData;
        return new WP_REST_Response($data, 200);
    } else {
        $data['status_code'] = 201;
        $data['msg'] = 'No post found';
        return new WP_REST_Response($data, 401);
    }
}





function GetMyMessages($request)
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    // $param = $request->get_params();
    $param = $request->get_json_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $data['token'] = $param['token'];
    // $data['token'] = 'test token';
    // $data['user_id'] = GetMobileAPIUserByIdToken($param['token']);
    // $user_id = 3;

    if ($user_id) {
        $message_lists = array();
        $message_list = array();

        $query = $wpdb->prepare("
            SELECT * 
            FROM {$wpdb->prefix}custom_messages");
        $message_posts = $wpdb->get_results($query);

        if (count($message_posts) > 0) {
            foreach ($message_posts as $message) {
                $message_list['id'] = $message->id;
                $message_list['sender_id'] = $message->sender_id;
                $message_list['recipient_id'] = $message->recipient_id;
                $message_list['message_text'] = $message->message_text;
                $message_list['timestamp'] = $message->timestamp;

                $message_lists[] = $message_list;
            }

            $data['status'] = "success";
            $data['messages'] = $message_lists;
        } else {
            $data['no_message'] = 'No message found';
        }
        return new WP_REST_Response($data, 200);
    } else {
        $data['status'] = "error";
        $data['errormsg'] = __('Please try again.');
        $data['error_code'] = "Invalid events";
        return new WP_REST_Response($data, 403);
    }
}

function get_ai_welcome($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    // $param = $request->get_params();
    $param = $request->get_json_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $data['token'] = $param['token'];
    // $data['token'] = 'test token';
    // $data['user_id'] = GetMobileAPIUserByIdToken($param['token']);
    // $user_id = 3;

    if ($user_id) {
        $default_message = 'Welcome, I am the ' . $site_title . ' AI Bot. <br>I\'m here to assist you. <br>Please enter your question in the field below.';
        $welcome_message = get_option('openai_gpt_intro_message', $default_message);
        // $welcome_message = get_option('openai_gpt_welcome_message', $default_message);
        if ($welcome_message === '') {
            $formatted_message = $default_message;
        } else {
            $formatted_message = wpautop($welcome_message);
        }

        $data['status'] = "success";
        $data['message'] = $formatted_message;
    } else {
        $data['no_message'] = $default_message;
    }
    return new WP_REST_Response($data, 200);
}

function get_ai_api_url($request)
{
    global $wpdb;
    $data = array(
        "status" => "ok",
        "errormsg" => "",
        'error_code' => ""
    );
    // $param = $request->get_params();
    $param = $request->get_json_params();

    $user_id = GetMobileAPIUserByIdToken($param['token']);
    $data['token'] = $param['token'];
    // $data['token'] = 'test token';
    // $data['user_id'] = GetMobileAPIUserByIdToken($param['token']);
    // $user_id = 3;

    if ($user_id) {
        $ai_api_url = get_option('bluestoneapps_ai_api_url', '');

        $data['status'] = "success";
        $data['message'] = $ai_api_url;
    } else {
        $data['no_message'] = 'No AI API URL found';
    }
    return new WP_REST_Response($data, 200);
}
