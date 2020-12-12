<?php 
$title = 'Error';

ob_start(); 
?>

<h4 class="my-5">Error</h4>

<?php 
echo $errorMessage;


$content = ob_get_clean();

require('template.php');
