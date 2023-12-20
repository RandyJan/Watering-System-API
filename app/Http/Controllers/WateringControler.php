<?php

namespace App\Http\Controllers;

use App\Models\deviceSensor;
use Carbon\Carbon;
use App\Models\deviceData;
use App\Models\state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WateringControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateget = Carbon::now();
        $date = $dateget->format('Y-m-d');
        $datetoday = deviceData::where('date', $date)->max('usage');
        $usageinc = $datetoday + 1;
        if(empty($datetoday)){
            deviceData::insert([
                "usage"=> $request->usage,
                "date"=>$date]);
        }
        else{
deviceData::where("date", $date)->update(['usage'=>$usageinc]);
        }
        Log::info($usageinc);
        return response()->json("added liter successfuly");


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $response = deviceSensor::first('state');

        // if($response->state == 0)
        // {
        //     return response("off");
        // }
        // else{
            return response($response->state);
        // }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request)
    {
        // $ip = $request->ip();
        $data = json_decode($request['state']);
        $response = deviceSensor::where('id',10)->update(['state' => $data]);
        // if(!$response){
        //     return response()->json(["Something went wrong"]);
        // }
        // return response()->json(["Device successfuly switched!"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function show(){
       $response = deviceData::all();
        return response()->json($response);
    }
//     public function getIP(Request $request)
// {
//     $ip = $request->ip();

//     return response()->json(['ip' => $ip]);
// }
public function sensor(){

   $sensorStatus = deviceSensor::all();
    return response()->json($sensorStatus->all());
}
public function setSensor(Request $request)
{
    $network = 11;
   $response = deviceSensor::where('network', 1)->update([
        'pump'=>$request->relay,
        'moisture'=>$request->moisture,
        'waterlvl'=> $request->floating,
    ]);
    Log::info($request->all());
    return response()->json($response);
}
public function computeUsage(){
    $datenow = Carbon::now();
    $datenowformat = $datenow->format('Y-m-d');
    $datenowformatb = '2023-12-12 00:00:00.0000000';
$response = deviceData::where('date',$datenowformatb)->sum('usage');
Log::info($response);
return response()->json([
    "water_consumption"=>$response
]);
}
public function waterlvlmonitoring(Request $request){
    // $test =json_encode($request['floatsensor'],true);
    $test2 = json_decode($request['floatsensor']);
    // $test3 = json_decode($test2,true);
    $response = deviceSensor::where('id', 10)->update([
        'pump'=>$request->relay,
        'moisture'=>$request->moisture,
        'waterlvl'=> $request->floating,
    ]);
    Log::info($request->all());
        if(!$response){
            return response("network failure");
        }
        else{
            // return response("sensor is being monitored");
        }
}
}
