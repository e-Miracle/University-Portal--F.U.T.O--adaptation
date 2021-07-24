<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

/**
 * define base url or domain name
 */
$url = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
define("BASE_URL", dirname(__DIR__));
define("WEB_URL", dirname('localhost:8080'));
/**
 * define the website name to avoid repetition
 */
define('SITE_NAME', 'CRUIZTOPIA TOURS');

/**
 * true if you want to show errors to user or false if you
 * want to redirect to custom error page
 */
define("DISPLAY_ERRORS", true);

/**
 * DATABASE CONNECTION
 */
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'project');

/**
 * Token name for form fields
 */
define('TOKEN_NAME', 'making_sure_forms_are_filled_correctly');

/**
 * Token name for captcha area
 */
define('CAPTCHA_NAME', 'making_sure_you_are_human');

/**
 * define flash message session name
 */
define('FLASH_MESSAGE', 'message_flash');

/**
 * general encryption key for encrypting data on this app
 * change it if need be
 */
define('ENCRYPTION_KEY', '57f1c1e11d0d710529cae5fbc02d9bd9744b21ac59fe58170e5f1bab55697fb685efe9d19c0568286664b2ce5f539017d71dcdd83bd43494b77d0cdbf4bfba0e34d4740929765201357d100b961708a0ac124901e001dc6d04d5d63755a447cc43e3b383e92a674610b3276fa1378c273c6485a748e85abe1f1b5b31a0cf');

/**
 * cipher or encryption method, anything you want to call it
 */
define('CIPHER', 'aes-128-gcm');

/**
 * File upload settings
 */
define('DEFAULT_FILE_DESTINATION', 'assets/uploads/propics/');

/**
 * Base Cookie name and expiry is defined below
 */
define('COOKIE_NAME', '_1_CRUIZTOPIA');
define('COOKIE_EXPIRY', 604800);

/**
 * PayStack payment settings
 */
define('PAYSTACK_SECRET_KEY', 'sk_test_cac731e5e89829be50e1592db31c606e1347c3b4');

/**
 * define the number of tours per page
 */
define('TOURS_PER_PAGE', 8);

/**
 * define the link session name
 */
define('NAVIGATION', 'link');

/**
 * mail parameters
 */
define('SENDER', 'no-reply@cruiztopia.com');

/**
 * google login parameters
 */
define('CLIENT_ID', '150800597884-ejo34vkrep9r3vnivn290igdeosikfsa.apps.googleusercontent.com');
define('CLIENT_SECRET', '9u3UV117R6DSzhvy5nOPuLg1');
define('REDIRECT_URL', 'http://localhost:8080/google-login');