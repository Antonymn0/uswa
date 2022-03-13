<?php

namespace App\Http\Controllers\Api\Zoom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\ZoomOauth;

class ZoomAuthController extends Controller
{
    public $CLIENT_ID ;
    public $CLIENT_SECRET;
    public $REDIRECT_URI;

    public function __construct(){
        $this->CLIENT_ID = env('ZOOM_CLIENT_ID');
        $this->CLIENT_SECRET = env('ZOOM_CLIENT_SECRET');
        $this->REDIRECT_URI = env('ZOOM_REDIRECT_URI');
    }


    /** 
     * Get zoom auth token
     *@param  $request->code
    */
    public function getZoomAuthToken(Request $request){
        $client = new Client(['base_uri' => 'https://zoom.us']);
        $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode($this->CLIENT_ID.':'.$this->CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $request->code, // get zoom access token
                    "redirect_uri" => $this->REDIRECT_URI
                ],
            ]);        
        $token = json_decode($response->getBody()->getContents());
        $data = [
             'provider' => 'zoom', 
             'token_type' => $token->token_type, 
             'refresh_token' => $token->refresh_token,
             'token' => $token->access_token
            ];

        // save token to database
        $zoom_oauth = ZoomOauth::where('provider', 'zoom')->first(); // first record
        if(! empty($zoom_oauth)) $zoom_oauth->update($data);
        else  ZoomOauth::create($data); 

        return redirect()->intended('home');
    }


    /**
     * Create/schedule a new zoom meeting
     * 
    */
    public function createZoomMeeting(Request $request){        
        
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $accessToken = ZoomOauth::where('provider', 'zoom')->first()->token;
            
            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => $request->topic,
                    "type" => $request->type,
                    "start_time" => $request->start_time,
                    "duration" => $request->duration, // 30 mins
                    "password" => "123456"
                ],
            ]);
    
            $data = json_decode($response->getBody());
            return response()->json([
                'success'=>  true,
                'message' => 'Success, zoom meeting created',
                'data'=> $data
            ],200);     
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
    public function deleteZoomMeeting(Request $request, $meeting_id){
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
        return json_decode($response->getBody());
    }

    /**
     * Get zoom credentilas
     * @param $meeting_id
     * @return $credentials
     */
    public function getZoomCredentials(Request $request){
      $data = [
        'client_id'=> env('ZOOM_CLIENT_ID'),
       'client_secret' => env('ZOOM_CLIENT_SECRET'),
        'redirect_uri' => env('ZOOM_REDIRECT_URI')
        ] ;
        return response()->json([
            'success'=>  true,
            'message' => 'Success, zoom credentials fetched',
            'data'=> $data
        ],200);        
    }

    /**
    * Get currennt zoom user auth token
    */
    public function  getZoomUserToken(Request $request){
        $user = $request->user();
        $token =  ZoomOauth::first();
        return response()->json([
                'success'=>  true,
                'message' => 'Users zoom token',
                'data'=> $token
            ],200);
    }

     /**
     * refresh zoom token
     */
    public function refreshZoomAuthToken(Request $request){
        $zoom_oauth = ZoomOauth::where('provider', 'zoom')->first(); // first record
        $client = new Client(['base_uri' => 'https://zoom.us']);
           
        $response = $client->request('POST', '/oauth/token', [
            "headers" => [
                "Authorization" => "Basic ". base64_encode($this->CLIENT_ID.':'.$this->CLIENT_SECRET),
                "Content-Type" => "application/x-www-form-urlencoded"
            ],
            'form_params' => [
                "refresh_token" => $zoom_oauth->refresh_token,
                "grant_type"=>"refresh_token"
            ],
        ]);

        $token = json_decode($response->getBody()->getContents());

        // save token to database
        $zoom_oauth->update([
             'token' =>  $token->access_token,
             'refresh_token' => $token->refresh_token,
             'token_type' => $token->token_type
             ]);
        return response()->json([
            'success'=>  true,
            'message' => 'Users zoom token refreshed',
            'data'=> $token
        ],200);

    }

}
