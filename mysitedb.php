<?php
$link=pg_connect("host=127.0.0.1 dbname=units user=admin password=admin")
or die('Не удалось соединиться: ' . pg_last_error());
