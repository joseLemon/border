<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index() {
        $cms = Cms::find(1);

        $params = [
            'cms' => $cms
        ];

        return view('cms.index',$params);
    }

    public function update(Request $request) {
        $cms = Cms::find(1);
        if(!$cms) {
            $cms = new Cms();
        }

        $cms->about_title = $request->input('about_title');
        $cms->about_text = $request->input('about_text');

        if($_FILES['banner_img']['size'] > 0) {
            $delete = false;
            if($cms->banner_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','banner_img',$delete,true,450,450,true);
            $cms->banner_img = $_FILES['banner_img']['name'];
        }
        if($request->input('state_check_banner_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','banner_img'.strchr($cms->banner_img,'.'));
            $cms->banner_img = \DB::raw('NULL');
        }

        if($_FILES['banner_top_img']['size'] > 0) {
            $delete = false;
            if($cms->banner_top_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','banner_top_img',$delete,true,450,450,true,false);
            $cms->banner_top_img = $_FILES['banner_top_img']['name'];
        }
        if($request->input('state_check_banner_top_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','banner_top_img'.strchr($cms->banner_top_img,'.'));
            $cms->banner_top_img = \DB::raw('NULL');
        }

        $cms->about_title = $request->input('about_title');
        $cms->about_text = $request->input('about_text');
        $cms->about_item_1_title = $request->input('about_item_1_title');
        $cms->about_item_1_text = $request->input('about_item_1_text');
        $cms->about_item_2_title = $request->input('about_item_2_title');
        $cms->about_item_2_text = $request->input('about_item_2_text');
        $cms->about_item_3_title = $request->input('about_item_3_title');
        $cms->about_item_3_text = $request->input('about_item_3_text');

        if($_FILES['about_item_1_img']['size'] > 0) {
            $delete = false;
            if($cms->about_item_1_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','about_item_1_img',$delete,true,450,450,true);
            $cms->about_item_1_img = $_FILES['about_item_1_img']['name'];
        }
        if($request->input('state_check_about_item_1_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','about_item_1_img'.strchr($cms->about_item_1_img,'.'));
            $cms->about_item_1_img = \DB::raw('NULL');
        }

        if($_FILES['about_item_2_img']['size'] > 0) {
            $delete = false;
            if($cms->about_item_2_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','about_item_2_img',$delete,true,450,450,true);
            $cms->about_item_2_img = $_FILES['about_item_2_img']['name'];
        }
        if($request->input('state_check_about_item_2_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','about_item_2_img'.strchr($cms->about_item_2_img,'.'));
            $cms->about_item_2_img = \DB::raw('NULL');
        }

        if($_FILES['about_item_3_img']['size'] > 0) {
            $delete = false;
            if($cms->about_item_3_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','about_item_3_img',$delete,true,450,450,true);
            $cms->about_item_3_img = $_FILES['about_item_3_img']['name'];
        }
        if($request->input('state_check_about_item_3_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','about_item_3_img'.strchr($cms->about_item_3_img,'.'));
            $cms->about_item_3_img = \DB::raw('NULL');
        }

        $cms->directory_title = $request->input('directory_title');
        $cms->contact_title = $request->input('contact_title');
        $cms->contact_text = $request->input('contact_text');
        $cms->contact_address = $request->input('contact_address');
        $cms->footer_address = $request->input('footer_address');

        if($_FILES['footer_img']['size'] > 0) {
            $delete = false;
            if($cms->footer_img) {
                $delete = true;
            }
            fileUploadController::imgUpload(public_path().'/uploads/cms/','footer_img',$delete,true,450,450,true,false);
            $cms->footer_img = $_FILES['footer_img']['name'];
        }
        if($request->input('state_check_footer_img') == 'removed') {
            fileUploadController::deleteFile(public_path().'/uploads/cms/','footer_img'.strchr($cms->footer_img,'.'));
            $cms->footer_img = \DB::raw('NULL');
        }

        $cms->footer_fb = $request->input('footer_fb');
        $cms->footer_twitter = $request->input('footer_twitter');
        $cms->footer_bottom = $request->input('footer_bottom');
        $cms->save();

        \Session::flash('alertMessage','Contenido editado correctamente.');
        \Session::flash('alert-class','alert-success');

        return redirect()->route('cms.index');
    }
}