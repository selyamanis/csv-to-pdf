<?php
// Empty previous content then redirect to the Archive ZIP page
$pathZip = 'zip/';

$rep = opendir($pathZip);

while ($file = readdir($rep)) {
	if ($file != '..' && $file !='.' && $file !='') {
		unlink($pathZip . $file);
	}
}

// Redirection to the Archive ZIP page
header('Location: ../archiveZip.php');
