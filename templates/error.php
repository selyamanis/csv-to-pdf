<?php $title = 'Error'; ?>

<?php ob_start(); ?>

<h4 class="my-5">Error</h4>

<?php 
	echo $errorMessage; 
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
