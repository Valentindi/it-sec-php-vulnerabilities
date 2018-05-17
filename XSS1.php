<!DOCTYPE html>
<html>
<head>
    <title>Cross Side Scripting (XSS)</title>

</head>
<body>
<h2>Cross Side Scripting (XSS)</h2>

<p style="font-size: 50px">Ihr Suchbegriff:
<?php
echo $_GET["parameter"]
?>
</p>
</body>
</html> 