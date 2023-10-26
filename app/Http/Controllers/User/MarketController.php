<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Notifications\CommentNotification;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Illuminate\Support\Facades\Config;
use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class MarketController extends Controller
{
    protected $marketRepo, $userRepo, $commentRepo, $merchandiseRepo;

    public function __construct(
        MarketRepositoryInterface $marketRepo,
        UserRepositoryInterface $userRepo,
        CommentRepositoryInterface $commentRepo,
        MerchandiseRepositoryInterface $merchandiseRepo
    )
    {
        $this->marketRepo = $marketRepo;
        $this->userRepo = $userRepo;
        $this->commentRepo = $commentRepo;
        $this->merchandiseRepo = $merchandiseRepo;
    }

    public function index()
    {
        $merchandises = $this->marketRepo->getAllMerchandises();
        foreach ($merchandises as $merchandise) {
            $comments = $this->marketRepo->getAllComments($merchandise->id);
            $merchandise->comments = $comments;
        }

        return view('market', ['merchandises' => $merchandises]);
    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment();
        
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
        
        // commenter
        $user = $this->userRepo->find($user_id);
        $request['noti_from'] = $user->name;

        $merchandise_owner = $this->merchandiseRepo->find($request->input('merchandise_id'))->user;

        $recipant_ids = $this->commentRepo->compareEqual('merchandise_id', $request->input('merchandise_id'))
        ->distinct()
        ->pluck('user_id');

        $recipant_ids[] = $merchandise_owner->id;
        $recipant_ids = $recipant_ids->unique();

        foreach ($recipant_ids as $recipant_id) {

            $recipant = $this->userRepo->find($recipant_id);

            $request['noti_to'] = $recipant_id;
            $request['title'] = '';

            if ($merchandise_owner->id == $recipant_id) {
                $request['title'] = $request['noti_from'].' has commented on your merchandise:';
            } else {
                $request['title'] = $request['noti_from'].' has replied on their merchandise:';
            }
            

            if ($user_id != $request['noti_to']) {
            
                $data = $request->only([
                    'comment', 'noti_from', 'noti_to', 'title', 'comment_id'
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
                $pusher->trigger('CommentNotificationEvent', $recipant_id , $data);
            }
        }

        return response()->json('noti sent');
    }

    public function markAsRead(Request $request)
    {
        $noti_id = $request->input('noti_id');
        $notification = auth()->user()->unreadNotifications->where('id', $noti_id)->first();
        if($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read']);
        }else{
            return response()->json(['error' => 'Notification not found']);
        }
    }
}
