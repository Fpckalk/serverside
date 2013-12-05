<?php
	// Hey, je leest dit waarschijnlijk om achter m'n functies te komen.
	// Maar om eerlijk te zijn heb ik hier nog best moeite mee, ik heb het gevoel dat deze manier niet klopt.
	// Deze code stond eerst allemaal in index.php, ik heb er alleen functies van gemaakt die totaal niet flexibel zijn.

	// Getting there though!



	// Zonder dit moet de gebruiker zelf de pagina herladen. Misschien fix ik het later wel.
	function reloadPage() {
		header('Location:' . $_SERVER['PHP_SELF'] . '', true, 302);
		exit;
	}

	// Deze functie is zelf geschreven omdat we de les hier in nog niet hadden gekregen. Ook opt ik er voor
	// deze code te blijven gebruiken in plaats van de uitgereikte, aangezien deze handelt met de database en het ook doet.
	function logIn() {
		// Log in en zet gebruiker session
		$loggedin = isset($_SESSION['gebruiker']);
		if ($loggedin) {
			$u = $_SESSION['gebruiker'];
			$con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $con);
			$score = mysql_query("SELECT punten FROM wg_user WHERE naam = '$u'");
			$score = mysql_result($score, 0);
			echo "Hey " . $_SESSION['gebruiker'] . "<br />";
			echo "Score: " . $score . "<br />";
			echo '
				<a id="log_out" href="' . $_SERVER['PHP_SELF'] . '?LogUit">Log uit</a>
			';
			if (isset($_GET['LogUit'])) {
				unset($_SESSION['gebruiker']);
				reloadPage();
			}
		} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord'])) {
				$con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
				if (!$con) {
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db(MYSQL_DB, $con);
				$u = $_POST['gebruikersnaam'];
				$p = md5($_POST['wachtwoord']);
				$res = mysql_query("SELECT COUNT(*) FROM wg_user WHERE naam = '$u' AND wachtwoord = '$p'");
				$row = mysql_fetch_row($res);
				if($row[0] == 1) {
					$_SESSION['gebruiker'] = $u;
					reloadPage();
				} else {
					echo "Weet je zeker dat je het goed hebt? Je gegevens kwamen niet overeen met onze gebruikers.";
				}
		}
	}

	// Registreer de gebruiker in de database
	function register() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registreer_gebruikersnaam']) && isset($_POST['registreer_wachtwoord']) && isset($_POST['registreer_email'])) {
			mysql_select_db(MYSQL_DB, $con);
			$u = $_POST['registreer_gebruikersnaam'];
			$p = md5($_POST['registreer_wachtwoord']);
			$e = $_POST['registreer_email'];
			$res = mysql_query("SELECT COUNT(*) FROM wg_user WHERE naam = '$u' ");
			$row = mysql_fetch_row($res);
			if ($row[0] == 0) {
				mysql_query("INSERT INTO wg_user (naam, wachtwoord, email) VALUES ('$u', '$p', '$e')");
			} else {
				echo "Helaas, die gebruikersnaam is al bezet.<br />Tip: Wees origineel";
			}
		}
	}

	// Check of 'woord' is ingevuld en of deze al in de database staat
	function checkWord() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['woord']) && $_POST['woord'] != '' && is_string($_POST['woord']) && preg_match("/^[a-zA-Z]+$/", $_POST['woord'])) {
			if (is_string($_POST['woord'])) {
				// Zet user input als var 'woord'
				$woord = $_POST['woord'];
				$woord = ucfirst(strtolower($woord));

				// Zet huidige gebruiker
				$loggedin = isset($_SESSION['gebruiker']);
				if($loggedin) {
					$u = $_SESSION['gebruiker'];
				} else {
					$u = 'anonymous';
				}

				// Connect to database
				$con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
				if (!$con) {
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db(MYSQL_DB, $con);

				$res = mysql_query("SELECT COUNT(*) FROM wg_words WHERE woord = '$woord' ") or die('Could not connect: ' . mysql_error());
				$row = mysql_fetch_row($res); // Gebruik geen fetch_row maar fetch_object
				if ($row[0] == 0)
				{
					mysql_query("INSERT INTO wg_words VALUES ('$woord', 1, '$u', CURDATE())");
					echo $woord . "<br />";

					// Check how much words there currently are in the database, adjust user's score
					$count = mysql_query("SELECT COUNT(*) FROM wg_words") or die('Could not connect: ' . mysql_error());
					$count = mysql_result($count, 0);
					$score = ceil(0.2 * $count);
				    echo 'Gefeliciteerd! ' . $score . ' punten!';
				    if ($loggedin) {
				    	mysql_query("UPDATE wg_user SET punten = punten + '$score' WHERE naam = '$u'");
				    }
				}
				else
				{
					echo $woord . "<br />";
					mysql_query("UPDATE wg_words SET aantal_geraden = aantal_geraden + 1 WHERE woord = '$woord'");
				    $query = mysql_query("SELECT gebruiker FROM wg_words WHERE woord = '$woord'");
				    $other_user = mysql_fetch_row($query);
				    echo '		Nop! ' . $other_user[0] . ' was je voor.';
				}
			}
		}
	}

?>