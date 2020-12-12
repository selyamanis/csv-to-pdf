<?php 
$title = 'Archive page';

ob_start();
?>

<h4 class="my-5">Archive ZIP</h4>

<?php
$pathPdf = 'archive/pdf/';
$pathZip = 'archive/zip/';
// Check if the archire ZIP is not empty
$p = count(glob("$pathPdf/*")) == 0;
$z = count(glob("$pathZip/*")) == 0;
// If the archive ZIP is empty
if ($z) {
    // if there is no PDF files 
    if ($p) {
        echo 'There is no archive to save!
            <p class="my-3">You can generate a new PDF file at the : <a href="generatePdf.php">Home page</a></p>';
    }
    else {
        // Download Archive ZIP
        echo '<p class="my-3">Download your : <a href="archive/newEmptyArchiveZip.php">Archive ZIP</a>.</p>';

        // Empty all content of the Archive ZIP
        echo '<p class="my-3">You can delete all the archive content : <a href="archive/emptyArchiveZip.php">empty Archive ZIP</a>.</p>';
    }
}
// else if there is an archive ZIP with no PDF files
else {
    // if there is no PDF files 
    if ($p) {
        echo '<p class="my-3">Save your : <a href="archive/zip/archive.zip">current Archive ZIP</a>.</p>';

        // Empty all content of the Archive ZIP
        echo '<p class="my-3">You can delete all the archive content : <a href="archive/emptyArchiveZip.php">empty Archive ZIP</a>.</p>';
    } 
    else {
        echo '<p class="my-3">To download the new Archive ZIP <strong>the previous archive will be deleted!</strong></p>';

        // Save the current Archive ZIP
        echo '<p class="my-3">Save your : <a href="archive/zip/archive.zip">current Archive ZIP</a>.</p>';

        // Empty previous content then redirect to download the new ZIP archive
        echo '<p class="my-3">Download your : <a href="archive/newEmptyArchiveZip.php">new Archive ZIP</a>.</p>';

        // Empty all content of the Archive ZIP
        echo '<p class="my-3">You can delete all the archive content : <a href="archive/emptyArchiveZip.php">empty Archive ZIP</a>.</p>';
    }
}
		
$content = ob_get_clean();

require('../templates/template.php');
