First name: <?php echo $_POST["fname"]; ?><br>
Last name: <?php echo $_POST["lname"]; ?><br>
Email Address: <?php echo $_POST["email"]; ?><br>

<?php

$allowtype = array("gif","png","jpg","pdf","doc"); 
$size = 1000000; 
$path = "./uploads"; 


for( $i = 0;$i < count($_FILES['myfile']['error']);$i++ ){

    $upfile[$i] = $_FILES['myfile']['name'][$i];

    if($_FILES['myfile']['error'][$i]>0){

        echo "Upload error";
        switch($_FILES['myfile']['error'][$i]){
        
            case 1: die('The'.($i+1).'th file exceeds the size limit：upload_max_filesize');
            case 2: die('Upload the'.($i+1).'th file size beyond the agreed value in the form：MAX_FILE_SIZE');
            case 3: die('The'.($i+1).'th file only part of it is uploaded');
            case 4: die('The'.($i+1).'th file was not uploaded');
            default: die('Unknown error');
        }
    }

    $arr = explode(".",$_FILES['myfile']['name'][$i]);
    $hz[$i] = array_pop( $arr );
    if(!in_array($hz[$i],$allowtype)){

        die("The".($i+1)."th file not an allowed file type");
    }


    if($_FILES['myfile']['size'][$i]>$size){

        die("The".($i+1)."th file more than allowed<b>{$size}</b>");
    }


    $filename[$i] = date("YmdHis").rand(100,999).".".$hz[$i];

    if(is_uploaded_file($_FILES['myfile']['tmp_name'][$i])){

        if(!move_uploaded_file($_FILES['myfile']['tmp_name'][$i],"upload/".$filename[$i])){
        
            die("Cannot move the file to the specified directory");
        }
    }else{

        die("Upload file {$_FILES['myfile']['name'][$i]}Not a valid file");
    }


    $filesize[$i] = $_FILES['myfile']['size'][$i]/1024;
    echo "{$upfile[$i]}&nbsp; Uploading successfully,Save in the{$path}，file size:{$filesize[$i]}KB<br>";
}
?>
<a href="http://localhost/1/upload.html" class="btn btn-warning">Back</a>