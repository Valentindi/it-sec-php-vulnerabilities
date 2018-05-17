<?php

header("Content-disposition: attachment; filename=my_db.sqlite");
header("Content-type: application/pdf");
readfile("my_db.sqlite");
