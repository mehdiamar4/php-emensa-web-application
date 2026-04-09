<?php

class AbmeldungController
{
    public function index(RequestData $request)
    {
        $name = $_SESSION['user_name'] ?? 'unknown';

        logger()->info("Logout: " . $name);

        session_unset();
        session_destroy();

        header("Location: /");
        exit;
    }

}
