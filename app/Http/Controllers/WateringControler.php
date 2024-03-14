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
        $presentdate = deviceData::where('date',$date)->first('date');
        $datetodayA = deviceData::where('date', $date)->max('soilusage1');
        $usageincA = $request->soilusage1 == 1 ? $datetodayA + 1 : $datetodayA;

        $datetodayB = deviceData::where('date', $date)->max('soilusage2');
        $usageincB = $request->soilusage2 == 1 ? $datetodayB + 1 : $datetodayB;

        $datetodayC = deviceData::where('date', $date)->max('soilusage3');
        $usageincC = $request->soilusage3 == 1 ? $datetodayC + 1 : $datetodayC;
        if(empty($presentdate) || $presentdate == "" || $presentdate == null ||$presentdate == []){
            deviceData::insert([
                "soilusage1"=> $request->soilusage1,
                "soilusage2"=> $request->soilusage2,
                "soilusage3"=> $request->soilusage3,
                "date"=>$date]);
                return response("Added new data for today");
        }
        else{
deviceData::where("date", $date)->update(['soilusage1'=>$usageincA,
'soilusage2'=>$usageincB,
'soilusage3'=>$usageincC,]);
}
Log::info($presentdate);
return response()->json("updated todays liter successfuly", );


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
        'moisture1'=>$request->moisture1,
        'moisture2'=>$request->moisture2,
        'moisture3'=>$request->moisture3,
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
    $response = deviceSensor::where('network', 1)->update([
       
        'pump'=>$request->relay,
       'moisture1'=>$request->moisture1,
       'moisture2'=>$request->moisture2,
       'moisture3'=>$request->moisture3,
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