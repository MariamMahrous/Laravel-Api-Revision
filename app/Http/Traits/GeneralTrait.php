<?php

namespace App\Http\Traits;


Trait GeneralTrait{


    public function returnError($errNum,$msg){
        return response()->json([
            'status' =>false,
            'Error Number' =>$errNum,
            'Massage'=>$msg

        ]);

    }
     public function returnSuccess($errNum,$msg){
        return response()->json([
            'status' =>true,
            'Error Number' =>$errNum,
            'Massage'=>$msg

        ]);
    }
  public function returnData($msg="",$key,$value){
       
            return response()->json([
            'status' =>true,
            'errorNum' =>"s000",
            'msg'=>$msg,
            $key=>$value,

        ]);
        
    }






}