@extends('layouts.master')

<style>
    #videos {
        position: relative;
        width: 50%;
        height: 70%;
        top: 50px;
        /*margin-left: auto;*/
        /*margin-right: auto;*/
    }

    #subscriber {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }

    #publisher {
        position: absolute;
        width: 100%;
        height: 100%;
        bottom: 10px;
        left: 10px;
        z-index: 99;
        border: 3px solid white;
        border-radius: 3px;
    }
</style>

@section('content')

    <div id="alert_user_join" class="alert d-none alert-success text-center ">
    </div>

    <div class="pull-left">
        Session Members count : <b><span id="session_members"></span></b>
    </div>


    <div id="videos" class="pull-left">
        <div id="subscriber"></div>
        <div id="publisher"></div>
    </div>

    <div class="row " style="margin-top: 20px;margin-bottom: 400px">
        <div class="col-md-12 ">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-lg-12">
                            <div class="scrollbar max-h-600">
                                <a href="#" id="disconnect" class="btn btn-sm btn-danger">leave Session</a>

                                <div class="chats">
                                    <div class="chat-wrapper chat_box clearfix">
                                        {{--                                        <div class="chat-avatar">--}}
                                        {{--                                            <b>Ahemd</b>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="chat-body bg-light p-3">--}}
                                        {{--                                            <p>They have no clarity. When asked the question, responses will be superficial at best, and at worst.</p>--}}
                                        {{--                                        </div>--}}
                                    </div>


                                </div>
                            </div>
                            <div class="chats mt-30">
                                <div class="chat-wrapper mb-0 clearfix">
                                    <div class="chat-input">
                                        <div class="chat-input-icon">
                                            <a class="text-muted" href="#"> <i class="fa fa-smile-o"></i> </a>
                                        </div>
                                        <textarea class="form-control input-message scrollbar" placeholder="Type here...*" rows="2" name="message"></textarea>
                                    </div>
                                    <div class="chat-button">
                                        <a id="sendMessage" href="#"> <i class="fa fa-send"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('javascript')
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>

    <script>
        // replace these values with those generated in your TokBox Account
        var apiKey = "{!! config('opentok.api_key') !!}";
        var sessionId = "{!! $sessionID !!}";
        var token = "{!! $token !!}";

        // Handling all of our errors here by alerting them
        function handleError(error) {
            if (error) {
                alert(error.message);
            }
        }

        // (optional) add server code here
        initializeSession();


        function initializeSession() {
            var session = OT.initSession(apiKey, sessionId);
            recievedMessages(session)

            $('#sendMessage').on('click', function (e) {
                e.preventDefault();

                sendMessage(session)
            })
            // Subscribe to a newly created stream
            session.on('streamCreated', function (event) {

                session.subscribe(event.stream, 'subscriber', {
                    insertMode: 'append',
                    width: '100%',
                    height: '100%'
                }, handleError);
            });

            $('#disconnect').on('click', function () {

                disconnect(session)
            })

            // Connect to the session
            session.connect(token, function (error) {
                // If the connection is successful, initialize a publisher and publish to the session
                if (error) {
                    handleError(error);
                } else {
                    if (session.capabilities.publish) {
                        // Create a publisher
                        var publisher = OT.initPublisher('publisher', {
                            insertMode: 'append',
                            width: '100%',
                            height: '100%'
                        }, handleError);
                        session.publish(publisher, handleError);
                    }

                }
            });

            var connectionCount = 0;
            session.on("connectionCreated", function (event) {
                if (session.capabilities.publish) {
                    toastr['success'](JSON.parse(event.connection.data).name + ' Joined live')
                }
                connectionCount++;
                displayConnectionCount();
            });
            session.on("connectionDestroyed", function (event) {



                if (event.connection.permissions.publish) {
                    toastr['error'](JSON.parse(event.connection.data).name + ' has left');
                    disconnect(session)
                }
                toastr['error'](JSON.parse(event.connection.data).name + ' has left');
                connectionCount--;
                displayConnectionCount();
            });

            function displayConnectionCount() {

                $('#session_members').html(connectionCount.toString())

            }


        }

        function sendMessage(session) {

            session.signal(
                {
                    data: $('.input-message').val(),
                },
                function (error) {
                    if (error) {
                        console.log("signal error ("
                            + error.name
                            + "): " + error.message);
                    } else {

                        console.log("signal sent. ");
                    }
                }
            );
        }

        function recievedMessages(session) {

            session.on("signal", function (event) {

                let _class = '';
                let html = '';
                if (event.from.id == session.connection.id) {
                    _class = 'chat-me';
                    html = `<br> <div class="chat-wrapper ${_class}  clearfix">
                    <div class="chat-body p-3">
                        <p>${event.data}</p>
                    </div>
                </div>`;
                } else {
                    html = `<br> <div class="chat-avatar">
                             <b>${JSON.parse(event.from.data).name}</b>
                               </div>
                              <div class="chat-body bg-light p-3">
                               <p>${event.data}</p>
                             </div>`;
                }


                $('.chat_box').append(html)
                $('.input-message').val('')
            });

        }

        function disconnect(session) {


            toastr['success']('successsss', 'success')


            session.disconnect()

            window.location.href = '{!! url('/sessions') !!}'
        }

    </script>
@endpush
