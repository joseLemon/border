<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Directory;
use App\Models\Hexagon;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index() {
        $cms = Cms::find(1);
        $directories = Directory::get();
        $hexagons = Hexagon::get();

        $params = [
            'cms' => $cms,
            'directories' => $directories,
            'hexagons' => $hexagons
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

        $directories = $request->input('directories');
        if($directories) {
            foreach($directories as $iterationId => $element) {
                $elementArray = explode('_@@_', $element);
                $directory_id = $elementArray[1];
                if($directory_id == 'new') {
                    $directory = new Directory();
                } else {
                    $directory = Directory::find($directory_id);
                }
                $img_file = 'directory_'.($iterationId+1).'_img';
                if(isset($_FILES[$img_file])) {
                    if($_FILES[$img_file]['size'] > 0) {
                        $delete = false;
                        if($directory->directory_img) {
                            $delete = true;
                        }
                        fileUploadController::imgUpload(public_path().'/uploads/cms/directories/',$img_file,$delete, true,1920,2000,true, false);
                        $directory->directory_img = $img_file.strchr($_FILES[$img_file]['name'],'.');
                    }
                }
                if($request->input($img_file.'_check') == 'removed') {
                    fileUploadController::deleteFile(public_path().'/uploads/cms/directories/',$img_file.strchr($directory->directory_img,'.'));
                    $directory->directory_img = \DB::raw('NULL');
                }
                $directory->save();
            }
        }

        $hexagons = $request->input('hexagons');
        if($hexagons) {
            foreach($hexagons as $iterationId => $element) {
                $elementArray = explode('_@@_', $element);
                $hexagon_id = $elementArray[1];
                if($hexagon_id == 'new') {
                    $hexagon = new Hexagon();
                } else {
                    $hexagon = Hexagon::find($hexagon_id);
                }
                $img_file = 'hexagon_'.($iterationId+1).'_img';
                if(isset($_FILES[$img_file])) {
                    if($_FILES[$img_file]['size'] > 0) {
                        $delete = false;
                        if($hexagon->hexagon_img) {
                            $delete = true;
                        }
                        fileUploadController::imgUpload(public_path().'/uploads/cms/hexagons/',$img_file,$delete, true,1920,2000,true, false);
                        $hexagon->hexagon_img = $img_file.strchr($_FILES[$img_file]['name'],'.');
                    }
                }
                if($request->input($img_file.'_check') == 'removed') {
                    fileUploadController::deleteFile(public_path().'/uploads/cms/hexagons/',$img_file.strchr($hexagon->hexagon_img,'.'));
                    $hexagon->hexagon_img = \DB::raw('NULL');
                }
                $hexagon->hexagon_title = $elementArray[0];
                $hexagon->save();
            }
        }

        \Session::flash('alertMessage','Contenido editado correctamente.');
        \Session::flash('alert-class','alert-success');

        return redirect()->route('cms.index');
    }

    public function deleteElement($id,$type) {
        if($type == 'directory') {
            $directory = Directory::find($id);
            $directory->delete();
        }

        if($type == 'hexagon') {
            $hexagon = Hexagon::find($id);
            $hexagon->delete();
        }
    }
}