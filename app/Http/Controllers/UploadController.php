<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uploadimage;
use File;
class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "";
    }


    public function upload_image(Request $request)
    {
        /* Images are required */
        if (Uploadimage::countImages() > 0)
        {
            /* Default validation:
                $uploadImages->image_type = "jpg|jpeg|png|gif";
                $uploadImages->min_size = "";
                $uploadImages->min_size = 24;
                $uploadImages->max_size = (1024*1024*3);
                $uploadImages->max_files = 10;
            */
            /* Validate */
            if (Uploadimage::validateImages())
            {

                /* images array */
                $images = Uploadimage::getImages();
                $uploadDir = $request->use_path;
                if ($request->use_path) {
                    $uploadDir = $request->use_path;
                }else{
                    $uploadDir = DIR_UPLOAD_XYZ;
                }
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($images as $image)
                {
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    $filename = md5(time().rand(1111, 9999)).'.'.$ext;
                    if (Uploadimage::saveImage($image["tmp_name"], $uploadDir, $filename))
                    {
                        $fileImage = $uploadDir.$filename;

                        $aHtml = view('upload.image')->with('fileImage', $fileImage)->render();
                        //return response()->json(array('success' => true, 'image'=>$aHtml));
                        $data = array('success' => true ,'image'=>$aHtml);
                        echo json_encode($data);die();
                    }
                    else
                    {
                        return response()->json(array('success' => false, 'message'=>'Có lỗi trong qua trình lưu hình ảnh'));
                    }
                }
            }
            else /* Show errors array */
            {
                return response()->json(array('success' => false, 'message'=>'Ảnh tải lên không hợp lệ'));
            }
        }
        else
        {
            return response()->json(array('success' => false, 'message'=>'Ảnh không được để trống'));
        }
    }

    public function upload_photos(Request $request)
    {
        /* Images are required */
        if (Uploadimage::countImages() > 0)
        {
            /* Default validation:
                $uploadImages->image_type = "jpg|jpeg|png|gif";
                $uploadImages->min_size = "";
                $uploadImages->min_size = 24;
                $uploadImages->max_size = (1024*1024*3);
                $uploadImages->max_files = 10;
            */
            /* Validate */
            if (Uploadimage::validateImages())
            {

                /* images array */
                $images = Uploadimage::getImages();
                $uploadDir = $request->use_path;
                if ($request->use_path) {
                    $uploadDir = $request->use_path;
                }else{
                    $uploadDir = DIR_UPLOAD_XYZ;
                }
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($images as $image)
                {
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    $filename = md5(time().rand(1111, 9999)).'.'.$ext;
                    if (Uploadimage::saveImage($image["tmp_name"], $uploadDir, $filename))
                    {
                        $fileImage = $uploadDir.$filename;
                        $aHtml = view('upload.photos')->with('fileImage', $fileImage)->render();
                        return response()->json(array('success' => true, 'images'=>$aHtml));
                    }
                    else
                    {
                        return response()->json(array('success' => false, 'message'=>'Có lỗi trong qua trình lưu hình ảnh'));
                    }
                }
            }
            else /* Show errors array */
            {
                return response()->json(array('success' => false, 'message'=>'Ảnh tải lên không hợp lệ'));
            }
        }
        else
        {
            return response()->json(array('success' => false, 'message'=>'Ảnh không được để trống'));
        }
    }

    public function photo_delete(Request $request)
    {
        $file = $request->file;
        if (file_exists($file)) {
            File::delete($file);
        }
        return response()->json(array('success' => true, 'file'=>$file));
    }


}
