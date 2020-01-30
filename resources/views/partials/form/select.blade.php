@php
  $d = $d ?? null; // default value
  $r = $r ?? false; // is required or not
  $a = $a ?? false; // is autofocused or not
@endphp

<div class="form-group row">
  <label for="{{ $n }}" class="col-sm-4 col-form-label text-md-right"><b>{{ $l }}</b></label>
  <div class="col-md-8">
    <select id="{{ $n }}" class="form-control" name="{{ $n }}" @if($r) required @endif @if($a) autofocus @endif>
      <option value="">-- SELECT --</option>
      @foreach($i as $item)
        @if($item == old($n, $d))
          <option value="{{ $item }}" selected>{{ $item }}</option>
        @else
          <option value="{{ $item }}">{{ $item }}</option>
        @endif
      @endforeach
    </select>
    @if ($errors->has($n))
      <small class="text-danger">{{ $errors->first($n) }}</small>
    @endif
  </div>
</div>
