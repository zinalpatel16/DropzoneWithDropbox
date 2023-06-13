<?php

namespace Hcipl\DropzoneWithDropbox\Controllers;
use Hcipl\DropzoneWithDropbox\Models\ImageUpload;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Jobs\DeleteRecord;

use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller {
	
    public function index()
    {
        return view('dropzoneWithDropbox::imageupload_list');
    }

    public function ajaxData(Request $request) {

        $records = $data  = array();
        $records["data"] = array();

        ## Request Parameters
        $post = $request->All(); 
        $search = (isset($post['search']['value']) ? ($post['search']['value']) : "");
       
        $tot_records_data = ImageUpload::getAllData($iDisplayLength = NULL, $iDisplayStart = NULL, $sort = NULL, $sortdir = NULL, $search);
        $iTotalRecords = count($tot_records_data);
        $iDisplayLength = (isset($post['length']) ? intval($post['length']) : 50);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = (isset($post['start']) ? intval($post['start']) : 1);
        $sEcho = (isset($post['draw']) ? intval($post['draw']) : 1);

        $sorton = (isset($post['order'][0]['column']) ? $post['order'][0]['column'] : "");
        $sortdir = (isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'DESC');

        if (isset($sorton) && $sorton != "") {
            switch ($sorton) {
                case "0":
                    $sort = "id";
                    break;
                case "1":
                    $sort = "filename";
                    break;
                default:
                    $sort = "id";
            }
        } else {
            $sort = "id";
        }
        
        $data = ImageUpload::getAllData($iDisplayLength, $iDisplayStart, $sort, $sortdir, $search);

        $cnt = count($data);
         
        for ($i = 0; $i < $cnt; $i++) {

            $records["data"][] = array(
                '<input type="checkbox" class="sub_chk" data-id="'.$data[$i]['id'].'">',
                $data[$i]['id'],
                $data[$i]['filename'],
                '<a href="' . route('image/delete',[ 'id' => $data[$i]['id'], 'filename' => $data[$i]['filename']]). '" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>'
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
       
        return Response::json($records);
    }

    public function fileCreate()
    {
        return view('dropzoneWithDropbox::imageupload');
    }

    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();

        ## Upload file to dropbox 
        Storage::disk('dropbox')->putFileAs(
            'dropzone_uploads', $request->file('file'), $imageName
        );

        $image->move(storage_path('uploads'),$imageName);
        
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->save();

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy($id, $filename)
    {

        ## Queue job to delete a record
        dispatch(new DeleteRecord($id, $filename));

        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        $idArr = explode(",", $ids);

        foreach ($idArr as $id) {

            $filename = ImageUpload::getFileNameById($id);
            
            $path = storage_path().'/uploads/'.$filename;

            if (file_exists($path)) {

                unlink($path);
            }
            
            ## Delete image from dropbox
            Storage::disk('dropbox')->delete( array('dropzone_uploads/'.$filename) );
        }

        ImageUpload::whereIn('id', $idArr)->delete();

        return response()->json(['success'=>"Files deleted successfully."]);
    }
}