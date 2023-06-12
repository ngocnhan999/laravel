@extends('admin.layouts.master')
@section('title')
    Students
@stop

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('students.index') !!}">students</a>
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
            <a href="{!! route('students.index') !!}" class="btn btn-sm btn-default
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
    {!! Form::model($student_information,[
        'id'     => 'student',
        'method' => 'get',
        'route'  => 'students.create'
    ]) !!}
    @php
        $high_schools = "academic_info->high_school";
    @endphp

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
                @if($student_information)
                    <div class="accordion accordion-hover" id="student_information">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5a" aria-expanded="true">
                                    A. Thông tin cá nhân
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
                            <div id="information-5a" class="collapse show" data-parent="#student_information">
                                <div class="card-body">
                                    <h4 class="fw-500">Thông tin cá nhân</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Họ và tên đệm</th>
                                                <th>Tên</th>
                                                <th>Ngày sinh</th>
                                                <th>Email</th>
                                                <th>SDT</th>
                                                <th>Giới tính</th>
                                                <th>Dân tộc</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! $student_information->personal_info->first_name !!}</td>
                                                <td>{!! $student_information->personal_info->last_name !!}</td>
                                                <td>{!! $student_information->personal_info->dob !!}</td>
                                                <td>{!! $student->email !!}</td>
                                                <td>{!! $student_information->phone !!}</td>
                                                <!-- <td>{!! $student_information->gender !!}</td> -->
                                                @if($student_information->gender==1)
                                                    <td>Nam</td>
                                                @elseif($student_information->gender==2)
                                                    <td>Nữ</td>
                                                @else
                                                    <td>Khác</td>
                                                @endif
                                                <td>{!! $student_information->personal_info->ethnic !!}</td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <br>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Địa chỉ liên lạc</th>
                                                <!-- <th>Tỉnh/Thành phố</th> -->
                                                <th>Địa chỉ gia đình</th>
                                                <!-- <th>Tỉnh/Thành phố</th> -->
                                                <th>Facebook</th>
                                                <th>LinkedIn</th>
                                                <th>Sẽ học đại học tại</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! $student_information->personal_info->address->address_text . ', '.$address_province !!}</td>
                                                <!-- <td>{!! $student_information->personal_info->address->province_id !!}</td> -->
                                                <td>{!! $student_information->personal_info->address_house->address_text .', '.$address_house_province !!}</td>
                                                <!-- <td>{!! $student_information->personal_info->address_house->province_id !!}</td> -->
                                                <td>{!! $student_information->personal_info->facebook_url !!}</td>
                                                <td>{!! $student_information->linkedin !!}</td>
                                                @if($student_information->region==1)
                                                    <td>TP. Hồ Chí Minh</td>
                                                @elseif($student_information->region==2)
                                                    <td>Hà Nội</td>
                                                @else
                                                    <td>Thừa Thiên Huế</td>
                                                @endif
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <br>
                                    <h4 class="fw-500">Thông tin người thân</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Số điện thoại</th>
                                                <th>Họ và Tên</th>
                                                <th>Quan hệ với bạn</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student_information->personal_info->phone_number as $number)
                                                <tr>
                                                    <td>{!! $number->phone !!}</td>
                                                    <td>{!! $number->owner !!}</td>
                                                    <td>{!! $number->relationship !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5b" aria-expanded="false">
                                    B. Kết quả học tập
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
                            <div id="information-5b" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <h4 class="fw-500">Thông tin về Trường</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Tên trường THPT</th>
                                                <th>Địa chỉ trường</th>
                                                <th>Địa chỉ 2 nếu có</th>
                                                <th>Tỉnh/ Thành phố</th>
                                                <th>Điện thoại trường</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! $student_information->academic_info->high_school->name !!}</td>
                                                <td>{!! $student_information->academic_info->high_school->address_text !!}</td>
                                                <td>{!! $student_information->academic_info->high_school->address_second !!}</td>
                                                <td>{!! $high_school_province !!}</td>
                                                <td>{!! $student_information->academic_info->high_school->phone !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h4 class="fw-500">Kết quả học tập</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th></th>
                                                <th>Điểm TB HK1</th>
                                                <th>Điểm TB HK2</th>
                                                <th>Hạnh kiểm</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th class="bg-primary-100" scope="row">Lớp 11</th>
                                                <td>{!! $student_information->academic_info->high_school->class_11->grade_1st_sem !!}</td>
                                                <td>{!! $student_information->academic_info->high_school->class_11->grade_2nd_sem !!}</td>
                                                @if($student_information->academic_info->high_school->class_11->conduct_grade==2)
                                                    <td>Khá</td>
                                                @else
                                                    <td>Tốt</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-100" scope="row">Lớp 12</th>
                                                <td>{!! $student_information->academic_info->high_school->class_12->grade_1st_sem !!}</td>
                                                <td>{!! $student_information->academic_info->high_school->class_12->grade_2nd_sem !!}</td>
                                                @if($student_information->academic_info->high_school->class_12->conduct_grade==2)
                                                    <td>Khá</td>
                                                @else
                                                    <td>Tốt</td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h4 class="fw-500">Điểm thi tốt nghiệp THPT</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Tên Môn thi TN THPT</th>
                                                <th>Điểm thi (thang điểm 10)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student_information->academic_info->high_school->graduation_exam->scores as $score)
                                                <tr>
                                                    <td>{!! $score->subject !!}</td>
                                                    <td>{!! $score->score !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Giải thưởng</th>
                                                <th>Mô tả</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student_information->academic_info->high_school->achievements as $achievement)
                                                <tr>
                                                    <td>{!! $achievement->name !!}</td>
                                                    <td>{!! $achievement->description !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Tên trường</th>
                                                <th>Ngành</th>
                                                <th>Tổng điểm</th>
                                                <th>Đậu / Trượt?</th>
                                                <th>Dự định học</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student_information->academic_info->candidate_universities as $candidate)
                                                <tr>
                                                    <td>{!! $candidate->name !!}</td>
                                                    <td>{!! $candidate->major !!}</td>
                                                    <td>{!! $candidate->total_score !!}</td>
                                                    <td>{!! $candidate->is_accepted !!}</td>
                                                    <td>{!! $candidate->is_applying !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Giải thưởng</th>
                                                <th>Mô tả</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student_information->academic_info->high_school->achievements as $achievement)
                                                <tr>
                                                    <td>{!! $achievement->name !!}</td>
                                                    <td>{!! $achievement->description !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5c" aria-expanded="false">
                                    C. Kinh Nghiệm
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
                            <div id="information-5c" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <h4 class="fw-500">Kinh nghiệm làm việc</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Thời gian bắt đầu</th>
                                                <th>Vị trí</th>
                                                <th>Mô tả công việc(tối đa 50 từ mỗi công việc)</th>
                                                <th>Địa điểm</th>
                                                <th>Số giờ làm việc / tuần</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($student_information->experience_info->work_experiences)
                                                @foreach($student_information->experience_info->work_experiences as $experience)
                                                    <tr>
                                                        <td>{!! $experience->start_date !!}</td>
                                                        <td>{!! $experience->position !!}</td>
                                                        <td>{!! $experience->description !!}</td>
                                                        <td>{!! $experience->work_place !!}</td>
                                                        <td>{!! $experience->weekly_hours !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <h4 class="fw-500">Hoạt động ngoại khóa / Công việc tình nguyện: </h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Thời gian bắt đầu</th>
                                                <th>Hoạt động</th>
                                                <th>Mô tả công việc(tối đa 50 từ mỗi công việc)</th>
                                                <th>Vị trí</th>
                                                <th>Lý do tham gia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($student_information->experience_info->volunteer_experiences)
                                                @foreach($student_information->experience_info->volunteer_experiences as $volunteer)
                                                    <tr>
                                                        <td>{!! $volunteer->start_date !!}</td>
                                                        <td>{!! $volunteer->title !!}</td>
                                                        <td>{!! $volunteer->description !!}</td>
                                                        <td>{!! $volunteer->position !!}</td>
                                                        <td>{!! $volunteer->reason !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5d" aria-expanded="false">
                                    D. Thông tin tài chính
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
                            <div id="information-5d" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <h4 class="fw-500">Tổng thu nhập</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Tổng thu nhập hàng tháng của cả gia đình (VND)</th>
                                                <th>Tổng thu nhập hàng năm của cả gia đình (VND)</th>
                                                <th>Tiền chu cấp của bố mẹ (VND)</th>
                                                <th>Tiền chu cấp của họ hàng (VND)</th>
                                                <th>Các khoản khác (Vui lòng ghi rõ) (VND)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! $student_information->finance_info->family_income->monthly_income !!}</td>
                                                <td>{!! $student_information->finance_info->family_income->yearly_rank !!}</td>
                                                <td>{!! $student_information->finance_info->finance_supports->parents !!}</td>
                                                <td>{!! $student_information->finance_info->finance_supports->relatives !!}</td>
                                                <td>{!! $student_information->finance_info->finance_supports->other !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <h4 class="fw-500">Học bổng</h4>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Tên học bổng</th>
                                                <th>Trạng thái</th>
                                                <th>Số tiền tổng cộng trong 1 năm (VND)</th>
                                                <th>Số tiền đã nhận (VND)</th>
                                                <th>Số tiền còn lại sẽ nhận (VND)</th>
                                                <th>Ghi chú</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($student_information->finance_info->scholarships) && $student_information->finance_info->scholarships)
                                                @foreach($student_information->finance_info->scholarships as $scholarship)
                                                    <tr>
                                                        <td>{!! $scholarship->name !!}</td>
                                                        @if($scholarship->is_received==1)
                                                            <td>Đã nộp</td>
                                                        @elseif($scholarship->is_received==2)
                                                            <td>Đang nộp</td>
                                                        @else
                                                            <td>Đã nhận</td>
                                                        @endif
                                                        <td>{!! $scholarship->total_amount !!}</td>
                                                        <td>{!! $scholarship->received_amount !!}</td>
                                                        <td>{!! $scholarship->remaining_amount !!}</td>
                                                        <td>{!! $scholarship->note !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <h4 class="fw-500">Ngoài những thông tin em đã cung cấp, em muốn Ban xét duyệt học
                                        bổng
                                        biết thêm những
                                        thông tin gì khác về em?</h4>
                                    <div class="alert alert-primary">
                                        <div class="d-flex flex-start w-100">
                                            <div class="d-flex flex-fill">
                                                <div class="flex-fill">
                                                    {!! $student_information->finance_info->family_income->note !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5e" aria-expanded="false">
                                    E. Thông tin về các thành viên trong gia đình
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
                            <div id="information-5e" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered m-0">
                                            <thead class="bg-primary-100">
                                            <tr>
                                                <th>Họ tên</th>
                                                <th>Quan hệ với em</th>
                                                <th>Công việc (ghi là “đi học” nếu còn đang học hoặc ghi rõ vị trí làm
                                                    việc
                                                    nếu đã
                                                    đi làm)
                                                </th>
                                                <th>Tên trường(ghi rõ cấp học) hoặc tên cơ quan/công ty</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($student_information->family_members)
                                                @foreach($student_information->family_members as $member)
                                                    <tr>
                                                        <td>{!! $member->full_name !!}</td>
                                                        <td>{!! $member->relationship !!}</td>
                                                        <td>{!! $member->job !!}</td>
                                                        <td>{!! $member->work_place !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5f" aria-expanded="false">
                                    F. Chia sẻ về bản thân (Tối thiểu 100 từ mỗi câu )
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
                            <div id="information-5f" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <ol class="mb-g">
                                        @if($student_information->personalSharing)

                                            @foreach($student_information->personalSharing->sharing as $sharing)

                                                @if($sharing->question == 1)
                                                    <li>Nếu chọn 3 từ để nói về em, 3 từ đó là gì? Hãy giải thích rõ hơn
                                                        về
                                                        3 từ đó?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $sharing->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($sharing->question==2)
                                                    <li>Ước mơ của em sau khi ra trường là gì? Ngành học em đang chọn có
                                                        liên quan thế
                                                        nào đến ước mơ đó?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $sharing->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($sharing->question==3)
                                                    <li>Nếu em không đậu đại học thì sẽ làm gì?</li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $sharing->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($sharing->question==4)
                                                    <li>Với những gì em đã tìm hiểu về VietSeeds, em nghĩ mình có phải
                                                        là
                                                        một thành viên
                                                        phù hợp với VietSeeds không? Tại sao?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $sharing->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <li>Clip giới thiệu về bản thân và gia đình</li>
                                            <div class="alert alert-primary">
                                                <div class="d-flex flex-start w-100">
                                                    <div class="d-flex flex-fill">
                                                        <div class="flex-fill">
                                                            @if($student_information->personalSharing->clip)
                                                                <a href="{!! $student_information->personalSharing->clip !!}"
                                                                   target="_blank">Bấm vào đây để xem Clip</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5g" aria-expanded="false">
                                    G. Phần bài luận (Tối thiểu 150 từ mỗi câu)
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
                            <div id="information-5g" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <ol class="mb-g">
                                        @if($student_information->essays)
                                            @foreach($student_information->essays as $essay)
                                                @if($essay->question==1)
                                                    <li>Hãy chia sẻ về điểm mạnh và điểm yếu của bản thân em với những
                                                        ví dụ
                                                        cụ thể liên
                                                        quan đến các điểm mạnh và điểm yếu đó.
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $essay->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($essay->question==2)
                                                    <li>Suy nghĩ của em về “Multi - tasking” ?</li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $essay->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($essay->question==3)
                                                    <li>Hãy chia sẻ về giai đoạn khó khăn nhất trong cuộc sống của em và
                                                        làm
                                                        cách nào để
                                                        em vượt qua được giai đoạn đó.
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $essay->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($essay->question==4)
                                                    <li>Điều gì khiến em tự hào nhất về bản thân cho tới thời điểm
                                                        này?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $essay->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5h" aria-expanded="false">
                                    H. Hiểu về VietSeeds
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
                            <div id="information-5h" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <ol class="mb-g">
                                        @if($student_information->vietseeds_quiz)
                                            @foreach($student_information->vietseeds_quiz->quizzes as $vietseeds)
                                                @if($vietseeds->question == 1)
                                                    <li>Slogan và tên đúng của quỹ học bổng là gì? Theo suy nghĩ của em,
                                                        ý
                                                        nghĩa của
                                                        slogan và tên của tổ chức là gì?”
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==2)
                                                    <li>Em biết đến quỹ học bổng VietSeeds từ đâu? Vui lòng chia sẻ cụ
                                                        thể
                                                        về câu chuyện
                                                        từ đâu mà em biết đến VietSeeds
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==3)
                                                    <li>Giá trị cốt lõi của VietSeeds là gì? Em nghĩ em có phù hợp với
                                                        những
                                                        giá trị cốt
                                                        lõi của VietSeeds không?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==4)
                                                    <li>Co-founders của VietSeeds là ai?</li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==5)
                                                    <li>Em sẽ được hỗ trợ những gì nếu được nhận học bổng VietSeeds?
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==6)
                                                    <li>Nếu có điều gì chưa được nhắc đến trong hồ sơ mà bạn muốn Hội
                                                        Đồng
                                                        Tuyển Chọn
                                                        biết để cân nhắc hồ sơ của bạn, bạn vui lòng chia sẻ ở đây.
                                                        (Không
                                                        bắt buộc, nếu
                                                        không vui lòng nhập "Không")
                                                    </li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    {!! $vietseeds->answers !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($vietseeds->question==7)
                                                    <li>Em có anh/chị ruột nào đã nhận học bổng VietSeeds chưa?</li>
                                                    <div class="alert alert-primary">
                                                        <div class="d-flex flex-start w-100">
                                                            <div class="d-flex flex-fill">
                                                                <div class="flex-fill">
                                                                    @if($vietseeds->answers==1)
                                                                        Có
                                                                    @else
                                                                        Không
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                   data-target="#information-5i" aria-expanded="false">
                                    I. Phần hình ảnh
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
                            <div id="information-5i" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <ol class="mb-g">
                                        <div class="panel-content">
                                            <div class="card-deck">
                                                @if($student->image)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-responsive"
                                                            src="{!! asset('uploads/images/' . $student->image->image) !!}"/>
                                                    </div>
                                                    <div class="card-footer">
                                                        <small class="text-muted"><h5>Hình ảnh toàn cảnh căn nhà</h5></small>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($student->image_people)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-responsive"
                                                            src="{!! asset('uploads/images/' . $student->image_people->image) !!}"/>
                                                    </div>
                                                    <div class="card-footer">
                                                        <small class="text-muted"><h5>Hình của ứng viên</h5></small>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($student->image_family)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-responsive"
                                                            src="{!! asset('uploads/images/' . $student->image_family->image) !!}" title="{!! $student->image_family->image !!}"/>
                                                    </div>
                                                    <div class="card-footer">
                                                        <small class="text-muted"><h5>Hình của gia đình</h5></small>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="card-group">
                                            @if( $image_multiple = $student->image_multiple->count() > 0)
                                            @foreach($student->image_multiple as $multiple)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-responsive"
                                                            src="{!! asset('uploads/images/' . $multiple->image) !!}" title="{!! $multiple->image !!}"/>
                                                    </div>
                                                    <div class="card-footer">
                                                        <small class="text-muted"><h5>Hình ứng viên tham gia các hoạt động</h5></small>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
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
                                   data-target="#information-5j" aria-expanded="false">
                                    J. Thư giới thiệu
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
                            <div id="information-5j" class="collapse" data-parent="#student_information">
                                <div class="card-body">
                                    <ol class="mb-g">
                                    @if($student->file_letter)
                                    <div class="card">
                                        <object data="{!! asset('uploads/files/' . $student->file_letter->image) !!}" width="100%" height="500px"></object>   
                                        
                                        <div class="card-footer">   
                                            <small class="text-muted"><h5>Thư giới thiệu:{!! $student->file_letter->image !!}</h5></small>
                                        </div>
                                    </div>
                                    @endif
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
