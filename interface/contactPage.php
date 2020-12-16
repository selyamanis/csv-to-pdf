<?php $title = 'csvToPdf / Contact'; ?>

<?php ob_start(); ?>

<h4 class="mt-5 mb-4">Contact</h4>

<p><a target="_blank" href="https://github.com/aselyamanis/csv-to-pdf">GitHub csvToPdf Repository</a></p>

<p><a target="_blank" href="https://github.com/aselyamanis">GitHub @aselyamanis</a></p>

<p>aselyamanis@gmail.com</p>
        
<?php $content = ob_get_clean(); ?>

<?php require('../templates/template.php'); ?>
