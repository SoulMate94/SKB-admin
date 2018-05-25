<div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
        <label class="btn btn-default btn-sm {{ \Request::get('status', 'all') == $option ? 'active' : '' }}">
            <input type="radio" class="master-status" value="{{ $option }}">{{$label}}
        </label>
    @endforeach
</div>