@php
  $t = $t ?? 'text'; // type of input
  $d = $d ?? null; // default value
  $p = $p ?? 'Enter ' . $l; // placeholder text
  $r = $r ?? false; // is required or not
  $a = $a ?? false; // is autofocused or not
@endphp

<div class="form-group row">
  <label for="{{ $n }}" class="col-sm-4 col-form-label text-md-right"><b>{{ $l }}</b></label>
  <div class="col-md-8">
    <input id="{{ $n }}" type="{{ $t }}" class="form-control" name="{{ $n }}" value="{{ old($n, $d) }}"
           placeholder="{{ $p }}" @if($r) required @endif @if($a) autofocus @endif>
    @if ($errors->has($n))
      <small class="text-danger">{{ $errors->first($n) }}</small>
    @endif
  </div>
</div>
