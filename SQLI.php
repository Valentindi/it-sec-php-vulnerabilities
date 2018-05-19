<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection</title>
</head>
<body>
<h2>SQL Injection</h2>

<?php

// Erstellen der DB mit Tabellen
$db = new SQLite3( "my_db.sqlite3" );
$db->exec( "CREATE TABLE IF NOT EXISTS users(
   id INTEGER PRIMARY KEY AUTOINCREMENT, 
   username TEXT NOT NULL DEFAULT '0',
   password TEXT NOT NULL DEFAULT '0')" );

if ( $_GET["action"] == "all" ) {
    // Ausgabe aller Actions
	echo "<ul>";
	$table = $db->query( "SELECT * FROM users" );
	while ( $row = $table->fetchArray() ) {
		echo "<li>" . $row["username"] . " - " . $row["password"] . "</li>";
	}

	echo "</ul>";
} elseif ( $_GET["action"] == "add" ) {
    // Hinzufügen eines Datensatzes
	echo( "INSERT INTO users(username, password) VALUES (\"" . $_GET["username"] . "\", \"" . $_GET["password"] . "\")" );
	$db->exec( "INSERT INTO users(username, password) VALUES (\"" . $_GET["username"] . "\", \"" . $_GET["password"] . "\")" );
	echo "<p>User " . $_GET["username"] . " hinzugefügt</p>";
} else {

    //Überprüfen ob Passwort und Username korrekt sind
	echo( "SELECT username FROM users WHERE username LIKE \"" . $_GET["username"] . "\" AND password LIKE \"" . $_GET["password"] . "\"" );

	$results = $db->query( "SELECT username FROM users WHERE username LIKE \"" . $_GET["username"] . "\" AND password LIKE \"" . $_GET["password"] . "\"" );
	//echo  count($results->fetchArray())."\n\n";
	$table = $results->fetchArray();
	$row   = $table[0];
	if ( count( $table ) == 0 ) {
		echo "Username oder Passwort falsch!";
	} else {
		echo "Hallo " . $table["username"] . "!";
	}

}
?>
</body>
</html>