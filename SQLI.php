<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection</title>
</head>
<body>
<h2>SQL Injection</h2>

<?php
$db = new SQLite3( "my_db.sqlite" );
$db->exec( "CREATE TABLE IF NOT EXISTS users(
   id INTEGER PRIMARY KEY AUTOINCREMENT, 
   username TEXT NOT NULL DEFAULT '0',
   password TEXT NOT NULL DEFAULT '0')" );
echo "<ul>";
if ( $_GET["action"] == "all" ) {
    $table = $db->query( "SELECT * FROM users");
	while ($row = $table->fetchArray())
        {
            echo "<li>" . $row["username"] . " - " .$row["password"] ."</li>";
        }

echo "</ul>";
} elseif ( $_GET["action"] == "add" ) {
	echo( "INSERT INTO users(username, password) VALUES (\"" . $_GET["username"] . "\", \"" . $_GET["password"] . "\")" );
	$db->exec( "INSERT INTO users(username, password) VALUES (\"" . $_GET["username"] . "\", \"" . $_GET["password"] . "\")" );
	echo "<p>User " . $_GET["username"] . " hinzugefügt</p>";
} else {
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