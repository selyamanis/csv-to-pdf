<?php $title = 'csvToPdf / Home'; ?>

<?php ob_start(); ?>

<h4 class="mt-5 mb-4">Generate PDF</h4>

<h5 class="my-3">csvToPdf is a CSV data to PDF extractor</h5>

<p>Firstly, csvToPdf use PHP to extract CSV data into HTML. Lastly, it use the <a target="_blank" href="https://github.com/dompdf/dompdf">Dompdf</a> library to convert HTML to PDF.</p>

<p>This program is made with a basic example for the case of an invoice, which can be adapted for any need to extract data from a spreadsheet file into a PDF file.</p>

<p>Review the <a href="usagePage.php">Usage page</a> or the <a href="../README.md">README.md</a> file before submitting your CSV file.</p>

<form class="my-3" method="post" enctype="multipart/form-data">
    <div class="my-3 form-group">
        <label for="csvFile">Choose your CSV file to extract :</label>
        <input type="file" class="form-control-file" id="csvFile" name="csvFile">
    </div>
    <div class="my-3">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>

<?php 
// Check if the file has been sent successfully and if there is no error
if (isset($_FILES['csvFile']) AND $_FILES['csvFile']['error'] == 0)
{
    // Check file size
    if ($_FILES['csvFile']['size'] <= 1000000)
    {
        // Check if the extension is allowed
        $info_file = pathinfo($_FILES['csvFile']['name']);
        $extension_upload = $info_file['extension'];
        $extensions_allowed = array('csv');
        if (in_array($extension_upload, $extensions_allowed))
        {
            // Validate the file and store it
            move_uploaded_file($_FILES['csvFile']['tmp_name'], '../public/uploads/data.' . $extension_upload);
            
            // Redirection to generate PDF
            if (headers_sent()) {
                die ("Redirect failed. Please click on this link: <a href='archive/emptyPdf.php'> link</a>");
            } else {
                header('Location: archive/emptyPdf.php');
            }

        } else {
            echo 'The selected file is not valid';
        }  
    }
} 
?>

<?php $content = ob_get_clean(); ?>

<?php require('../templates/template.php'); ?>
