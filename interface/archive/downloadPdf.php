<?php
$pathPdf = 'pdf/';
$pathZip = 'zip/';

// Check the archive content
$p = count(glob("$pathPdf/*")) == 0;
$z = count(glob("$pathZip/*")) == 0;

// If there is a PDF files generated
if (!$p) {
    // Download the generated PDF
	// Archive PDF files generated then redirect to download the ZIP archive
	ini_set("display_errors",0);error_reporting(0);

	include('pclzip.lib.php');

	$archive = new PclZip('zip/archive.zip');

	$zipName = 'zip/archive.zip';

	$properties = $archive->add('pdf/');

	if ($properties == 0) {
	    die("Error : " . $archive->errorInfo(true));
	} 
	else {
		// Redirection to download the ZIP archive
		header('Location: zip/archive.zip');
	}
	// If there is an archive PDF 
	if (!$z) {
		// Redirection to generate another PDF
		header('Location: ../homePage.php');
	}
}
else {
    $errorMessage = "There is no PDF generated!
    				<p>Click on this link to generate PDF : <a href='../interface/homePage.php'> link</a></p>";
	// Redirection to the error view 
	$url = "../../templates/error.php?errorMessage=".$errorMessage;
	$url = str_replace(PHP_EOL, '', $url);
	header("Location: ".$url);
} 
