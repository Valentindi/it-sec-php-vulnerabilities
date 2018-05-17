<!DOCTYPE html>
<html>
<head>XSS Input field</head>
<body>
<title>Cross Side Scripting (XSS)</title>

<form> <label>Ihr Suchbegriff:</label>
    <input value="
<?php
echo $_GET["parameter"]
?>">
</form>
</body>
</html> 