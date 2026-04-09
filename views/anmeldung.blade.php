<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anmeldung</title>
</head>
<body>

<h1>Anmeldung</h1>

@if (!empty($error))
    <p style="color: red;">{{ $error }}</p>
@endif

<form action="/anmeldung_verfizieren" method="post">
    <label for="email">E-Mail</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="passwort">Passwort</label><br>
    <input type="password" id="passwort" name="passwort" required><br><br>

    <button type="submit">Anmeldung</button>
</form>

</body>
</html>
