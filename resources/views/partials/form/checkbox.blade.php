@php
  $d = $d ?? null; // default value
@endphp

<div class="form-group row">
  <label for="{{ $n }}" class="col-sm-4 col-form-label text-md-right"><b>{{ $l }}</b></label>
  <div class="col-md-8">
    <input id="{{ $n }}" type="checkbox" class="form-control" name="{{ $n }}" value="1"
           @if(old($n, $d) == '1') checked @endif>
    @if ($errors->has($n))
      <small class="text-danger">{{ $errors->first($n) }}</small>
    @endif
  </div>
</div>
