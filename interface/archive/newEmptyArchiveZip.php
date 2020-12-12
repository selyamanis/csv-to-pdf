<?php
// Empty previous content then redirect to download the new ZIP archive
$pathZip = 'zip/';

$rep = opendir($pathZip);

while ($file = readdir($rep)) {
	if ($file != '..' && $file !='.' && $file !='') {
		unlink($pathZip . $file);
	}
}

// Redirection to download the new ZIP archive
header('Location: newArchiveZip.php');
