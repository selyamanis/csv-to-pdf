<?php
$pathPdf = 'pdf/';
$pathZip = 'zip/';

function emptyPdf($path)
{
	$rep = opendir($path);

	while ($file = readdir($rep)) {
		if ($file != '..' && $file !='.' && $file !='') {
			unlink($path . $file);
		}
	}
}

emptyPdf($pathPdf);
emptyPdf($pathZip);

// Redirection to generate ODF
header('Location: ../../csvToPdf.php');
