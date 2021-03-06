<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class Publication extends Model
{
    protected $fillable=['title', 'title_bang', 'slug','phone','email','address', 'detail_info', 'image', 'created_by','updated_by', 'status' ];

    public static function savePublicationInfo($request){

        $slugTxt = Str::slug($request->title);

        $request->validate([
            'title'         =>'required',
            'title_bang'    =>'required',
            'image'         =>'image|max:1200',
        ]);
        $filename ='';
        if($request->hasFile('image')) {
            $image       = $request->file('image');
            $filename = rand().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1000, 150);
            $image_resize->save(public_path('uploads/publications/' .$filename));
        }
        //echo $filename; exit();
        $form_data = array(
            'title'         =>$request->title,
            'title_bang'    =>$request->title_bang,
            'slug'          =>$slugTxt,
            'phone'         =>$request->phone,
            'email'         =>$request->email,
            'address'       =>$request->address,
            'detail_info'   =>$request->detail_info,
            'status'        =>1,
            'image'         =>$filename,
            'created_by'    =>Auth::id(),
            'created_at'    =>time()
        );

        Publication::create($form_data);
    }

    //UPDATE Publication INFORMATION
    public static function updatePublicationInfo($request, $id){

        $Publication = Publication::findOrFail($id);
        $slugTxt = Str::slug($request->title);

        $filename =$request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request -> validate([
                'title'         =>'required',
                'title_bang'    =>'required',
                'image'         =>'image|max:1000'
            ]);

            $image          = $request->file('image');
            $filename       = rand().'.'.$image->getClientOriginalExtension();
            $image_resize   = Image::make($image->getRealPath());
            $image_resize->resize(1000, 150);
            $image_resize->save(public_path('uploads/publications/' .$filename));

        }else{
            $request -> validate([
                'title'         =>'required',
                'title_bang'    =>'required',
            ]);
        }

        $form_data = array(
            'title'         =>$request->title,
            'title_bang'    =>$request->title_bang,
            'slug'          =>$slugTxt,
            'detail_info'   =>$request->detail_info,
            'image'         =>$filename,
            'updated_by'    =>Auth::id(),
            'status'        =>$request->status,
        );

        DB::table('publications')->where([
            ['id', '=', $id],
        ])->update($form_data);
        //Publication::WhereId($id)->update($form_data);
        //return redirect('admin.writer.index')->with('success', 'Writer Updated Successfully!');
        return redirect('crud')->with('success', 'Publication Updated Successfully!');

    }


    public static function getData($id, $field) {
        $value = Publication::where('id', $id)->first();
        if (empty($value->$field)) {
            return null;
        } else {
            return $value->$field;
        }
    }
}
