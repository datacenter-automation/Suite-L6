{{--@extends('errors::minimal')--}}
@extends('errors.illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))


{{--@extends('errors.illustrated-layout')--}}

{{--@section('title', __('Server Error'))--}}
{{--@section('code', '500')--}}
{{--@section('message', 'Whoops, looks like something went wrong.'.(isset($incidentCode) ? ' Please contact support with incident code: '.$incidentCode : ''))--}}
