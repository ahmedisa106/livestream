<form method="post" action="{{route('joinSession', $row->id) }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-video-camera"></i></button>
</form>
