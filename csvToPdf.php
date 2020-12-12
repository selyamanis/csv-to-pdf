<?php
// Include autoloader
require_once 'dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Output the generated PDF
function generatePdf($invoiceHtml, $fileName) { 
    $dompdf = new Dompdf(); 
    $dompdf->loadHtml($invoiceHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $output = $dompdf->output(); 
    file_put_contents($fileName, $output); 
}

// Random reference for Order and Reduction
function rand_chars($c, $l, $u = FALSE) {
    if (!$u) for ($s = '', $i = 0, $z = strlen($c)-1; $i < $l; $x = rand(0,$z), $s .= $c{$x}, $i++);
    else for ($i = 0, $z = strlen($c)-1, $s = $c{rand(0,$z)}, $i = 1; $i != $l; $x = rand(0,$z), $s .= $c{$x}, $s = ($s{$i} == $s{$i-1} ? substr($s,0,-1) : $s), $i=strlen($s));
    return $s;
}  

// Remove accents from PDF filenames
function remove_accents($str, $encoding = 'utf-8') {
    // Transform accented characters into HTML entities
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);

    // Replace HTML entities to have just the first unaccented characters
    // Example : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);

    // Replace ligatures such as : , Æ ...
    // Example "œ" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);

    // Delete everything else
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

// Extract data from CSV file : Invoice case
$orders = array();
$products = array();

$row = 1;
if (($handle = fopen("public/uploads/data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields at row $row: <br /></p>\n";
        $row++;

        for ($c=0; $c < $num; $c++) {
            if ($row > 2) {
                  if ($c == 1) {
                  $name = $data[$c];
                } if ($c == 2 ) {
                  $address = $data[$c];
                } if ($c == 3 ) {
                  $reference = $data[$c];
                } if ($c == 4 ) {
                  $product = $data[$c];
                } if ($c == 5 ) {
                  $taxRate = $data[$c];
                } if ($c == 6 ) {
                  $startingPrice = $data[$c];
                } if ($c == 7 ) {
                  $unitPrice = $data[$c];
                } if ($c == 8 ) {
                  $quantity = $data[$c];
                } if ($c == 9 ) {
                  $unitPriceTotal = $data[$c];
                } if ($c == 10 ) {
                  $productPriceTotal = $data[$c];
                } if ($c == 11 ) {
                  $reduction = $data[$c];
                } if ($c == 12 ) {
                  $shippingCosts = $data[$c];
                } if ($c == 13) {
                  $priceTotal = $data[$c];
                } if ($c == 14) {
                  $paymentMethod = $data[$c];
                } if ($c == 15) {
                  $transporter = $data[$c];
                } if ($c == 16) {
                  $info = $data[$c];
                } if ($c == 17) {
                  $contact = $data[$c];
                }
                  //echo $data[$c] . "<br />\n";
            }
        }
        // Locating data following each "nextFile" field at the first column
        if ($data[0] == "nextFile") {
            $orders[] = array('name' => $name,'address' => $address,'productPriceTotal' => $productPriceTotal,
                'reduction' => $reduction,'shippingCosts' => $shippingCosts,'priceTotal' => $priceTotal,'paymentMethod' => $paymentMethod,'transporter' => $transporter,'info' => $info,'contact' => $contact,'products' => $products);
            // Initialize
            $products = array();
        } 
        else {
            if ($row > 2) { $products[] = array('reference' => $reference,'product' => $product,'taxRate' => $taxRate,'startingPrice' => $startingPrice,
            'unitPrice' => $unitPrice,'quantity' => $quantity,'unitPriceTotal' => $unitPriceTotal); }
        }
    }
    // If there is no field named "nextFile" at the first column
    if ($data[0] !== "nextFile") {
        $errorMessage = "The content of selected CSV file is not valid! 
            <p>See the README.md file and try again.</p>
            <p>Click on this link to generate PDF : <a href='interface/generatePdf.php'> link</a></p>";
            require('templates/error.php');
    } 
}

foreach ($orders as $key1 => $value1) {

$invoiceHtml = <<< HTML

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    
    <title>Facture</title>
    
    <link rel='stylesheet' href='public/css/invoiceStyle.css' />
</head>

<body>

HTML;

    // Viewing orders
    $name = $value1["name"];
    $address = $value1["address"];
    $reduction = $value1["reduction"];
    $productPriceTotal = $value1["productPriceTotal"];
    $priceTotal = $value1["priceTotal"];
    $paymentMethod = $value1["paymentMethod"];
    $transporter = $value1["transporter"];
    $info = $value1["info"];
    $contact = $value1["contact"];

    // Counter for increment the invoice number
    $fp = fopen("public/invoiceNumber.txt", "r+"); 
    $invoiceNum = fgets($fp, 4); 
    $invoiceNum++;
    fseek($fp, 0); 
    fputs($fp, $invoiceNum);
    fclose($fp); 

    $invoiceHtml .=
        '<div id="page-wrap">
            <div id="headerLogoInvoice">
                <div id="logo">
                  <img id="image" src="public/images/logo.png" alt="logo" />
                </div>

                <div id="invoice">
                    <div id="headerInvoice">
                        <p><strong>FACTURE</strong></p>
                    </div>
                    <div id="headerDateNum">
                        <p>'.date("d/m/Y").'</p>
                        <p>#FA000'.$invoiceNum.'</p>
                    </div>
                </div>
            </div>
            
            <div id="address">
                <div id="deliveryAddress">
                    <p><strong>Adresse de livraison</strong></p><br />
                    <p>'.$name.'<br />'.$address.'</p>
                </div>

                <div id="invoiceAddress">
                    <p><strong>Adresse de facturation</strong></p><br />
                    <p>'.$name.'<br />'.$address.'</p>
                </div>
            </div>
                    
            <div id="invoiceNum">

                <table id="meta">

                    <tr>
                        <th>Numéro de facture</th>
                        <th>Date de facturation</th>
                        <th>Réf. de commande</th>
                        <th>Date de commande</th>
                    </tr>

                    <tr class="meta-row">
                        <td class="invoiceNum">#FA000'.$invoiceNum.'</td>
                        <td class="invoiceDate">'.date("d/m/Y").'</td>
                        <td class="orderRef">'.rand_chars("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 9).'</td>
                        <td class="orderDate">'.date("d/m/Y").'</td>
                    </tr>

                </table>
            
        </div>';

    $invoiceHtml .=        
        '<div id="invoiceRef">
            <table id="items">
                <tr>
                    <th>Référence</th>
                    <th>Produit</th>
                    <th>Taux de taxe</th>
                    <th>Prix de base (HT)</th>
                    <th>Prix unitaire (HT)</th>
                    <th>Quantité</th>
                    <th>Total (HT)</th>
                </tr>';

        // Viewing products
        foreach ($value1["products"] as $key4 => $value4) {
            $reference = $value4['reference'];
            $product = $value4['product'];
            $taxRate = $value4['taxRate'];
            $startingPrice = $value4['startingPrice'];
            $unitPrice = $value4['unitPrice'];
            $quantity = $value4['quantity'];
            $unitPriceTotal = $value4['unitPriceTotal'];
            
            $invoiceHtml .= 
              '<tr class="item-row">
                  <td class="reference">'.$reference.'</td>
                  <td class="product">'.$product.'</td>
                  <td class="tax">'.$taxRate.'</td>
                  <td class="startingPrice">'.$startingPrice.' DH</td>
                  <td class="unitPrice">'.$unitPrice.' DH</td>
                  <td class="quantity">'.$quantity.'</td>
                  <td class="unitPriceTotal">'.$unitPriceTotal.' DH</td>
              </tr>';          
        }

    $invoiceHtml .=
            '</table>
        <div id="metaEnd">
            <table id="metaEndRight">
                <tr>
                    <td class="meta-head">Total produits</td>
                    <td>'.$productPriceTotal.' DH</td>
                </tr>';

        if ($priceTotal < $productPriceTotal) { 
    $invoiceHtml .=                  
                '<tr>
                    <td class="meta-head">Réductions</td>
                    <td>'.rand_chars("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 2).rand_chars("0123456789", 3).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-'.$reduction.' DH</td>
                </tr>';
        }

    $invoiceHtml .= 
                '<tr>
                    <td class="meta-head">Frais de livraison</td>
                    <td>'.$shippingCosts.'</td>
                </tr>
                <tr>
                    <td class="meta-head"><strong>Total (HT)</strong></td>
                    <td><strong>'.$priceTotal.' DH</strong></td>
                </tr>
                <tr>
                    <td class="meta-head"><strong>Total</strong></td>
                    <td><strong>'.$priceTotal.' DH</strong></td>
                </tr>

            </table>

            <table id="metaEndLeft">
                <tr>
                    <td class="meta-headLeft"><strong>Mode de paiement</strong></td>
                    <td>'.$paymentMethod.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$priceTotal.' DH</td>
                </tr>
                <tr>
                    <td class="meta-headLeft"><strong>Transporteur</strong></td>
                    <td>'.$transporter.'</td>
                </tr>
            </table>
        </div>            
        </div>

            <div id="footer">
              <p>
                Info : '.$info.'<br />
                Contact : '.$contact.'
              </p>
            </div>
        
        </div>';

    $invoiceHtml .='</body></html>';

    // Replace spaces by dash in the name value 
    $name = str_replace(' ', '-', $name);

    // Output the generated PDF
    $pdfName = 'interface/archive/pdf/' . remove_accents($name) . '_FA000'.$invoiceNum.'_' . date("d-m-Y") . '.pdf'; 
    generatePdf($invoiceHtml, $pdfName); 

    // Redirection to download PDF
    header('Location: interface/downloadPdf.php');

    // Initialize the HTML invoice code
    $invoiceHtml ='';

}

fclose($handle);
