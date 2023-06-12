@extends('admin.layouts.master')
@section('title')
    Mentors
@stop
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item">Mentors</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-circle'></i> Mentors
        </h1>
    </div>
@stop

@push('footer')
    <script type="text/javascript">
        $(document).ready(function () {
            var userDataTable = $('#mentors').dataTable({
                responsive: true,
                dom:
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        titleAttr: 'Generate CSV',
                        className: 'btn-outline-default'
                    },
                    {
                        extend: 'print',
                        text: 'Print Members',
                        titleAttr: 'Print Table',
                        className: 'btn-outline-default'
                    }

                ]
            });
            // Deleting for one manufacturer
            $('#members tbody').on('click', '.data-controls a.data-delete', function () {
                var thisRow = $(this).parents('tr[role=row]');
                var thisChild = thisRow.hasClass('parent') ? thisRow.next('tr.child') : false;
                var id = thisRow.attr('index');
                if (window.confirm('Do you really want to delete this record?')) {
                    $.ajax({
                        'url': $(this).attr('href'),
                        'type': 'POST',
                        'data': {'_method': 'DELETE'},
                        'async': true,
                        'dataType': 'json',
                    }).done(function (data, statusText, xhr) {
                        if (data.status === 200) {
                            userDataTable.row(thisRow).remove().draw(false);
                            if (thisChild) {
                                thisChild.remove();
                            }
                            $.jGrowl(data.msg, {theme: 'bg-success', position: 'bottom-right'});
                        } else {
                            $.jGrowl(data.msg, {theme: 'bg-danger', position: 'bottom-right'});
                        }
                    }).fail(function (data) {
                        $.jGrowl('Quy trình xóa dữ liệu gặp sự cố (mã ' + data.status + '), vui lòng quay lại sau', {
                            theme: 'bg-danger',
                            position: 'bottom-right'
                        });
                    });
                }
                return false;
            });
        });
    </script>
@endpush
@section('content')
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>All Mentor</h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <table id="mentors" class="table table-bordered table-hover table-striped w-100">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">ID</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th style="width: 110px;">Trạng thái</th>
                        <th style="">Ứng tuyển</th>
                        <th class="text-left" style="width: 110px;">Đăng ký lúc</th>
                        <th class="text-left" style="width:60px">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mentors as $item)
                        <tr index="{!! $item->id !!}">
                            <td class="text-center">{!! $item->id !!}</td>
                            <td>{!! $item->display_name !!}</td>
                            <td>{!! $item->email !!}</td>
                            <td>{!! $item->phone ? $item->phone : 'N/A' !!}</td>
                            <td>{!! $item->confirmed_at ? 'Đã kích hoạt' : 'Chưa kích hoạt' !!}</td>
                            <td>
                                @if($item->reference)
                                    <a href="">
                                        <span class="badge badge-success badge-pill">Đang ứng tuyển</span>
                                    </a>
                                @else
                                    <span class="badge badge-secondary badge-pill">Chưa ứng tuyển</span>
                                @endif
                            </td>
                            <td>{!! date_from_database($item->created_at) !!}</td>
                            <td class="data-controls text-center">
                                @if($item->reference)
                                    <a href="{!! route('mentors.show',$item->id)!!}"
                                    class="data-edit btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                    title="Edit">
                                        <i class="fal fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
