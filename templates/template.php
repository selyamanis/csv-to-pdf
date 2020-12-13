<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title><?= $title ?></title>
        
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="../interface/generatePdf.php"><h2>csvToPdf extractor</h2></a>
	            <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                <ul class="navbar-nav ml-auto">
	                    <li class="nav-item <?php if ($title == 'Home page') { echo ' active'; } ?>">
	                        <a class="nav-link" href="../interface/generatePdf.php">Home <span class="sr-only">(current)</span></a>
	                    </li>
	                    <li class="nav-item <?php if ($title == 'Download page') { echo ' active'; } ?>">
	                        <a class="nav-link" href="../interface/downloadPdf.php">Download PDF <span class="sr-only">(current)</span></a>
	                    </li>
	                    <li class="nav-item <?php if ($title == 'Archive page') { echo ' active'; } ?>">
	                        <a class="nav-link" href="../interface/archiveZip.php">Archive ZIP <span class="sr-only">(current)</span></a>
	                    </li>
	                </ul>
	            </div>
	        </nav>
		</header>

		<div class="container vertical-center">
		    <body>

		        <?= $content ?>

		    </body>
		</div>

		<footer class="text-muted text-center fixed-bottom">
			<a target="_blank" href="https://github.com/aselyamanis/csv-to-pdf"><img border="0" alt="github" src="../public/images/gitHubIcon.svg" width="20" height="20"></a>
			<a class="text-muted text-center" target="_blank" href="https://github.com/aselyamanis/csv-to-pdf">GitHub</a></br>
			<a class="navbar-brand text-muted text-center" href="../interface/generatePdf.php"><h3>csvToPdf extractor</h3></a>
		</footer>
</html>
