<?php 
$title = 'Download page';

ob_start();
?>

<h4 class="my-5">Download PDF</h4>

<?php
$repPath = 'archive/pdf/';
// Check if the upload PDF is not empty
$q = count(glob("$repPath/*")) == 0;
// If the upload PDF is empty
if ($q) {
    echo 'There is no PDF file to download! 
    <p class="my-3">You can generate a new PDF file at the : <a href="generatePdf.php">Home page</a></p>';
}
// else if there is an upload PDF
else {
    echo '<p class="my-3">Click on the generated PDF file to download :</p>';
    // folder path
    $path = 'archive/pdf/';
    // Display the list of generated PDF
    echo '<ul class="my-3">';
    if ($folder = opendir($path)) {
        while(false !== ($file = readdir($folder))) {
            if ($file != '.' && $file != '..' ) {
                echo '<li><a href="' . $path . '/' . $file . '">' . $file . '</a></li>';
            }
        }
        echo '</ul><br />';
        
        closedir($folder);
    } 
    else {
        echo 'An error has occurred';
    }
    echo '<p class="my-3">Or, you can also download all PDF files at the : <a href="archiveZip.php">Archive ZIP</a>.</p>';

    echo '<p class="my-3">You can delete all the PDF files generated : <a href="archive/emptyUploadPdf.php">empty Archive PDF</a>.</p>';
}

$content = ob_get_clean();

require('../templates/template.php');
