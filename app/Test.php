<?php 

namespace App;

class Test extends Db{
    public function getTranscation(){
        $sql = "SELECT * FROM transcation";
          $stmt = $this->connect()->query($sql);
          $rows = $stmt->fetchAll();
        //   echo '<pre>';
          return $rows;
    }   

    public function addData(string $date, string $checkno, string $description, string $amount){
        $sql = "INSERT INTO transcation( tdate, checkno, tdescription,tamount )VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date, $checkno, $description, $amount]);
    }
    public function importDataCSV($file, ?callable $recordHandler = null):array{
        $file = fopen($file,"r");
         //dicard the excel heading 
        fgetcsv($file); 
        //Output lines until EOF is reached
        $records = [];
        while(($record = fgetcsv($file))!= false){
            if ($recordHandler != null){
                $record = $recordHandler($record);
            }
            // $records[] = getRecordsValue($record); 
            $records[] = $record;
        }
        return $records;  
    }

    function getRecordsValue(array $recordRow):array{
        //assigning values to variables in the array
        [$date, $checkno, $description, $amount] = $recordRow;
        //remove the $ and , form the amount
        $amount = str_replace(['$',','],'',$amount);
        // associative array is returned
        return [
            'date'=> $date,
            'checkno'=> $checkno,
            'description'=> $description,
            'amount'=> $amount,
        ];
    }
    
    public function upload(){
        // define('STORAGE_PATH', __DIR__. '\storage');
        // // echo '<pre>';
        // echo $_SERVER['SERVER_NAME']. "/".  $_SERVER['REQUEST_URI'];
        // // var_dump($_SERVER);
        // echo ' this is export function';
        // echo STORAGE_PATH;
        if ($_FILES) {
            
                     // echo '<pre>';
                    //var_dump($_FILES);
                    $allowed_extension = ['csv'];
                    $tmp_name = $_FILES["userfile"]["tmp_name"];
                    // basename() may prevent filesystem traversal attacks;
                    // further validation/sanitation of the filename may be appropriate
                    $name = basename($_FILES["userfile"]["name"]);
                    //pathinfo return array of file info like extension path name etc.
                    $ext = (pathinfo($name) ['extension'] );
                    if (in_array($ext,$allowed_extension)){
                        if ( move_uploaded_file($tmp_name, STORAGE_PATH.'/'.$name) == true) {
                            $exactfileuploaded = STORAGE_PATH.'/'.$name;
                            // echo $name. ' is stored in '. STORAGE_PATH.'/'.$name;
                            echo 'File Upload Successfully';
                            echo '<pre>';
                            $transcations = $this->importDataCSV(  $exactfileuploaded);
                            // print_r($transcations);
                            foreach ($transcations as $key => $transcation) {
                                $records = $this->getRecordsValue($transcation)  ;
                            //    var_dump($records);
                               $this->addData($records['date'],$records['checkno'],$records['description'],$records['amount']);
                            }
                        }else{
                            echo 'Upload failed';
                        };
                    }else{
                        echo $ext . ' Format Files are Not allowed';
                    }
        }else {
            echo 'no file is selected';
                   
        }
    }
}