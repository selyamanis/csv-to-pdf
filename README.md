csvToPdf
========

**csvToPdf is a CSV data (spreadsheet file) to PDF extractor**

Firstly, the csvToPdf program uses PHP to extract CSV data into HTML. Lastly, it uses the [Dompdf](https://github.com/dompdf/dompdf/) library to convert HTML to PDF.

This program is made with a basic example for the case of an invoice, which can be adapted for any need to extract data from a spreadsheet file into a PDF file.



## Requirements

 * PHP version 7.2 or higher
 * Dompdf Library
 * The same requirements of Dompdf version 0.8.2. See the [README.md](dompdf/README.md/)

## Installation

Dowload the release csvToPdf version.

Extract the ZIP file on your server. Such as a local server accessible at : http://localhost/.

Run the interface by opening the [public](public/) folder, to access the [Home page](public/index.php/).

## Usage

Submit the CSV file to extract on the Home page to generate PDF and then download it.

Before that, the CSV file must be customized. 

The csvToPdf program uses each field named "nextFile" as a keyword to locate the data to extract into HTML for each PDF file to generate.

The keyword must be assigned at the first column to the field corresponding to the end of the data of each PDF file, then the program goes to the next file.

Rows can be added above the "nextFile" row as needed for the data to be extracted for each PDF file.

#### Notes 

There is a test CSV file : [dataType.csv](public/types/dataType.csv/), which can be used as a template. The data to be extracted must be assigned to the same fields in the same way as this file.

Here is an example of the [output PDF](public/types/output-type/) which can be customized as needed by the HTML code in the main file [csvToPdf.php](csvToPdf.php/).


---

*Many thanks to the [Dompdf](https://github.com/dompdf/dompdf/) team.*

----

[GitHub csvToPdf Repository](https://github.com/selyamanis/csv-to-pdf/)

[GitHub @selyamanis](https://github.com/selyamanis/)

<selyamanisalim@gmail.com>

---
