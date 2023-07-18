<?php
	$cn = new mysqli('localhost', 'root', '', 'pruebas');

	if ($cn->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
	}

