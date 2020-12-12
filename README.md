csvToPdf
========

**csvToPdf is a CSV data to PDF extractor**

Firstly, csvToPdf use PHP to extract CSV data into HTML. Lastly, it use the [Dompdf](https://dompdf.net/) library to convert HTML to PDF.

A simple interface made for usage, with a basic example for the case of an invoice. This program can be adapted for any need to extract data from a spreadsheet file into a PDF file such as payslips or others.



## Requirements

 * PHP version 7.2 or higher
 * Dompdf Library
 * The same requirements of Dompdf version 0.8.2. See the [README.md](dompdf/README.md)

## Usage

The interface consists of three pages. 

#### Generate PDF page

This is the home page of the interface where to submit the CSV file to extract.

The csvToPdf program uses "nextFile" as a keyword to locate the data to extract in HTML for each PDF file to generate.

The CSV file must be customized. The keyword must be assigned at the first column to the field corresponding to the end of the data of each PDF file, then the program goes to the next file.

Rows can be added above the "nextFile" row as needed for the data to be extracted for each PDF file.

Note: There is a test CSV file which can be used as a template. The data to be extracted must be assigned to the same fields in the same way as this file. See the [dataType.csv](public/dataType.csv).

To run the [home page](public/index.php). 

#### Download PDF page

In this second page the list of generated PDF files is displayed for download.

[Archive PDF](interface/archive/pdf).

#### Archive ZIP page

Also an archive ZIP can be downloaded of all the PDF files generated in the third page.

[Archive ZIP](interface/archive/zip).

---

*Many thanks to the [Dompdf](https://github.com/dompdf/dompdf) team.*

----

[GitHub csvToPdf Repository](https://github.com/aselyamanis/csv-to-pdf)

[GitHub @aselyamanis](https://github.com/aselyamanis)

<aselyamanis@gmail.com>

---
