<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection</title>
</head>
<body>
<h2>SQL Injection</h2>

<?php

// Erstellen der DB mit Tabellen mit PDO
$db = new PDO( "sqlite:my_db.sqlite3" );
//$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$db->exec( "CREATE TABLE IF NOT EXISTS users(
   id INTEGER PRIMARY KEY AUTOINCREMENT, 
   username TEXT NOT NULL DEFAULT '0',
   password TEXT NOT NULL DEFAULT '0')" );

if ( $_GET["action"] == "all" ) {
	// Ausgabe aller Actions
	echo "<ul>";
	$table = $db->query( "SELECT * FROM users" );
	foreach ( $table as $row ) {
		echo "<li>" . $row["username"] . " - " . $row["password"] . "</li>";
	}

	echo "</ul>";
} elseif ( $_GET["action"] == "add" ) {

	// Hinzufügen eines Datensatzes

	$args      = [ $_GET["username"], $_GET["password"] ];
	$statement = $db->prepare( "INSERT INTO main.users(username, password) VALUES (?, ?)" );
	$statement->execute( $args );

} else {

	$args = [ $_GET["username"], $_GET["password"] ];

	$statement = $db->prepare( "SELECT username FROM users WHERE username LIKE ? and password LIKE ?" );
	$statement->execute( $args );
	$results = $statement->fetch();
	$table   = $results;
	$row     = $table[0];

	if ( count( $table ) == 0 ) {
		echo "Username oder Passwort falsch!";
	} else {
		echo "Hallo " . $table["username"] . "!";
	}

}
?>
</body>
</html>