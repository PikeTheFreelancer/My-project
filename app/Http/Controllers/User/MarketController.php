<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class MarketController extends Controller
{
    protected $marketRepo, $userRepo, $commentRepo, $merchandiseRepo, $notiRepo;

    public function __construct(
        MarketRepositoryInterface $marketRepo,
        UserRepositoryInterface $userRepo,
        CommentRepositoryInterface $commentRepo,
        MerchandiseRepositoryInterface $merchandiseRepo,
        NotificationRepositoryInterface $notiRepo
    )
    {
        $this->marketRepo = $marketRepo;
        $this->userRepo = $userRepo;
        $this->commentRepo = $commentRepo;
        $this->merchandiseRepo = $merchandiseRepo;
        $this->notiRepo = $notiRepo;
    }

    public function index()
    {
        $merchandises = $this->marketRepo->getAllMerchandises();
        foreach ($merchandises as $merchandise) {
            $comments = $this->marketRepo->getAllComments($merchandise->id)->take(3)->reverse();
            $merchandise->comments = $comments;
            $merchandise->max_size = $this->marketRepo->getAllComments($merchandise->id)->count();
        }
        return view('market', ['merchandises' => $merchandises]);
    }

    public function merchandise($id)
    {
        $merchandise = $this->marketRepo->getOnemerchandise($id);
        $comments = $this->marketRepo->getAllComments($merchandise->id)->take(3)->reverse();
        $merchandise->comments = $comments;
        $merchandise->max_size = $this->marketRepo->getAllComments($merchandise->id)->count();
        
        return view('merchandise', ['merchandise' => $merchandise]);
    }

    public function sendNotification(Request $request)
    {
        if ($request->input('merchandise_id')) {
            $this->notiRepo->notiFromMerchandise($request);
        } else {
            $this->notiRepo->notiFromNewsfeed($request);
        }
        
        return response()->json('noti sent');
    }

    public function markAsReadNoti(Request $request)
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

    public function loadPrevComments(Request $request)
    {
        $amount = $request->input('amount');
        $merchandise_id = $request->input('merchandise_id');
        $user_id = $this->merchandiseRepo->find($merchandise_id)->user->id;
        $max_amount = $this->marketRepo->getAllComments($merchandise_id)->count();
        $comments = $this->marketRepo->getSomeComments($merchandise_id, $amount);

        return view('user.components.comments-list', compact('comments', 'user_id', 'max_amount'));
    }
}
