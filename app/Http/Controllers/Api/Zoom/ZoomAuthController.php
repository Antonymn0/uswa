<?php

namespace App\Http\Controllers\Api\Zoom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\ZoomOauth;

class ZoomAuthController extends Controller
{
    

    /** 
     * Get zoom auth token
     *@param  $request->code
      */
    public function getZoomAuthToken(Request $request){
        $CLIENT_ID = env('ZOOM_CLIENT_ID');
        $CLIENT_SECRET = env('ZOOM_CLIENT_SECRET');
        $REDIRECT_URI = env('ZOOM_REDIRECT_URI');

        $client = new Client(['base_uri' => 'https://zoom.us']);

        $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode($CLIENT_ID.':'.$CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $request->code, // get zoom access token
                    "redirect_uri" => $REDIRECT_URI
                ],
            ]);  

        $token = json_decode($response->getBody()->getContents());

        $zoom_oauth = ZoomOauth::where('provider', 'zoom')->first();
        if(! empty($zoom_oauth)) $zoom_oauth->update([ 'token' =>  $token->access_token ]);
        else  ZoomOauth::create(['provider' => 'zoom','token' => $token->access_token]); 

        $zoom_success = true;

        dd($response);
        // $user =$request->user()->update(['zoom_linked' => 'yes']);

        // return view('welcome', compact(['zoom_success']));
    }

    /**
     * Create a new zoom meeting
     * 
     */
    public function createZoomMeeting(){

        $CLIENT_ID = env('ZOOM_CLIENT_ID');
        $CLIENT_SECRET = env('ZOOM_CLIENT_SECRET');
        $REDIRECT_URI = env('ZOOM_REDIRECT_URI');
        $base_uri = env('ZOOM_API_URL');

        
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $accessToken = ZoomOauth::where('provider', 'zoom')->first()->token;
            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => "Let's learn Laravel",
                    "type" => 2,
                    "start_time" => "2022-03-05T20:30:00",
                    "duration" => "30", // 30 mins
                    "password" => "123456"
                ],
            ]);
    
            $data = $response->getBody();
            return response()->json([
                'success'=>  true,
                'message' => 'Success, zoom meeting created',
                'data'=> $data
            ],200);

           }
        catch(Exception $e) {
            if( $e->getCode() == 401   ) {
                $client = new Client(['base_uri' => 'https://zoom.us']);
                $refresh_token = ZoomOauth::where('provider', 'zoom')->first()->token;
                $refresh_token->refresh_token;
               
                $response = $client->request('POST', '/oauth/token', [
                    "headers" => [
                        "Authorization" => "Basic ". base64_encode($CLIENT_ID.':'.$CLIENT_SECRET)
                    ],
                    'form_params' => [
                        "grant_type" => "refresh_token",
                        "refresh_token" => $refresh_token
                    ],
                ]);

                $token = json_decode($response->getBody()->getContents());
                $zoom_oauth = ZoomOauth::updateOrCreate([
                    'provider' =>  'zoom',
                    'token' =>  $token->access_token,   
                ]); 
                $this->createZoomMeeting();
            } else {
                return $e->getMessage();
            }
        }
    }

    /**
     * Get a list of all zoom meeetings
     */
    public function getMeetings(){
        $accessToken = ZoomOauth::where('provider', 'zoom')->first()->token;
        $client = new Client(['base_uri' => 'https://zoom.us/oauth/token']);  
        $request = [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ]
        ];
    
        if (!empty($next_page_token)) {
            $request['query'] = ["next_page_token" => $next_page_token];
        }
    
        $response = $client->request('GET', '/v2/users/me/meetings', $request);
        
        $data = json_decode($response->getBody());
         return response()->json([
                'success'=>  true,
                'message' => 'A list of zoom meetings',
                'data'=> $data
            ],200);
    }


    /**
     * Update zoom meeting
     */
    public function updateZoomMeeting($meeting_id){
        $accessToken = ZoomOauth::where('provider', 'zoom')->first()->token;
        $client = new Client(['base_uri' => 'https://zoom.us']);  
        
        $response = $client->request('PATCH', '/v2/meetings/'. $meeting_id, [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => "Let's Learn about the universe",
                "type" => 2,
                "start_time" => "2021-07-20T10:30:00",
                "duration" => "45", // 45 mins
                "password" => "123456"
            ],
        ]);
        
        if ($response->getStatusCode() == 204) {
            $data = json_decode($response->getBody());
            return response()->json([
                    'success'=>  true,
                    'message' => 'Success, zoom meeting updated',
                    'data'=> $data
                ],200);
        }
    }


    /**
     * Delete zoom meeting
     * @param $meeting_id
     */
    public function deleteZoomMeeting($meeting_id){
        $accessToken = ZoomOauth::where('provider', 'zoom')->first()->token;
        $client = new Client(['base_uri' => 'https://zoom.us']);  
        
        $response = $client->request('DELETE', '/v2/meetings/'. $meeting_id, [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ]
        ]);
        
        if ($response->getStatusCode() == 204) {
            $data = json_decode($response->getBody());
            return response()->json([
                    'success'=>  true,
                    'message' => 'Success, zoom meeting deleted',
                    'data'=> $data
                ],200);
        }
    }

    /**
     * Get zoom credentilas
     * @param $meeting_id
     * @return $credentials
     */
    public function getZoomCredentials(Request $request){
      $data = [
        'client_id '=> env('ZOOM_CLIENT_ID'),
       'client_secret' => env('ZOOM_CLIENT_SECRET'),
        'redirect_uri' => env('ZOOM_REDIRECT_URI')
      ] ;

        return response()->json([
            'success'=>  true,
            'message' => 'Success, zoom credentials fetched',
            'data'=> $data
        ],200);
        
    }

}
