<?php
// Empty previous content then redirect to the Download PDF page
$pathPdf = 'pdf/';

$rep = opendir($pathPdf);

while ($file = readdir($rep)) {
	if ($file != '..' && $file !='.' && $file !='') {
		unlink($pathPdf . $file);
	}
}

// Redirection to the Download PDF page
header('Location: ../downloadPdf.php');
