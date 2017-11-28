<?php
namespace App\Http\Controllers;

class fileUploadController extends Controller {
    public static function imgUpload($target_dir, $input_name, $delete = false, $individual = false, $max_width = 700, $max_height = 394, $use_name = false, $thumbnail = true) {
        //  Create temporary directory
        if(!is_dir($target_dir) && !file_exists($target_dir)) {
            mkdir($target_dir);
        }
        if ($_FILES[$input_name]["size"] > 25000000) {
            return 'failed';
        }

        if($delete) {
            //  Delete files if they exist
            if($individual) {
                $file = $target_dir.$_FILES[$input_name]['name']; // get all file names
                if (file_exists($file)) {
                    unlink($file); // delete file
                }
            } else {
                $files = glob($target_dir.'/*'); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                }
            }
        }

        if($use_name) {
            $path = $_FILES[$input_name]['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $name = $input_name.'.'.$extension;
        } else {
            $name = $_FILES[$input_name]['name'];
        }

        if($thumbnail) {
            if(move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_dir . 'temp.tmp')) {
                // Resize it
                self::GenerateThumbnail($target_dir . 'temp.tmp',$target_dir . $name,$max_width,$max_height,1);
                // Delete full size
                unlink($target_dir . 'temp.tmp');
                return 'thumbnail success';
            } else {
                return 'thumbnail failed';
            }
        } else {
            if(move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_dir . $name)) {
                return 'image success';
            } else {
                return 'image failed';
            }
        }
    }

    public static function generalUpload($target_dir, $input_name, $delete = false, $individual = false, $folder = false,$is_array = false,$array_key = null) {
        //  Create temporary directory
        if(!is_dir($target_dir) && !file_exists($target_dir)) {
            mkdir($target_dir);
        }
        if($folder) {
            $target_dir = $target_dir.$input_name.'/';
            if(!is_dir($target_dir) && !file_exists($target_dir)) {
                mkdir($target_dir);
            }
        }

        if($is_array) {
            if ($_FILES[$input_name]["size"][$array_key] > 25000000) {
                return 'failed';
            }
        } else {
            if ($_FILES[$input_name]["size"] > 25000000) {
                return 'failed';
            }
        }

        if($delete) {
            //  Delete files if they exist
            if($individual) {
                if($is_array) {
                    $file = $target_dir.$_FILES[$input_name]['name'][$array_key]; // get all file names
                } else {
                    $file = $target_dir.$_FILES[$input_name]['name']; // get all file names
                }
                if (file_exists($file)) {
                    unlink($file); // delete file
                }
            } else {
                $files = glob($target_dir.'/*'); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                        unlink($file); // delete file
                }
            }
        }

        if($is_array) {
            if(move_uploaded_file($_FILES[$input_name]["tmp_name"][$array_key], $target_dir . $_FILES[$input_name]['name'][$array_key])) {
                return 'success';
            } else {
                return 'failed';
            }
        } else {
            if(move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_dir . $_FILES[$input_name]['name'])) {
                return 'success';
            } else {
                return 'failed';
            }
        }
    }

    public static function GenerateThumbnail($im_filename,$th_filename,$max_width,$max_height,$quality = 0.75) {
        // The original image must exist
        if(is_file($im_filename))
        {
            // Let's create the directory if needed
            $th_path = dirname($th_filename);
            if(!is_dir($th_path))
                mkdir($th_path, 0777, true);
            // If the thumb does not aleady exists
            if(!is_file($th_filename))
            {
                // Get Image size info
                list($width_orig, $height_orig, $image_type) = @getimagesize($im_filename);
                if(!$width_orig)
                    return 2;
                switch($image_type)
                {
                    case 1: $src_im = @imagecreatefromgif($im_filename);    break;
                    case 2: $src_im = @imagecreatefromjpeg($im_filename);   break;
                    case 3: $src_im = @imagecreatefrompng($im_filename);    break;
                }
                if(!$src_im)
                    return 3;
                $aspect_ratio = (float) $height_orig / $width_orig;
                $thumb_height = $max_height;
                $thumb_width = round($thumb_height / $aspect_ratio);
                if($thumb_width > $max_width)
                {
                    $thumb_width    = $max_width;
                    $thumb_height   = round($thumb_width * $aspect_ratio);
                }
                $width = $thumb_width;
                $height = $thumb_height;
                $dst_img = @imagecreatetruecolor($width, $height);
                if(!$dst_img)
                    return 4;
                $success = @imagecopyresampled($dst_img,$src_im,0,0,0,0,$width,$height,$width_orig,$height_orig);
                if(!$success)
                    return 4;
                switch ($image_type)
                {
                    case 1: $success = @imagegif($dst_img,$th_filename); break;
                    case 2: $success = @imagejpeg($dst_img,$th_filename,intval($quality*100));  break;
                    case 3: $success = @imagepng($dst_img,$th_filename,intval($quality*9)); break;
                }
                if(!$success)
                    return 4;
            }
            return 0;
        }
        return 1;
    }

    public static function deleteFile($target_dir,$file_name) {
        $file = $target_dir.$file_name; // get all file names
        if (file_exists($file)) {
            unlink($file); // delete file
        }
    }
}