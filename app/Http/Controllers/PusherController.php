<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
     /**
     * Authenticates logged-in user in the Pusher JS app
     * For private channels
     */
    public function pusherAuth(Request $request)
    {

        $user = auth()->user();
        $socket_id = $request['socket_id'];
        $channel_name =$request['channel_name'];
        $key = getenv('PUSHER_APP_KEY');
        $secret = getenv('PUSHER_APP_SECRET');
        $app_id = getenv('PUSHER_APP_ID');

        if ($user) {
            $pusher = new Pusher($key, $secret, $app_id);
            $auth= $pusher->socket_auth($request['channel_name'], $request['socket_id']); 
            $callback = str_replace('\\', '', $request['callback']);
            header('Content-Type: application/javascript');
            echo($callback . '(' . $auth . ');');
            return;
            // $pusher->socket_auth($request['channel_name'], $request['socket_id']); 
            // $string_to_sign = $socket_id.':'.$channel_name;
            // $signature = hash_hmac('sha256', $string_to_sign, $secret);
            // return response()->json(['auth' => $key.':'.$signature]);
        }else {
            header('', true, 403);
            echo "Forbidden";
            return;
        }
    }
}
