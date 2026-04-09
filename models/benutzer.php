<?php
/**
 * This file contains all SQL statements for the table "benutzer"
 */

function db_benutzer_select_by_email(string $email)
{
    try {
        $link = connectdb();

        $sql = "SELECT id, name, email, passwort, admin
                FROM benutzer
                WHERE email = ?";

        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        mysqli_close($link);
    } catch (Exception $ex) {
        $data = null;
    } finally {
        return $data;
    }
}

/**
 * SQL for table "benutzer"
 */

function db_benutzer_increment_anzahlanmeldungen(int $id): void
{
    $link = connectdb();

    $sql = "UPDATE benutzer
            SET anzahlanmeldungen = anzahlanmeldungen + 1
            WHERE id = ?";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($link);
}
function db_benutzer_update_letzteanmeldung(int $id): void
{
    $link = connectdb();

    $sql = "UPDATE benutzer
            SET letzteanmeldung = NOW()
            WHERE id = ?";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($link);
}

function db_benutzer_update_letzterfehler(int $id): void
{
    $link = connectdb();

    $sql = "UPDATE benutzer
            SET letzterfehler = NOW()
            WHERE id = ?";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($link);
}
function db_benutzer_login_transaction(string $email, string $hash): array
{
    $link = connectdb();

    mysqli_begin_transaction($link);

    // 1) Read user by email
    $sql = "SELECT id, name, email, passwort, admin
            FROM benutzer
            WHERE email = ?";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    $success = false;

    // 2) Success -> call procedure + update letzteanmeldung
    if ($user && $user['passwort'] === $hash) {
        $success = true;

        // call stored procedure to increment counter
        $sql2 = "CALL increment_login_counter(?)";
        $stmt2 = mysqli_prepare($link, $sql2);
        mysqli_stmt_bind_param($stmt2, "i", $user['id']);
        mysqli_stmt_execute($stmt2);

        // update last login timestamp
        $sql3 = "UPDATE benutzer
                 SET letzteanmeldung = NOW()
                 WHERE id = ?";

        $stmt3 = mysqli_prepare($link, $sql3);
        mysqli_stmt_bind_param($stmt3, "i", $user['id']);
        mysqli_stmt_execute($stmt3);
    }
    // 3) Fail, but user exists -> update letzterfehler
    elseif ($user) {
        $sql4 = "UPDATE benutzer
                 SET letzterfehler = NOW()
                 WHERE id = ?";

        $stmt4 = mysqli_prepare($link, $sql4);
        mysqli_stmt_bind_param($stmt4, "i", $user['id']);
        mysqli_stmt_execute($stmt4);
    }

    mysqli_commit($link);
    mysqli_close($link);

    return [
        'success' => $success,
        'user' => $success ? $user : null
    ];
}
