<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Auth;   
use Carbon\Carbon;

class InstagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    // Recieve access token and store for future calls
    // get code from response

       $igCodeArray  = $request->all();
       $igCode = $igCodeArray['code'];

     //request access token
       $client = new \GuzzleHttp\Client();
       $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
        'form_params' => [
            'client_secret' => '074c37b7b8794cbab25d58f5feabf1cc',
            'client_id' => '16b479bb667f424fb1bcb1c8dae8cf9f',
            'redirect_uri' => 'https://20-twenty.online/instagram/callback/',
            'code' => $igCode,
            'grant_type' => 'authorization_code'
        ]
    ]
);

       $response = $response->getBody()->getContents();
       $dataArray = json_decode($response); 
       $igToken = data_get($dataArray, 'access_token', 0);
       $igUserName = data_get($dataArray, 'user.username', 0);
       $igRealName = data_get($dataArray, 'user.full_name', 0);
       $igBio = data_get($dataArray, 'user.bio', 0);
       $igBusiness = data_get($dataArray, 'user.is_business',true);

// leaving for debuging in the future
// dd($igToken,$igUserName, $igRealName, $igBio, $igBusiness);

// get ig user data break in to vars from array
       $client = new \GuzzleHttp\Client();
       $access_token = "?access_token=";
       $verb = "media/recent/";
       $baseURI = "https://api.instagram.com/v1/users/self/";
       $url = $baseURI . $access_token . $igToken;
       $requestUserData = $client->get($url);
       $UserResponse = $requestUserData->getBody()->getContents();
       $userResponseArray = json_decode($UserResponse);

// Total current media posted and follows
       $igMediaPosts = data_get($userResponseArray, 'data.counts.media', 0);
       $igFollowedBy = data_get($userResponseArray, 'data.counts.followed_by', 0);

// Media information

       // get ig user data break in to vars from array
       $url = $baseURI . $verb . $access_token . $igToken;
       $requestUserMediaData = $client->get($url);
       $UserMediaResponse = $requestUserMediaData->getBody()->getContents();
       $userMediaResponseArray = json_decode($UserMediaResponse);

// $flattened = Arr::flatten($userMediaResponseArray);

       $likes = 0;
       $comments = 0;
       foreach($userMediaResponseArray->data as $res) {
        $likes += $res->likes->count;
        $comments += $res->comments->count;
    }

// Engagement Rate Calculator

    $EngagementRate = 0;
    $varDump = round($EngagementRate = ($likes + $comments) / $igFollowedBy * 100 / 10 ,2);
    $data = array ($likes, $comments, $igFollowedBy, $varDump );

return $this->store($likes, $igFollowedBy, $igMediaPosts, $varDump);

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
    public function store($likes, $igFollowedBy, $igMediaPosts, $varDump)
    {
     
$currentuserid = Auth::user()->id;
$now = Carbon::now()->toDateTimeString();
     $saveIGData =  DB::table('ig')->insert(
            ['likes' => $likes,
            'userID' => $currentuserid,
            'updated_at' => $now,
            'created_at' => $now,
             'followers' => $igFollowedBy, 
             'posts'=>$igMediaPosts,
             'engagementRate'=> $varDump
            ]);

return Redirect::route('rates');    }

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
}
