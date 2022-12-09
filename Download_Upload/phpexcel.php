<?php


require 'function.php';

$conn = mysqli_connect('localhost','root','','mytask');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

if(isset($_POST['export']))
{
    $file_ext_name = '.xls';
    $fileName = "users-sheet";

    $users = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $users);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'userame');
        $sheet->setCellValue('C1', 'password');
        $sheet->setCellValue('D1', 'email');
        $sheet->setCellValue('E1', 'ten');
        $sheet->setCellValue('F1', 'sdt');
        $sheet->setCellValue('G1', 'avatar');
        $sheet->setCellValue('H1', 'role');

        $rowCount = 2;
        foreach($query_run as $data)
        {
            $sheet->setCellValue('A'.$rowCount, $data['id']);
            $sheet->setCellValue('B'.$rowCount, $data['usersname']);
            $sheet->setCellValue('C'.$rowCount, $data['password']);
            $sheet->setCellValue('D'.$rowCount, $data['email']);
            $sheet->setCellValue('E'.$rowCount, $data['ten']);
            $sheet->setCellValue('F'.$rowCount, $data['sdt']);
            $sheet->setCellValue('G'.$rowCount, $data['avatar']);
            $sheet->setCellValue('H'.$rowCount, $data['role']);
            $rowCount++;
        }

        if($file_ext_name == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
        }
        elseif($file_ext_name == 'xls')
        {
            $writer = new Xls($spreadsheet);
            $final_filename = $fileName.'.xls';
        }
        elseif($file_ext_name == 'csv')
        {
            $writer = new Csv($spreadsheet);
            $final_filename = $fileName.'.csv';
        }

        // $writer->save($final_filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

    }
    else
    {
        $_SESSION['message'] = "No Record Found";
        header('Location: list.php');
        exit(0);
    }
}

?>