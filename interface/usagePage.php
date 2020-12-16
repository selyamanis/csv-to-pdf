<?php $title = 'csvToPdf / Usage'; ?>

<?php ob_start(); ?>

<h4 class="mt-5 mb-4">Usage</h4>

<p>Submit the CSV file to extract on the <a href="homePage.php">Home page</a>.</p>

<p>Before that, the CSV file must be customized.</p>

<p>The csvToPdf program uses each field named "nextFile" as a keyword to locate the data to extract into HTML for each PDF file to generate.</p>

<p>The keyword must be assigned at the first column to the field corresponding to the end of the data of each PDF file, then the program goes to the next file.</p>

<p>Rows can be added above the "nextFile" row as needed for the data to be extracted for each PDF file.</p>

<p>Notes :</p>

<p>There is a test CSV file : <a href="../public/types/dataType.csv">dataType.csv</a>, which can be used as a template. The data to be extracted must be assigned to the same fields in the same way as this file.</p>

<p>Here is an example of the <a href="../public/types/output-type">output PDF</a>, which can be customized as needed by the HTML code in the main file.</p>

<p>Review the <a href="../README.md">README.md</a> file.</p>

<?php $content = ob_get_clean(); ?>

<?php require('../templates/template.php'); ?>
