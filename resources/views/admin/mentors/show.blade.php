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
        <li class="breadcrumb-item">
            <a href="{!! route('mentors.index') !!}">mentors</a>
        </li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> ĐƠN ỨNG TUYỂN
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <a href="{!! route('mentors.index') !!}" class="btn btn-sm btn-default
            waves-effect">Quay lại</a>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-trash-alt"></i></span>
                </button>
                <strong>Oh!</strong> {!! $error !!}
            </div>
        @endforeach
    @endif
    {!! Form::model($mentor_information,[
        'id'     => 'mentor',
        'method' => 'get',
        'route'  => 'mentors.create'
    ]) !!}
    

    <div id="panel-5" class="panel">
        <div class="panel-hdr">
            <h2>Chi tiết</h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Fullscreen"></button>

            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                {{--<div class="panel-tag">
                    Adding a hover effect adds nice element to your accordion. Achieve this by adding class <code>.accordion-hover</code>
                    to <code>.accordion</code>
                </div>--}}
                @if($mentor_information)
                    <div class="accordion accordion-hover" id="mentor_information">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5a" aria-expanded="true">
                                    A. Thông tin cá nhân và công việc hiện tại
                                    <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                                </a>
                            </div>
                            <div id="information-5a" class="collapse show" data-parent="#mentor_information">
                                <div class="card-body">
                                    <h4 class="fw-500">Thông tin cá nhân</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Họ và tên đệm</th>
                                                <th>Tên</th>
                                                <!-- <th>Ngày sinh</th> -->
                                                <th>Email</th>
                                                <th>SDT</th>
                                                <th>Giới tính</th>
                                                @if($mentor_information->gender==3)
                                                <th>Khác về giới tính</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> {!! $mentor_information->first_name !!} </td>
                                                <td> {!! $mentor_information->last_name !!} </td>
                                                <td> {!! $mentor_information->email !!} </td>
                                                <td> {!! $mentor_information->phone !!} </td>
                                                @if($mentor_information->gender==1)
                                                    <td>Nam</td>
                                                @elseif($mentor_information->gender==2)
                                                    <td>Nữ</td>
                                                @else
                                                    <td>Khác</td>
                                                    <td> {!! $mentor_information->gender_description !!} </td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Anh/chị đang sống</th>
                                                <th>Tỉnh/Thành phố</th>
                                                <th>Ngành học mà anh/chị theo học</th>
                                                <th>Cấp học cao nhất mà anh/chị đã học</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! $mentor_information->address !!}</td>
                                                <td>{!! $mentor_information->province->name !!}</td>
                                                <td>{!! $mentor_information->majors !!}</td>
                                                <td>{!! $mentor_information->school_level !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                <h4 class="fw-500">Công việc hiện tại</h4>
                                    <ol class="mb-g">
                                        <label>Anh/chị đã có bao nhiêu năm làm việc? (Chỉ tính các kinh nghiệm làm các công việc full- time)
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->work_experience !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Anh/chị đang làm việc trong lĩnh vực nào? (có thể có nhiều hơn 1 lĩnh vực)
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->work_field !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Tên công ty/tổ chức mà anh/chị đang làm việc
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->company_name !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Vị trí công việc mà anh/chị đang đảm nhận
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->position !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5b" aria-expanded="false">
                                    B. Kinh nghiệm và kỳ vọng khi trở thành Mentor
                                    <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                                </a>
                            </div>
                            <div id="information-5b" class="collapse" data-parent="#mentor_information">
                               
                                <div class="card-body">
                                <h4 class="fw-500"></h4>
                                    <ol class="mb-g">
                                        <label>Anh/chị đã từng là Mentor của VietSeeds chưa:
                                        </label>
                                            
                                        @if($mentor_information->member == true)
                                            <div class="frame-wrap">
                                                 <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Rồi</label>
                                                </div>
                                                <br>
                                                <br>
                                                <label>Nếu RỒI, đó là khoảng thời gian nào và trong bao lâu? Vì sao anh chị lại ngừng việc làm mentor tại thời điểm đó
                                                </label>
                                                <div class="alert alert-primary">
                                                    <div class="d-flex flex-start w-100">
                                                        <div class="d-flex flex-fill">
                                                            <div class="flex-fill">
                                                            {!! $mentor_information->member_time !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="frame-wrap">
                                                 <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Chưa</label>
                                                </div>
                                            </div>
                                        @endif
                                        <label>Anh/chị đã từng có kinh nghiệm làm Mentor trước đó chưa
                                        </label>
                                        @if($mentor_information->experience == true)
                                            <div class="frame-wrap">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Có</label>
                                                </div>
                                                <br>
                                                <br>
                                                <label>Nếu có, trong bao lâu
                                                </label>
                                                <div class="alert alert-primary">
                                                    <div class="d-flex flex-start w-100">
                                                        <div class="d-flex flex-fill">
                                                            <div class="flex-fill">
                                                            {!! $mentor_information->experience_time !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="frame-wrap">
                                                 <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Chưa</label>
                                                </div>
                                            </div>
                                        @endif
                                        <label>Anh/chị đã bao giờ có mentor chưa
                                        </label>
                                        @if($mentor_information->mentor == true)
                                            <div class="frame-wrap">
                                                 <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Có</label>
                                                </div>
                                                <br>
                                                <br>
                                                <label>Nếu có, anh/chị có thể chia sẻ ngắn gọn về mối quan hệ này không
                                                </label>
                                                <div class="alert alert-primary">
                                                    <div class="d-flex flex-start w-100">
                                                        <div class="d-flex flex-fill">
                                                            <div class="flex-fill">
                                                            {!! $mentor_information->mentor_relative !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="frame-wrap">
                                                 <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" checked="" disabled="">
                                                    <label class="custom-control-label" >Chưa</label>
                                                </div>
                                            </div>
                                        @endif
                                        <label>Mỗi Mentor khi đăng ký trở thành Mentor của VietSeeds yêu cầu cần phải dành ít nhất mỗi tháng 1 tiếng đồng hồ gặp mặt trực tiếp với Mentee của mình 
                                            (hoặc có cuộc gọi video đối với trường hợp Mentor không ở cùng thành phố với Mentee). Anh/chị có thể thực hiện cam kết này được không
                                        </label>
                                        <div class="frame-wrap">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" checked="" disabled="">
                                                @if($mentor_information->commit_mentor==true)
                                                <label class="custom-control-label" >Có</label>
                                                @else
                                                <label class="custom-control-label" >Không</label>
                                                @endif
                                            </div>
                                        </div>
                                        <label>Anh/chị có khả năng duy trì mối quan hệ Mentoring với Mentee của mình trong thời gian (ít nhất) 12 tháng liên tục không
                                        </label>
                                        <div class="frame-wrap">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" checked="" disabled="">
                                                @if($mentor_information->year_mentor==true)
                                                <label class="custom-control-label" >Có thể</label>
                                                @else
                                                <label class="custom-control-label" >Không thể</label>
                                                @endif
                                            </div>
                                        </div>
                                        <label>Tại sao anh/chị lại muốn tham gia chương trình Mentoring của VietSeeds
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->join_mentor !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Anh/chị muốn được kết nối với bao nhiêu sinh viên (mentee) của VietSeeds
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->connect_mentor !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Anh/chị mong muốn ghép đôi với sinh viên năm nhất hay sinh viên từ năm 2 trở lên
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    @if($mentor_information->student_mentor ==1)
                                                        Năm nhất
                                                    @elseif($mentor_information->student_mentor ==2)
                                                        Năm hai trở lên
                                                    @else
                                                        Cả 2 đều được
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Anh/chị có yêu cầu hoặc mong đợi gì đặc biệt đối với mentee của mình không
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->request_mentor !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Anh/chị biết đến chương trình Mentoring của VietSeeds như thế nào
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->know_program !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Những mong đợi/góp ý của anh/chị đối với chương trình Mentoring của VietSeeds là
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->idea !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5c" aria-expanded="false">
                                    C. Giới thiệu về bản thân
                                    <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                                </a>
                            </div>
                            <div id="information-5c" class="collapse" data-parent="#mentor_information">
                            <div class="card-body">
                                    <ol class="mb-g">
                                        <label>Vui lòng viết 1 phần giới thiệu bản thân (không quá 700 từ) để giới thiệu với các mentee tương lai của anh/chị. 
                                            Phần giới thiệu của anh/chị có thể chia sẻ anh/chị là ai? Nơi công tác hoặc sở thích và những mối quan tâm của anh/chị. 
                                            Anh/chị mong muốn mối quan hệ với mentee sẽ diễn ra như thế nào. Những chia sẻ này sẽ được gửi đến tất cả các bạn sinh viên của VietSeeds 
                                            để tìm hiểu và kết nối mentee phù hợp nhất với anh/chị.
                                        </label>
                                        <div class="alert alert-primary">
                                            <div class="d-flex flex-start w-100">
                                                <div class="d-flex flex-fill">
                                                    <div class="flex-fill">
                                                    {!! $mentor_information->introduce !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @else

                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
