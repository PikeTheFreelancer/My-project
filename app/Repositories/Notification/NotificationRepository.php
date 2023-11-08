<?php

namespace App\Repositories\Notification;

use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentNotification;
use App\Repositories\Post\PostRepositoryInterface;
use Pusher\Pusher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class NotificationRepository implements NotificationRepositoryInterface{

    protected $merchandiseRepo, $commentRepo, $userRepo, $postRepo;

    public function __construct(
        MerchandiseRepositoryInterface $merchandiseRepo,
        CommentRepositoryInterface $commentRepo,
        UserRepositoryInterface $userRepo,
        PostRepositoryInterface $postRepo
    )
    {
        $this->merchandiseRepo = $merchandiseRepo;
        $this->commentRepo = $commentRepo;
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    function notiFromMerchandise($request)
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
                
                $data['merchandise_id'] = $request->input('merchandise_id');
                
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
    }

    function notiFromNewsfeed($request)
    {
        $user_id = Auth::user()->id;
        // commenter
        $user = $this->userRepo->find($user_id);
        $request['noti_from'] = $user->name;

        $author = $this->postRepo->find($request->input('post_id'))->user;

        $recipant_ids = $this->commentRepo->compareEqual('post_id', $request->input('post_id'))
        ->distinct()
        ->pluck('user_id');

        $recipant_ids[] = $author->id;
        $recipant_ids = $recipant_ids->unique();

        foreach ($recipant_ids as $recipant_id) {

            $recipant = $this->userRepo->find($recipant_id);

            $request['noti_to'] = $recipant_id;
            $request['title'] = '';

            if ($author->id == $recipant_id) {
                $request['title'] = $request['noti_from'].' has commented on your post:';
            } else {
                $request['title'] = $request['noti_from'].' has replied on their post:';
            }
            

            if ($user_id != $request['noti_to']) {
            
                $data = $request->only([
                    'comment', 'noti_from', 'noti_to', 'title', 'comment_id'
                ]);
                
                $data['post_id'] = $request->input('post_id');
                
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
    }
}