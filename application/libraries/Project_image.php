<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Project_image 
{
    public  function crop($img_result)
    {
        ini_set('max_file_uploads', '10');
            $output='';
            if(is_array($img_result))
            {
                    $filename=$img_result['filename'];
                    $filepath=$img_result['filepath'];
                    $destination=$img_result['uploadpath'];
                    $im_name=$img_result['extension_name'];
                    //$resolution=$img_result['clarity'];
                    $resolution=100;
                    $req_width=$img_result['width'];
                    $req_height=$img_result['height'];
                    /*validation part code start*/
                    /*validation part code end*/
                    /*Create New Folder*/
                    $this->createFolder($destination);
                    /*Create New Folder end*/
                    $extension=  fileExtension($filename); //Getting the file exitension
                    $info = getimagesize($filepath);//getting the image properties
                    $source=$filepath; /*Getting the image Temp file destination*/
                    if ($info['mime'] == 'image/jpeg')  $image = imagecreatefromjpeg($source); //for Jpg or jpeg
                    elseif ($info['mime'] == 'image/jpg')  $image = imagecreatefromjpeg($source); //JPG
                    elseif ($info['mime'] == 'image/JPEG')  $image = imagecreatefromjpeg($source); //JPG
                    elseif ($info['mime'] == 'image/JPG')  $image = imagecreatefromjpeg($source); //JPG
                    elseif ($info['mime'] == 'image/gif')  $image = imagecreatefromgif($source); //GIF
                    elseif ($info['mime'] == 'image/png')  $image = imagecreatefrompng($source);//PNG
                    $pic_name=$im_name.'_'.sha1(rand(100000,999999).time()).'.'.$extension; /*Generating random image name*/
                    list($origWidth, $origHeight) =$info;/*Getting the width, height of Uploading Image*/
                    $newImage = imagecreatetruecolor($req_width,$req_height);/*Creating the new image*/
                    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $req_width, $req_height, $origWidth, $origHeight);
                    imagejpeg($newImage,$destination.$pic_name, $resolution);
                    // Free up the memory.
                    imagedestroy($image);
                    imagedestroy($newImage);
                    $output=$pic_name;
            }
            else
            {
                $output=0;
            }
            return $output;
    }
    public function createFolder($path)
    {
            $output='';
            if($path!='')
            {
                    $folder_req=explode('/',$path);
                    $folder_count=count($folder_req);
                    for($i=0;$i<$folder_count;$i++)
                    {
            
                                if($i==1){(!is_dir($folder_req[0]))?mkdir('./' .$folder_req[0], 0777, TRUE):'';}
                                if($i==2){(!is_dir($folder_req[0].'/'.$folder_req[1]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1], 0777, TRUE):'';}
                                if($i==3){(!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2], 0777, TRUE):'';}
                                if($i==4){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3], 0777, TRUE):'';
                                }
                                if($i==5){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4], 0777, TRUE):'';
                                }
                                if($i==6){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5], 0777, TRUE):'';
                                }
                                if($i==7){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6], 0777, TRUE):'';
                                }
                                if($i==8){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6].'/'.$folder_req[7]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6].'/'.$folder_req[7], 0777, TRUE):'';
                                }
                                if($i==9){
                                (!is_dir($folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6].'/'.$folder_req[7].'/'.$folder_req[8]))?mkdir('./' .$folder_req[0].'/'.$folder_req[1].'/'.$folder_req[2].'/'.$folder_req[3].'/'.$folder_req[4].'/'.$folder_req[5].'/'.$folder_req[6].'/'.$folder_req[7].'/'.$folder_req[8], 0777, TRUE):'';
                                }
                      }
                    $output=1;
            }   
            else
            {
                $output=0;
            }
            return $output;
    }
}