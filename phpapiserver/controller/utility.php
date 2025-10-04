<?php
define('SERVER_PATH', dirname(__FILE__, 3));
define('UPLOADS_FOLDER', SERVER_PATH.'/user/uploads/');


class Utility {
    private $allowedext = array();
    private $max_file_size;
    
    function __construct($uploadConfig) {
        $this->allowedext = $uploadConfig['allowed'];
        $this->max_file_size = $uploadConfig['max_size'];
    }

    public function upload($file, $folder=null) {
        if($folder !== null) {
            $target_dir = UPLOADS_FOLDER.$folder;
            
        }else{
            $target_dir = UPLOADS_FOLDER;
        }
        // $file = $file_["files"];
        
        $filepath = $target_dir.$file["name"];
        $filename = $file["name"];

        if($this->sanitizeFiles($file, $target_dir, $this->allowedext)){
            if(move_uploaded_file($file["tmp_name"], $filepath)){
                return [
                    'filename' => $filename,
                    'filepath' => $filepath
                ];
            }else{
                return false;
            }
        }

    }

    private function sanitizeFiles($file, $target_dir, $AllowedFileFormats){
        //check file format/extention
        $fileExt = strtolower(pathinfo($target_dir.$file["name"],PATHINFO_EXTENSION));
        if(in_array($fileExt, $AllowedFileFormats)){
          //check file size 
          $filseSize = $file["size"];
          if($filseSize <= $this->max_file_size){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
    }
}