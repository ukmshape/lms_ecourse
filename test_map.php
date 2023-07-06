<?php

//$folder_temp = "\\\\pkp.ukm.my\\dokumen\\ehas\\val";
$folder_temp = "pkpdev.ukm.my/storage/";


//$folder_manual = "\\\\202.185.40.42\\gambarPEL\\images";
$temp_folder = "test123456555";

echo "Target direktori : [ $folder_temp ] <br><br>";

if (!is_dir($folder_temp)) {
        echo "Direktori <span style='color:red'>GAGAL</span> diakses <br>";
}else{
        echo "Direktori boleh diakses<br>";
    mkdir($folder_temp.$temp_folder);
    if (!file_exists($folder_temp.$temp_folder)) {
                echo "Test MKDIR direktori <span style='color:red'>GAGAL</span>!!!<br>";
            mkdir($dir);
        }
        else{
                echo "Test MKDIR  direktori <span style='color:blue'>BERJAYA</span><br>";
                rmdir ( $folder_temp.$temp_folder );
                if (file_exists($folder_temp.$temp_folder)) {
                        echo "Test RMDIR direktori <span style='color:red'>GAGAL</span><br>";
                }
                else{
                        echo "Test RMDIR direktori <span style='color:blue'>BERJAYA</span>.<br><br>tq..";
                }

        }



?>

