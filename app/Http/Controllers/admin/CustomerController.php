<?php

namespace App\Http\Controllers\admin;


use App\Models\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Customer::all();

        return view('admin.customer.index',compact('data',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.customer.create', );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data= new Customer;

        $data->full_name=$request->full_name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->photo=$request->photo;





        $data->save();

        return redirect('admin/customer')->with('success','data has being added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $data=Customer::find($id);

        return view('admin.customer.edit',compact('data'  ));
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

        $data=Customer::find($id);




        $data->full_name=$request->full_name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->photo=$request->photo;
        $data->update();

        return redirect('admin/customer')->with('success','data has being updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $post = Customer:: find($id);

        if($post){
            $post->delete();
            return redirect('admin/hall')->with('massage','deleted successfully');

        }
        else{
            return redirect('admin/hall')->with('massage', 'no post id found');
        }


    }
}
