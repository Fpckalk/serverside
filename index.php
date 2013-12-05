<? include_once("includes/header.php");

// Gebruikersregistratie en login
// Laat de formulieren voor login en registratie zien
if (!isset($_SESSION['gebruiker'])) {
	echo '
			<div id="gebruiker">
				<div id="login">
					<form id="login_formulier" action="' . $_SERVER['PHP_SELF'] . '" method="POST" type="text/plain">
						<label for="gebruikersnaam">Gebruikersnaam</label>	<input id="gebruikersnaam" type="text" name="gebruikersnaam" />
						<label for="wachtwoord">Wachtwoord</label>	<input id="wachtwoord" type="password" name="wachtwoord" />
						<input class="gebruiker_button" type="submit" value="Log in!" />
					</form>
				</div>
				<div id="registratie">
					<form id="registratie_formulier" action="' . $_SERVER['PHP_SELF'] . '" method="POST" type="text/plain">
						<label for="registreer_gebruikersnaam">Gebruikersnaam</label>	<input id="registreer_gebruikersnaam" type="text" name="registreer_gebruikersnaam" />
						<label for="registreer_wachtwoord">Wachtwoord</label>	<input id="registreer_wachtwoord" type="password" name="registreer_wachtwoord" />
						<label for="registreer_email">E-mail</label>	<input id="registreer_email" type="email" name="registreer_email" />
						<input class="gebruiker_button" type="submit" value="Maak account!" />
					</form>
				</div>
				<a id="login_registreer">Registratie formulier</a>
				<div class="clear"></div>
			</div>
	';
}

logIn();

register();

// Het spelgedeelte
// Laat de uitleg en het formulier zien
echo '
			<form id="woord_form" action="' . $_SERVER['PHP_SELF'] . '" method="POST" type="text/plain">
				<input id="woord_input" type="text" name="woord" maxlength="22" autofocus="autofocus" autocomplete="off" />
				<input id="woord_check" type="submit" value="Check!" />
				<div class="clear"></div>
			</form>
';

checkWord();

include_once("includes/footer.php"); ?>