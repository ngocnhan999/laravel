@extends('admin.layouts.master')

@section('title')
    Activities Logs
@stop

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item active">Activities Logs</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Activities Logs
        </h1>
    </div>
@stop

@section('content')
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>All Activities Logs</h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <table id="users" class="table table-bordered table-hover table-striped w-100">
                    <thead class="text-uppercase">
                    <tr>
                        <th class="text-center" style="width: 20px;">ID</th>
                        <th>Action</th>
                        <th>User Agent</th>
                        <th class="text-center" style="width:60px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($histories as $history)
                        <tr index="{!! $history->id !!}">
                            <td class="text-center">{!! $history->id !!}</td>
                            <td>
                                <span class="log-icon log-icon-{{ $history->type }}"></span>
                                <span>
                                    @if ($history->user->id)
                                        <a href="">{{ $history->user->getFullName() }}</a>
                                    @endif
                                    @if (Lang::has('plugins/audit-log::history.' . $history->action))
                                        {{ trans('audit-log .history.' . $history->action) }}
                                    @else
                                        {{ $history->action }}
                                    @endif
                                    @if ($history->module)
                                        @if (Lang::has('plugins/audit-log::history.' . $history->module)) {{ trans('plugins/audit-log::history.' . $history->module) }} @else {{ $history->module }} @endif
                                    @endif
                                    @if ($history->reference_name)
                                        @if (empty($history->user) || $history->user->getFullName() != $history->reference_name)
                                            "{{ Str::limit($history->reference_name, 40) }}"
                                        @endif
                                    @endif
                                 </span>
                                <span
                                    class="small italic">{{ Carbon\Carbon::parse($history->created_at)->diffForHumans() }} </span>
                                <span>(<a href="https://whatismyipaddress.com/ip/{{ $history->ip_address }}"
                                          target="_blank"
                                          title="{{ $history->ip_address }}">{{ $history->ip_address }}</a>)</span>
                            </td>
                            <td>
                                {!! $history->user_agent !!}
                            </td>
                            <td class="data-controls text-center">
                                <a href="{!! route('audit-log.destroy',$history->id)!!}"
                                   data-token="{!! csrf_token()!!}"
                                   class="data-delete btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                   title="Delete">
                                    <i class="fal fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
