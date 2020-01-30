@extends('adminlte::page')

@section('title', 'Log Viewer')

@section('content_header')
  Logs
@stop

@section('content')
  {{-- A way to change the Log file date --}}
  <style>
    textarea {
      outline: none;
      overflow: auto;
    }
  </style>

  <form action="{{ route('logs') }}" method="get" style="padding-bottom: 25px">
    <label>
      <input autofocus name="date" type="date" value="{{ $date ? $date->format('Y-m-d') : today()->format('Y-m-d') }}">
    </label>
    <button type="submit">Get</button>
  </form>

  @empty($data['file'])
    <div>
      <h3>No logs found.</h3>
    </div>
  @else
    <div>
      <h5>Updated on: <b>{{ $data['lastModified']->format('Y-m-d h:i a') }}</b></h5>
      <h5>File size: <b>{{ round($data['size'] / 1024) }} KB</b></h5>
      <hr>
      <label>
        <textarea cols="230" rows="30">{{ $data['file'] }}</textarea>
      </label>
    </div>
  @endempty
@stop
