<!DOCTYPE html>
<html>
<head><title>
XSS Input field</title></head>
<body>
<h1>Cross Side Scripting (XSS)</h1>
<h2>Input-Field</h2>

<form> <label>Ihr Suchbegriff:</label>
    <input value="
<?php
echo $_GET["parameter"]
?>">
</form>
<h2>htmlspecialchars()</h2>
<p>Ihr Suchbegriff:

<?php
	echo htmlspecialchars($_GET["parameter"]);
	?>"
</p>
</body>
</html> 