<?php
//Manoj new code on 23 Sept 2017
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Classes;

use Illuminate\Contracts\Filesystem\Filesystem;
use Config;
use DB;
use App\Models\backend\Employee;
use Auth;

class S3 {
    // google storage
    public static function s3Configuration() {
        $data = DB::table('system_configs')->where('id', 1)->get();
       
        Config::set('filesystems.disks.gcs.bucket', $data[0]->aws_bucket_id);
        //  Config::set('filesystems.disks.gcs.bucket', 'bkt_bms_laravel');
        // Config::set('filesystems.disks.gcs.bucket', 'edynamicsdevelopment');
         Config::set('filesystems.disks.gcs.project_id','756686641793');
        Config::set('filesystems.disks.gcs.driver', 'gcs');
        
    }

    public static function s3FileUplod($image, $s3FolderName,$cnt) {
        S3::s3Configuration();
        $name = '';
        $random = rand(1,1000);
        //print_r($image);exit;
        for ($i = 0; $i < $cnt; $i++) {
            $imageFileName = time().'_'.$random . $i . '.' . $image[$i]->getClientOriginalExtension();
            $imagePath = $image[$i]->getPathName();
            
            $disk = \Storage::disk('gcs');
            $filePath = '/'.$s3FolderName.'/'. $imageFileName;
            $disk->put($filePath, file_get_contents($imagePath));
            
            $name .= ',' . $imageFileName;
        }
        if ($name !== '') {
            return($name);
        }
    }
    
    
    // google storage
     public static function s3FileUpload($filepath, $filename, $s3FolderName) {
        //  echo "filepath= ".$filepath." filename=". $filename." s3FolderName". $s3FolderName."<br>";

        S3::s3Configuration();       

        $name = '';
        $disk = \Storage::disk('gcs');
        $s3Path = $s3FolderName.'/'. $filename;
        // dd(file_get_contents($filepath));
        $disk->put($s3Path, file_get_contents($filepath));
        $name = $filename;
        if ($name !== '') {
            // echo "$name";
            return($name);
        }

        // dd(S3::s3FileLists($filename));
    }
    
    public static function s3FileUplodForApp($image, $s3FolderName, $cnt) {
        S3::s3Configuration();
        //for ($i = 0; $i < $cnt; $i++) {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageFileName = time() . '.' . $ext;
        $imagePath = $image['tmp_name'];
        
        $disk = \Storage::disk('gcs');
        $filePath = '/'.$s3FolderName.'/'. $imageFileName;
        $disk->put($filePath, file_get_contents($imagePath));
        
        return $imageFileName;
   }

    public static function s3FileDelete($s3FolderName) {
      
        S3::s3Configuration();
        if (\Storage::disk('gcs')->exists($s3FolderName)) {
            \Storage::disk('gcs')->delete($s3FolderName);
            return true;
        } else {
            return false;
        }
    }
    public static function s3FolderDelete($s3FolderName) {
        
        S3::s3Configuration();
        $files = \Storage::disk('gcs')->delete($s3FolderName);
        if ($files) {
            $result = ['success' => true, 'files' => $files];
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
        }
        return json_encode($result);
    }

    public static function s3FileLists($image) {
        S3::s3Configuration();
        // echo "image==".$image;
        $files = \Storage::disk('gcs')->allFiles($image);
        if ($files) {
            $result = ['success' => true, 'files' => $files];
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
        }
        return json_encode($result);
    }
    public static function s3CreateSubDirectory($newFolder,$mainFolder) {
        S3::s3Configuration();
        $folder = $newFolder."/".$mainFolder;
       
        $files = \Storage::disk('gcs')->makeDirectory($folder);
        if ($files) {
            $result = ['success' => true, 'files' => $files];
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
        }
        return json_encode($result);

    }
    public static function s3CreateDirectory($newFolder) {
        S3::s3Configuration();
        $files = \Storage::disk('gcs')->makeDirectory($newFolder);
        if ($files) {
            $result = ['success' => true, 'files' => $files];
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
        }
        return json_encode($result);
    }    

}
