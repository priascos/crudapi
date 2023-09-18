<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Researchers;

class ResearchersController extends Controller
{
    public function list(){
        try { 
            $data = Researchers::paginate();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function create(Request $request){

        // var_dump($request['givenName']." ".$request['familyName']);
        // $error->getError();

        try {
            $data['orcid'] = $request['orcid'];
            $data['given-names'] = $request['givenName'];
            $data['family-names'] = $request['familyName'];
            $data['email'] = $request['email'];
            $data['keywords'] = $request['keywords'];
            $res = Researchers::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function detail($orcid){
        try { 
            $data = Researchers::where('orcid', $orcid)->get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    // public function update(Request $request,$orcid){
    //     try { 
    //         $data['name'] = $request['name'];
    //         $data['address'] = $request['address'];
    //         $data['phone'] = $request['phone'];
    //         Researchers::find($orcid)->update($data);
    //         $res = Researchers::find($orcid);
    //         return response()->json( $res , 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([ 'error' => $th->getMessage()], 500);
    //     }
    // }
  
    public function delete($orcid){
        try {       
            $res = Researchers::where('orcid', $orcid)->delete(); 
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}
