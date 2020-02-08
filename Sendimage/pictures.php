<?php
require 'pdfcrowd.php';

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("isidora", "a01b87a148c0c8ad80f6a87388fa0acb");

    // create output stream for conversion result
    $output_stream = fopen("slike.pdf", "wb");

    // check for a file creation error
    if (!$output_stream)
        throw new \Exception(error_get_last()['message']);

    // run the conversion and write the result into the output stream
    $client->convertFileToStream("index.html", $output_stream);

    // close the output stream
    fclose($output_stream);
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