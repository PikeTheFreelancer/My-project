<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Merchandise;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Illuminate\Support\Facades\Config;

class MarketController extends Controller
{
    public function index()
    {
        $merchandises = DB::table('merchandises')
                        ->join('users', 'merchandises.user_id', '=', 'users.id')
                        ->select('merchandises.*', 'users.avatar', 'users.name as username')->get();
        foreach ($merchandises as $merchandise) {
            $comments = Comment::where('merchandise_id', $merchandise->id)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.avatar', 'users.name as username')                  
            ->get();
            $merchandise->comments = $comments;
        }

        return view('market', ['merchandises' => $merchandises]);
    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment;
        
        $comment->comment = $request->input('comment');
        $comment->merchandise_id = $request->input('merchandise_id');
        $comment->user_id = $user_id;

        $comment->save();

        //pass data to ajax
        $comment->user_avatar = asset($user->avatar);
        $comment->username = $user->name;

        return response()->json($comment);
    }

    public function sendNotification(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $request['noti_from'] = $user->name;

        $recipant =  Merchandise::find($request->input('merchandise_id'))->user;
        $request['noti_to'] = $recipant->id;
        if ($user_id == $request['noti_to']) {
            return response()->json('no noti sent');
        } else {
            $data = $request->only([
                'comment', 'noti_from', 'noti_to'
            ]);
    
            // save recipant id to notifiable_id column
            $recipant->notify(new CommentNotification($data));
    
            // pass notifiation id to view for unread function
            $notification_id = DB::table('notifications')->orderBy('created_at', 'desc')->first()->id;
            $data['id'] = $notification_id;
    
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
    
            // do not use env() other than config files, use Config::get() instead
            $pusher = new Pusher(
                Config::get('broadcasting.connections.pusher.key'),
                Config::get('broadcasting.connections.pusher.secret'),
                Config::get('broadcasting.connections.pusher.app_id'),
                $options
            );
    
            // $request['noti_to'] is the chanel which passed to script to sent to a specific user
            $pusher->trigger('CommentNotificationEvent', $recipant->id , $data);
    
            return response()->json('noti sent');
        }
    }

    public function markAsRead(Request $request)
    {
        $noti_id = $request->input('noti_id');
        $notification = auth()->user()->unreadNotifications->where('id', $noti_id)->first();
        if($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read']);
        }else{
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }
}
