<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome(){


        return view('home');
    }
    public function getUser(){
        $myuser = DB::table('myusers')->get();
        return response()->json(['myuser' => $myuser]);
    }


    public function deleteUser($id){
        try {
            
            $delete = DB::table('myusers')->where('id',$id)->delete();

        } catch (\Exception $e) {
            return response()->json(['result'=>'false']);
           
        }

        return response()->json(['result'=>'true']);
    }
    public function addUser(Request $request){
        try {
            $id= DB::table('myusers')->insertGetId([
                'name' => $request->get('name'),
                'surname' => $request->get('surname')

            ]);

            $copyUser = [
                'id' => $id,
                'name' => $request->get('name'),
                'surname' => $request->get('surname')

            ];
            
        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message'=> $th->getMessage()]);
        }
      
        return response()->json(['result' => true,'copyUser'=>$copyUser]);




    }
    public function editUserGet(Request $request){
        try {
           
            $user = DB::table('myusers')->where('id',$request->get('id'))->first();
        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message'=>$th->getMessage()]);
        }
        return response()->json(['result'=>true,'user'=>$user]);

    }
    public function editUserPost(Request $request){
        try {
           

            $user = DB::table('myusers')->where('id',$request->get('id'))->update([
                'name' =>  $request->get('name'),
                'surname' => $request->get('surname')
            ]);

            $updatedUser = DB::table('myusers')->where('id',$request->get('id'))->first();

            

        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message'=>$th->getMessage()]);
        }
        return response()->json(['result'=>true,'user'=>$updatedUser]);
    
    
    }
}
