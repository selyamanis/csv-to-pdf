<?php $title = 'csvToPdf / Error'; ?>

<?php ob_start(); ?>

<h4 class="mt-5 mb-4">Error</h4>

<?php 
	echo $_GET['errorMessage'];
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
