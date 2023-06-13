<?php

namespace Hcipl\DropzoneWithDropbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class ImageUpload extends Model
{
    use HasFactory;

    protected $table = 'image_uploads';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'created_at', 'updated_at'
    ]; 

    public $timestamps = false;

    public static function getAllData($iDisplayLength = NULL, $iDisplayStart = NULL, $sort = NULL, $sortdir = NULL, $search = NULL)
    {   
    	
        //echo $sort. " ".$sortdir;exit;
    	$query = DB::table('image_uploads');
        $query->select('image_uploads.*');
       
        if (isset($search) && $search != "") {
            $query->where(function ($query) use ($search) {
                $query->orWhere('filename', 'like', ''.$search.'%');
                $query->orWhere('id', $search);
                
            });
        }
        if (isset($iDisplayLength) && $iDisplayLength != "") {
            $query->limit($iDisplayLength);
        }
        if (isset($iDisplayStart) && $iDisplayStart != "") {
            $query->offset($iDisplayStart);
        }
        if (isset($sort) && $sort != "" && isset($sortdir) && $sortdir != "") {
            $query->orderBy($sort, $sortdir);
        }
        //echo $query->toSql();//exit;
        $rData =  $query->get()->toArray();
        $rData = json_decode(json_encode($rData), true);
        return $rData;
    }

    /**
     * Get File Name By ID
     *
     * @param int ID
     * @return array File Name Data   
    */
    public static function getFileNameById($id)
    {
        $result = self::select('filename')->where('id', $id)->first();

        if(isset($result->filename)) {

            return $result->filename;
        }
        else {
            return '';   
        }
    }
}
