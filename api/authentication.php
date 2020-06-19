<?php
/**
 * REST API Methods for authentication.
 */
include_once './user.php';
include_once './core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

class Authentication {
    public static function login($params) {
        global $key, $iss, $aud, $iat, $nbf, $exp;
        // get posted data
        $decodedParams = json_decode($params, true);
        // set product property values
        $user = User::getUserForAuthentication($decodedParams['username']);
        // check if email exists and if password is correct
        if($user != null && password_verify($decodedParams['password'], $user['password'])){
            $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "user" => array(
                "id" => $user['id'],
                "username" => $user['username'],
                "firstName" => $user['first_name'],
                "lastName" => $user['last_name'],
                "userType" => $user['user_type'],
                "birthDate" => $user['birth_date'])
            );
            $_SESSION['user_id'] = $user['id'];
            // set response code
            http_response_code(200);
            // generate jwt
            $jwt = JWT::encode($token, $key);
            echo json_encode(
                    array(
                        "message" => "Successful login.",
                        "jwt" => $jwt,
                        "user" =>  array(
                            "id" => $user['id'],
                            "username" => $user['username'],
                            "firstName" => $user['first_name'],
                            "lastName" => $user['last_name'],
                            "userType" => $user['user_type'],
                            "birthDate" => $user['birth_date']
                        )
                    )
                );
        } else { //login failed
            // set response code
            http_response_code(401);
            // tell the user login failed
            echo json_encode(array("message" => "Login failed."));
        }
    }

    public static function logout($params) {

    }

    public static function verifyToken($params) {
        global $key;
        // get jwt
        $jwt = isset($params->jwt) ? $params->jwt : "";
        // if jwt is not empty
        if ($jwt) {
            // if decode succeed, show user details
            try {
                // decode jwt
                $decoded = JWT::decode($jwt, $key, array('HS256'));
                // access granted
                return true;
            }catch (Exception $e){ // if decode fails, it means jwt is invalid
                // tell the user access denied  & show error message
                return false;
            }
        } else { // show error message if jwt is empty
            // tell the user access denied
            return false;
        }
    }

}
