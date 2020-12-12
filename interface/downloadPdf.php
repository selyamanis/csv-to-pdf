<?php $title = 'Download page'; ?>

<?php ob_start(); ?>

<h4 class="my-5">Download PDF</h4>

<?php
$repPath = 'archive/pdf/';
// Check if the upload PDF is not empty
$q = count(glob("$repPath/*")) == 0;
// If the upload PDF is empty
if ($q) {
?>
    <p class="my-3">There is no PDF file to download!</p> 
    <p class="my-3">You can generate a new PDF file at the : <a href="generatePdf.php">Home page</a></p>
<?php
}
// else if there is an upload PDF
else {
?>
    <p class="my-3">Click on the generated PDF file to download :</p>
<?php    
    // folder path
    $path = 'archive/pdf/';
    // Display the list of generated PDF
?>
    <ul class="my-3">
<?php
    if ($folder = opendir($path)) {
        while(false !== ($file = readdir($folder))) {
            if ($file != '.' && $file != '..' ) {
                echo '<li><a href="' . $path . '/' . $file . '">' . $file . '</a></li>';
            }
        }
?>
    </ul><br />
<?php  
    closedir($folder);
    } 
    else {
        echo 'An error has occurred';
    }
?>
    <p class="my-3">Or, you can also download all PDF files at the : <a href="archiveZip.php">Archive ZIP</a>.</p>

    <p class="my-3">You can delete all the PDF files generated : <a href="archive/emptyUploadPdf.php">empty Archive PDF</a>.</p>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('../templates/template.php'); ?>
