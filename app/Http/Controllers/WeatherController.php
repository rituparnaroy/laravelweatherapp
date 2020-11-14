<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use App\Http\Requests;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.weather');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    /**
     * Get requested data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getWeather(Request $request)
    {
        $this->validate($request,[
            'city'=>'required',
            'countrycode'=>'required|max:2'
         ]);

        if (!empty($request->city) && !empty($request->countrycode)) {
            $city = Str::lower($request->city);
            $countrycode = Str::lower($request->countrycode);
            $cacheKey = 'key' . $city . $countrycode;
            try{
                if(Cache::has($cacheKey)){
                    $avgTemperature = Cache::get($cacheKey);
                }
                else{
                    $client = new Client();
                    $weatherResponse = $client->request('GET','https://api.weatherbit.io/v2.0/forecast/daily?city=' . $city . ',' . $countrycode . '&key=' . getenv('WEATHERBIT_API_KEY') . '&days=10');
    
                    $weather = json_decode($weatherResponse->getBody());
                    if($weather === null) {
                        return view('pages.weather', ['message'=> 'City or Countrycode is wrong']);
                    }
                    else {
                        $data = $weather->data;
                        $avgTemperature = $data[0]->temp;
                        Cache::put($cacheKey, $avgTemperature, now()->addHours(2));
                    }
                }
                return view('pages.weather', ['avgTemperature' => $avgTemperature, 'city' => Str::ucfirst($city), 'country' => Str::upper($countrycode)]);
                
                
            } catch (\Exception $e) {
                // No exception will be thrown here
                echo $e->getMessage();
            }
        }else {
            return view('pages.weather');
        }
        
        
    }
}
