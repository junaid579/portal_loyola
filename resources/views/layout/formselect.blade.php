<div class="form-group">
    <label class="col-md-3 control-label">{{ $ft }}</label>
    <div class="col-md-4">
        <select id="{{ $fin }}" name="{{ $fin }}" class="form-control input-large">
            @foreach($data as $val)
                <option value="{{ $val->$index }}">{{ $val->$value }}</option>
            @endforeach
        </select>
    </div>
</div>