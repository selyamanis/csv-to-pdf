<?php $title = 'Home page'; ?>

<?php ob_start(); ?>

<h4 class="my-5">Generate PDF</h4>

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
                die ("Redirect failed. Please click on this link: <a href='../csvToPdf.php'> link</a>");
            } else {
                header('Location: ../csvToPdf.php');
            }

        } else {
            echo 'The selected file is not valid';
        }  
    }
} 
?>

<?php $content = ob_get_clean(); ?>

<?php require('../templates/template.php'); ?>
