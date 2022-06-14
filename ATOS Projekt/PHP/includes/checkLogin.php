<?php 

    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    /*$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');*/

    if (isset($_POST['nutzer'])){
        
        $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load('../../Input/Patienten.xlsx');
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        echo "<pre>";
        print_r($sheetdata);

    }
    else{
        header("Location: ../../HTML/login.php?error=1");
    }

?>