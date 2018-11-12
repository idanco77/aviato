<?php

if (!function_exists('old')) {

    function old($fn) {
        return isset($_REQUEST[$fn]) ? $_REQUEST[$fn] : '';
    }

}

// database connection to real server
if ($_SERVER['SERVER_ADMIN'] == 'webmaster@aviato.idan.work') {
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'portu');
    define('MYSQL_PASSWORD', 'porty3709');
    define('MYSQL_DATABASE', 'aviato_db');
} else {
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', '');
    define('MYSQL_DATABASE', 'aviato_db');
}



if (!function_exists('csrf')) {

    function csrf() {
        $token = sha1('the_blog' . rand(1, 1000) . date('Y.m.d.H.i.s') . '#$');
        $_SESSION['token'] = $token;
        return $token;
    }

}

if (!function_exists('my_session_start')) {

    function my_session_start($name = null) {
        session_set_cookie_params(60 * 60 * 24 * 30);
        if (!is_null($name)) {
            session_name($name);
        }
        session_start();
        session_regenerate_id();
    }

}

if (!function_exists('verify_user')) {

    function verify_user() {
        $verify = false;
        if (isset($_SESSION['id'])) {
            if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {
                if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
                    $verify = true;
                }
            }
        }
        return $verify;
    }

}

if (!function_exists('email_exist')) {

    function email_exist($link, $email) {
        $exist = false;
        $sql = "SELECT email FROM users WHERE email'$email' LIMIT 1";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $exist = true;
        }
        return $exist;
    }

}

$messages = [
    1 => 'you signed up successfully. welcome to the blog',
    2 => 'your post created successfully',
    3 => 'your post edited successfully',
    4 => 'your post deleted successfully',
    5 => 'goodbye. see you soon',
    6 => 'welcome back',
];
