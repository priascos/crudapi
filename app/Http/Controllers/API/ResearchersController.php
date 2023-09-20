<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Researchers;
use Illuminate\Support\Facades\Http;

class ResearchersController extends Controller
{
    public function list(Request $request){

        $perPage = $request->input('per_page', 2);
        try { 
            $data = Researchers::paginate($perPage);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function form(Request $request){

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

    public function create($orcid)
    {
        $response = Http::get('https://pub.orcid.org/v3.0/'.$orcid);

        $xmlData = $response->body();

        $xml = simplexml_load_string($xmlData);

        $namespaces = $xml->getNamespaces(true);

        if($xml->xpath('//personal-details:given-names')){
            $gName = $xml->xpath('//personal-details:given-names')["0"];
        }else{
            $gName = "";
        }
        if($xml->xpath('//personal-details:family-name')){
            $fName = $xml->xpath('//personal-details:family-name')["0"];
        }else{
            $fName = "";
        }
        if($xml->xpath('//email:email')){
            $email = $xml->xpath('//email:email')["1"];
        }else{
            $email = "";
        }
        if($xml->xpath('//keyword:content')){
            $keyword = $xml->xpath('//keyword:content')["0"];
        }else{
            $keyword = "";
        }

        try {
            $data['orcid'] = $orcid;
            $data['given-names'] = $gName;
            $data['family-names'] = $fName;
            $data['email'] = $email;
            $data['keywords'] = $keyword;
            $res = Researchers::create($data);
            response()->json( $res, 200);
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
