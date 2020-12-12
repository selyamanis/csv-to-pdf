<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title><?= $title ?></title>
        
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>

    <div class="container">
	    <body>
	        <nav class="my-5 navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="../interface/generatePdf.php"><h2>csvToPdf extractor</h2></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
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

	        <?= $content ?>

	    </body>
    </div>
</html>
