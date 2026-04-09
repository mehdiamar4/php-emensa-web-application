@extends("layouts.app")

@section("content")
    <div class="page">

        @if (!empty($userName))
            <div class="login-status">
                <span>Angemeldet als {{ $userName }}</span>
                <a href="/abmeldung">Abmelden</a>
            </div>
        @endif

            <header>
                <div class="box logo">
                    <img src="/img/LOGO_mensa.jpg" alt="E-Mensa Logo">
                </div>

                <div class="box menu">
                    <nav>
                        <ul>
                            <li><a href="#ankuendigung">Ankündigung</a></li>
                            <li><a href="#speisen">Speisen</a></li>
                            <li><a href="#wichtig">Wichtig für uns</a></li>
                        </ul>
                    </nav>
                </div>
            </header>

            <hr>

            <main>
                {{-- Hero Bild --}}
                <img class="hero" src="/img/Mensa Academica.jpg" alt="Mensa Academica">


                <h1 id="ankuendigung">Bald gibt es Essen auch online ;)</h1>

            <div class="box textbox">
                <p>
                    Willkommen bei der E-Mensa! Bald können Sie Ihr Essen bequem online auswählen
                    und in unserer Mensa genießen.
                </p>
            </div>

            <section id="speisen">
                <h1>Köstlichkeiten, die Sie erwarten</h1>

                <div class="tablebox">
                    <table>
                        <thead>
                        <tr>
                            <th>Bild</th>
                            <th>Gericht</th>
                            <th>Preis intern</th>
                            <th>Preis extern</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($gerichte as $g)
                            @php
                                $bild = !empty($g['bildname'])
                                        ? $g['bildname']
                                        : '00_image_missing.jpg';
                            @endphp

                            <tr>
                                <td>
                                    <img src="/img/gerichte/{{ $bild }}"
                                         alt="{{ $g['name'] }}"
                                         width="120" height="80">
                                </td>

                                <td>
                                    <strong>{{ $g['name'] }}</strong><br>
                                    <small>{{ $g['beschreibung'] }}</small>
                                </td>

                                <td>{{ number_format($g['preisintern'] ?? 0, 2) }} €</td>
                                <td>{{ number_format($g['preisextern'] ?? 0, 2) }} €</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </section>

            <section id="wichtig">
                <h2>Das ist uns wichtig</h2>
                <ul>
                    <li>Beste frische saisonale Zutaten</li>
                    <li>Ausgewogene abwechslungsreiche Gerichte</li>
                    <li>Sauberkeit</li>
                </ul>

                <h2>Wir freuen uns auf Ihren Besuch!</h2>
            </section>

            <hr class="closing-line">

            <footer>
                <div class="footer">
                    <span>&copy; E-Mensa GmbH</span>
                    <span>&lt;Mehdi und Malek&gt;</span>
                    <span><a href="#impressum">Impressum</a></span>
                </div>
            </footer>
        </main>
    </div>
@endsection

@section("cssextra")
    <link rel="stylesheet" href="/css/emensa.css">
@endsection
