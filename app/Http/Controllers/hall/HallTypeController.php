<?php

namespace App\Http\Controllers\hall;
use App\Models\Halltype;
use Illuminate\Http\Request;
use App\Models\HallTypeimage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class HallTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=halltype::all();


        return view('hall.halltype.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hall.halltype.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',
            'prize'=>'required',

            'detail'=>'required',
        ]);

        $data=new Halltype();
        $data->name=$request->name;
        $data->prize=$request->prize;

        $data->detail=$request->detail;

        $data->save();

        foreach($request->file('imgs') as $img){

                $imgPath=$img->store('public/imgs');
                $imgData= new HallTypeimage();

                $imgData->hall_type_id=$data->id;
                $imgData->scr_image=$imgPath;
                $imgData->alt_image=$request->name;
                $imgData->save();




        }

        return redirect('hall/halltype')->with('success','data has being added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Halltype::find($id);

        return view('hall.halltype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data=halltype::find($id);

        $data->name=$request->name;
        $data->prize=$request->prize;

        $data->detail=$request->detail;

        if($request->hasFile('imgs')){
        foreach($request->file('imgs') as $img){

            $imgPath=$img->store('public/imgs');
            $imgData= new HallTypeimage();

            $imgData->hall_type_id=$data->id;
            $imgData->scr_image=$imgPath;
            $imgData->alt_image=$request->name;
            $imgData->save();


        }

    }
        $data->update();

        return redirect('hall/halltype')->with('success','data has being updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $post = halltype:: find($id);

        if($post){
            $post->delete();
            return redirect('admin/halltype')->with('massage','deleted successfully');

        }
        else{
            return redirect('admin/halltype')->with('massage', 'no post id found');
        }

//updated error
    }

    public function destroy_image($img_id)
    {
        $data=halltypeimage::where('id',$img_id)->first();
        Storage::delete($data->scr_image);

        halltypeimage::where('id',$img_id)->delete();
       return response()->json(['bool'=>true]);
    }
}