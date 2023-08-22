<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Slim\Psr7\Response;


class ArrayToExcelController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
      // Create a new Spreadsheet instance
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Populate the sheet with data
    $data = [
        ['Name', 'Age', 'Country'],
        ['John &IDoe&I', 30, 'USA'],
        ['Jane Smith', 28, 'Canada'],
    ];
    $sheet->fromArray($data);

    // Create a Response object
    $response = new Response();

    // Set headers for downloading the Excel file
    $filename = 'data.xlsx';
    $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response = $response->withHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
    $response = $response->withHeader('Cache-Control', 'max-age=0');

    // Save the spreadsheet to a temporary file
    $tempFilePath = tempnam(sys_get_temp_dir(), 'excel');
    $writer = new Xlsx($spreadsheet);
    $writer->save($tempFilePath);

    // Stream the temporary file content to the response
    $response->getBody()->write(file_get_contents($tempFilePath));

    // Delete the temporary file
    unlink($tempFilePath);

    return $response;
    }
}