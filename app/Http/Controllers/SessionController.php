<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Notifications\SessionNotification;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use OpenTok\OpenTok;
use OpenTok\Role;
use Yajra\DataTables\Facades\DataTables;

class SessionController extends Controller
{

    public $openTok;

    public function __construct(OpenTok $openTok)
    {

        $this->openTok = $openTok;

    } //end of __construct function

    public function index()
    {


        return view('sessions.index');

    } //end of index function

    public function data()
    {
        $sessions = auth()->user()->sessions;


        return DataTables::of($sessions)
            ->addColumn('actions', function ($row) {
                return view('sessions.actions',compact('row'));
            })
            ->rawColumns(['actions' => 'actions'])
            ->make(true);


    } //end of data function

    public function create()
    {

        return view('sessions.create');

    } //end of create function

    public function store(SessionRequest $request)
    {

        try {
            $session = $this->openTok->createSession();
            $session_id = $session->getSessionId();
            $data = $request->validated();
            $data['session_id'] = $session_id;
            $data['publisher_id'] = auth()->user()->id;
            Session::create($data);
            session()->flash('success', 'session has been created successfully');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error',$e->getMessage());
            return  redirect()->back();
        }



    } //end of store function


    public function joinSession($session_id)
    {
        $session = Session::find($session_id);
        $sessionID = $session->session_id;
        $user_info = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];
        $options = [
            'role' => $session->publisher_id == auth()->id() ? Role::MODERATOR : Role::SUBSCRIBER,
            'expireTime' => time() + (120), // in one minute
            'data' => json_encode($user_info),
            'initialLayoutClassList' => array('focus')
        ];
        $token = $this->openTok->generateToken($session->session_id, $options);


        if ($session->publisher_id == auth()->id()) {
            $publisher = auth()->user();
            $users = User::where('id', '!=', $session->publisher_id)->get();
            Notification::send($users, new SessionNotification($session, $publisher));
        } else {
            $notification = auth()->user()->unreadNotifications->where('id', \request()->notification_id)->first();
            if ($notification){
                $notification->markAsRead();
            }

        }
        return view('sessions.live_room', compact('token', 'sessionID'));


    } //end of joinSession function


}
