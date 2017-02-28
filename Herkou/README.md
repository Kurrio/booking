Hva n�r man f�r den her feilmeldingen?
##The only supported ciphers are AES-128-CBC and AES-256-CBC

- $ php artisan key:generate --show
	kopier denne, med base64 og alt, lim inn i .env filen (APP_KEY), og kj�r 'heroku config:set APP_KEY=�' hvor ... tilsvarer HELE key'en.

- bruk php artisan config:clear
- bruk php artisan cache:clear
- git add .
- git commit -m "something"
- git push heroku master

Hvordan sl� p� debug?

'debug' => env('APP_DEBUG', true), i app.php
OG 'log' => 'errorlog', under Logging Configuration i app.php

Hva med heroku php buildpack for � f� apache ting i bin mappen?
"heroku/heroku-buildpack-php": "*"
	denne inn i composer.json, under require-dev og s� ta composer update

HOW TO SET UP HEROKU WITH LARAVEL (Sammen med heroku sin laravel-guide):

#1 F�lg guide p� heroku med sette opp laravel i mappe, initialisere git.
#2 F�lg guide p� heroku med � lage Procfile
#3 Legg til heroku buildpack for php (m� ha med denne for � f� apache server satt opp riktig i laravel-mappene)
	G� inn i composer.json
		G� til require-dev
			Sett inn ,"heroku/heroku-buildpack-php": "*"		(husk � sette komma f�rst)
	Kj�r komandoen 'composer update' i komandolinjen for mappen
	Kj�r php artisan config:clear
	Kj�r php artisan cache:clear
#4 Sl� p� debug for laravel og heroku s�nn at laravel gir feilmeldinger i nettleseren
	G� inn i config/app.php
		G� til overskrift "Application Debug Mode"
			Sett 'debug' => env('APP_DEBUG', true)
		G� til overskrift "Logging Configuration"
			Sett inn 'log' => 'errorlog',
#5 F�lg guide p� heroku med � lage ny app p� heroku (git add. + git commit + heroku create)
#6 F�lg guide p� heroku med � sett opp en ny Laravel encryption key (kopier HELE key-en, med base 64 og alt)
	Kj�r php artisan config:clear
	Kj�r php artisan cache:clear
#7 F�lg guide p� heroku med � pushe/deploye til heroku (git add. + git commit + git push heroku master)
#8 �pne med heroku open eller g� til nettsideadressen du fikk av heroku create komandoen
	N� skal det vises laravel-forsiden


HOW TO SET UP HEROKU WITH LARAVEL + PGSQL DATABASE

#1 Legg til heroku postgresql addon til laravel-prosjektet, i kommandolinjen
	heroku addons:create heroku-postgresql:hobby-dev
#2 Sett opp Laravel med PostgreSQL, i database filen config/database.php
	Sett inn disse parameterene �verst (etter <?php)
		$url = parse_url(getenv("DATABASE_URL"));
		$host = $url["host"];
		$username = $url["user"];
		$password = $url["pass"];
		$database = substr($url["path"], 1);
	Under overskrifte 'Default Database Connection Name' endre til pgsql
		'default' => env('DB_CONNECTION', 'pgsql'),
	Endre feltene under 'Database Connections' slik at de viser til feltene �verst:
		'host' => env('DB_HOST', $host),
		'port' => env('DB_PORT', '5432'),
		'database' => env('DB_DATABASE', $database),
		'username' => env('DB_USERNAME', $username),
		'password' => env('DB_PASSWORD', $password),
#3 Git add og commit + git push heroku master
#4 Migrate database-tabeller, slik at de blir opprettet p� heroku databasen (laravel sine 2 standard tabeller dersom ingen andre har blitt lagt inn)
	heroku run php artisan migrate
		yes	// lager to tabeller som f�lger med laravel (database/migrations/)
#5 Teste man kan hente ut fra og sette inn i tabeller i databasen, bruke eksempel-tabellen 'users' fra laravel
	G� til resources/routes/web.php og sett inn en oppf�ring i 'Users' tabellen:
		Route::get('/test', function () {
			DB::table('users')->insert([
				'id' => '1', 'name' => "Andreas", 'email' => 'aks1992@gmail.com', 'password' => 'nope',
			]);

			$users = DB::table('users')->get();

			dd($users);
		});
#6 Git add og commit + git push heroku master, heroku open og s� sett p� /test bak adressen i adresselinjen i nettleseren og last inn
	Du skal n� f� opp et JSON objekt med det du satt inn i 'users' tabellen
#7 Kommenter ut/slett hele DB::table() delen da denne vil sette inn det samme p� nytt, og da vil du f� error fordi du allerede har oppf�ringen lagt i databasen fra f�r (kan feks bare ha id=1 �n gang). Hver gang du �pner nettsiden vil den pr�ve uten hell � legges inn p� nytt ellers. Kommenter ut dd($users) ogs�
#8 Opprett en ny mappe 'test' inni 'views' mappen i resources/views
#9 Opprett en ny fil 'testing.blade.php' inni 'test' mappen
#10 Sett opp HTML struktur + loop som g�r gjennom objektene som hentes ut fra databasen:
	<ul>
		@foreach ($users as $user)
		<li>
			{{ $user->name }}
		</li>
		@endforeach
	</ul>
#11 G� tilbake til resources/routes/web.php og send $users til testing view'et
	return view('test.testing', compact('users'));
#12 Git add og commit + git push heroku master, heroku open og s� sett p� /test bak adressen i adresselinjen i nettleseren og last inn
#13 Du skal n� se en liste av navn (forel�pig bare ett element i listen)