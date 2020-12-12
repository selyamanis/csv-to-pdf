<?php
// Archive PDF files generated then redirect to download the new ZIP archive
ini_set("display_errors",0);error_reporting(0);

include('pclzip.lib.php');

$archive = new PclZip('zip/archive.zip');

$zipName = 'zip/archive.zip';

$properties = $archive->add('pdf/');

if ($properties == 0) {
    die("Error : " . $archive->errorInfo(true));
} 
else {
	// Redirection to download the new ZIP archive
	header('Location: zip/archive.zip');
}
