<?php

$post = $_POST;
$errors = [];
$error_redirect = basename($_SERVER['PHP_SELF'], '.php');

function check_string(string $var, string $alt = ''): string {
    return !empty(trim($var)) ? $var : $alt;
}

function get_inits(string $var): string {
    $split = explode(' ', trim($var), 2);
    if ( count($split) < 2 )
        return substr($split[0], 0, 2);

    $inits = '';
    for ($i = 0; $i < count($split); $i++) {
        $inits .= strtoupper(substr($split[$i], 0, 1));
    }
    return $inits;
}

// die n dump
function dd($var) : void {
    print_r($var);
    exit;
}

// for top spacing
function top_space (int $num = 3) : void {
    $i = 0;
    while ( $i < $num ) {
        echo '<br>';
        $i++;
    }
}

function ddd($var, int $num = 3) : void {
    top_space($num);
    dd($var);
}

function readable_key($key): string {
    return ucfirst(trim(implode(' ', explode('_', $key))));
}

function toast_errors(): void {
    if ( isset($_SESSION['errors']) && count($_SESSION['errors']) ) {
        foreach ( $_SESSION['errors'] as $error ) {
          echo "<script>toastr.error('$error')</script>";
        }
        unset($_SESSION['errors']);
    }

    if ( isset($_SESSION['success']) && count($_SESSION['success']) ) {
        foreach ( $_SESSION['success'] as $msg ) {
          echo "<script>toastr.success('$msg')</script>";
        }
        unset($_SESSION['success']);
    }
}

function validate_empty_fields (array $post, array $required = []): void {
    $required = count($required) ? $required : array_keys($post);
    $error_redirect = $GLOBALS['error_redirect'];
    $errors = [];
    $vars = [];
    foreach ( $post as $key => $value ) {
        if ( empty(trim($value)) && in_array($key, $required) ) {
            array_push($errors, readable_key($key) . ' can not be empty');
        } else if ( $key != 'password' && $key != 'confirm_password' ) {
            $_SESSION[$key] = $value;

            $short_key = explode('_', $key)[0];
            global $$short_key;
            $$short_key = $key == 'email' ? strtolower(trim($value)) : trim($value);
        } else {
            $short_key = explode('_', $key)[0];
            global $$short_key;
            $$short_key = $value;
        }
    }

    if ( $error_redirect == 'signup' ) {
        if ( !isset($post['agree']) || empty($post['agree']) ) {
            array_push($errors, 'Agree to the terms and conditions to continue');
        }        
    }
    check_errors($errors);
}

function check_errors(array $errors): void {
    if ( count($errors) ) {
        $error_redirect = $GLOBALS['error_redirect'];
        $params = count($_GET) ? '?'.http_build_query($_GET) : '';

        $errors = array_reverse($errors);
        $_SESSION['errors'] = $errors;

        header("Location: ../".$error_redirect.".php".$params);
        die();
    }
}

function on_success (string $path): void {
    $params = count($_GET) ? '?'.http_build_query($_GET) : '';
    header("Location: ./../".$path.".php".$params);
    die();
}

function logout(bool $from_form = true): void {
    $from_form ? header("Location: ./../logout.php") : header("Location: ./logout.php");
    die();
}

function session_val(string $key): string {
	return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
}

function clear_sessions(): void {
	foreach ( $_SESSION as $key => $value ) {
		if ( $key != 'user' )
			unset($_SESSION[$key]);
	}
}

function is_logged_in(): bool {
    return isset($_SESSION['uuid']) && !empty($_SESSION['uuid']);
}

function clear_cookies(string $key) {
    if (isset($_COOKIE[key])) {
        unset($_COOKIE[key]);
        setcookie(key, '', time() - 3600, '/');
    }
}

function show_error(): string {
    $error = "";
    if ( isset($_SESSION['errors']) && !empty($_SESSION['errors']) && count($_SESSION['errors'])) {
        $error = $_SESSION['errors'][0] ?? '';
        unset($_SESSION['errors']);
    }
    return $error;
}