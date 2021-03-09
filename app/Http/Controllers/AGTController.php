<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agt;
Use Alert;
use Auth;

class AgtController extends Controller
{
    Public function index(){
        $data['agt_user'] = Agt::orderBy('id','desc')->get();
        return view('home',$data);
    }
    Public function store(Request $request){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'pincode'   => 'digits:6',
            'image'     => 'required'
        ]);
        $email = $request->email;

        if(!Agt::where('email',$email)->exists()){
            $filename = time() . "." . $request->image->extension();
            $request->image->move(public_path("image"),$filename);

            $user = new Agt();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->pincode = $request->pincode;
            $user->image = $filename;
            $user->save();
            toast('User Successfully Added!','success');
        }else{
            toast('E-mail Already exists.','error');
        }
        return redirect()->back();

    }

    public function drop($id){
        Agt::where('id',$id)->delete();
        toast('Record Successfully Deleted!','success');
        return redirect()->back();
    }
    public function edit(Request $request, $id){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'pincode'   => 'digits:6'
        ]);

        Agt::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'pincode'=>$request->pincode
        ]);

        toast('Record Successfully Updated!','success');
        return redirect()->back();

    }

}
