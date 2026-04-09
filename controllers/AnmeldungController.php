<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/benutzer.php');

class AnmeldungController
{
    public function index(RequestData $request)
    {
        // Show error message once (if any)
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        return view('anmeldung', [
            'error' => $error
        ]);
    }

    public function verfizieren(RequestData $request)
    {
        $post = $request->getPostData();

        $email = trim($post['email'] ?? '');
        $passwort = $post['passwort'] ?? '';

        // Global salt for the whole application
        $salt = "eM5!";

        // SHA-1 hash
        $hash = sha1($salt . $passwort);

        // All login SQL runs inside one transaction in this model function
        $result = db_benutzer_login_transaction($email, $hash);

        if ($result['success']) {
            $user = $result['user'];

            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_admin'] = (int)$user['admin'];

            logger()->info("Login successful: " . $email);

            header("Location: /");
            exit;
        }

        logger()->warning("Login failed: " . $email);

        $_SESSION['login_error'] = "Login failed: email or password is wrong.";
        header("Location: /anmeldung");
        exit;
    }
}
