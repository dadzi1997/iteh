<?php
require 'pdfcrowd.php';

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("isidora", "a01b87a148c0c8ad80f6a87388fa0acb");

    // run the conversion and write the result to a file
    $client->convertUrlToFile("https://hellocreativefamily.com/photo-to-wood-transfer-tutorial-from-sew-creative/", "upustva.pdf");
    header('Location: ../view/index.html');
}
catch(\Pdfcrowd\Error $why)
{
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // rethrow or handle the exception
    throw $why;
}

?>