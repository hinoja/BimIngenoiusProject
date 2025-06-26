@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __('you do not have permission to access this page.'))
