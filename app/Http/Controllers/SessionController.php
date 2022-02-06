<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Session;
use Illuminate\Http\Request;
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
        $sessions = Session::get();


        return DataTables::of($sessions)
            ->addColumn('actions', function ($row) {
                return '

                <form method="post" action="' . route('joinSession', $row->id) . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-video-camera"></i></button>
                </form>

                ';
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
        $session = $this->openTok->createSession();
        $session_id = $session->getSessionId();
        $data = $request->validated();
        $data['session_id'] = $session_id;
        $data['publisher_id'] = auth()->user()->id;
        $session = Session::create($data);
        session()->flash('success', 'session has been created successfully');
        return redirect()->back();


    } //end of store function


    public function joinSession($session_id)
    {
        $session = Session::find($session_id);
        $sessionID = $session->session_id;
        $user_info = [
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
        ];


        $options = [
            'role' => $session->publisher_id == auth()->id() ? Role::MODERATOR : Role::SUBSCRIBER,
            'expireTime' => time() + (120), // in one minute
            'data' => json_encode($user_info),
            'initialLayoutClassList' => array('focus')
        ];
        $token = $this->openTok->generateToken($session->session_id, $options);

        return view('sessions.live_room', compact('token', 'sessionID'));


    } //end of joinSession function


}
