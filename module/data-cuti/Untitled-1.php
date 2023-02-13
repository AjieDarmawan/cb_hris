
<?php
session_start(); 
$page=$_POST['p'];


if(isset($_POST['bsave'])){

	echo "<pre>";
	print_r($_FILES['data_pelamar']);

$waktu = date('YmdH');

if(isset($_FILES['data_pelamar']) && is_uploaded_file($_FILES['data_pelamar']['tmp_name'])){
    $upload_dir = "module/cv/upload_pelamar/";
    $array = explode('.', $_FILES['data_pelamar']['name']);
    $extension = end($array);
   echo $file_name = "list_data_pelamar".$waktu.".".$extension;
    $file_path = $upload_dir . $file_name;
if (!move_uploaded_file($_FILES['data_pelamar']['tmp_name'], $file_path)) {
    echo "Error moving file upload";
}else{
  
        require('excel-reader/excel_reader2.php');
        require('excel-reader/SpreadsheetReader_XLSX.php');
        $data_reader = new SpreadsheetReader_XLSX('module/cv/upload_pelamar/'.$file_name);
        $dataArr = array();
        $Sheets = $data_reader -> Sheets();
        foreach ($Sheets as $Index => $Name)

        {
              //  echo $Name."<br>";
                $Index = 0; //sheet1 //		
                $data_reader -> ChangeSheet($Index);
                $brs=0; 
                
               
                foreach ($data_reader as $row){
                	 $brs++;
						if ($brs <= 1 ){
					   		//judul
						}else{
						     $kol=0	;
						     $kol2=1;

						     echo "<pre>";
                			 print_r($row[1]);

						 }
                	
                    

                }//for data_reader //
                // echo "<br>";
        } //for sheet //

    }



}



}

?>