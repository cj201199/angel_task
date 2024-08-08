@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}
                <div class="middle-content container-xxl p-0">
                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="#">App</a></li>
                                            <li class="breadcrumb-item"><a href="#">Blog</a></li> -->
                                {{-- <li class="breadcrumb-item active" aria-current="page">Manage Logical Question</li> --}}
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
                    <div class="row mb-4 layout-spacing layout-top-spacing">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="widget-content widget-content-area blog-create-section">
                                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                    <div class="widget-content widget-content-area br-8 position-btn">
                                        <h2 class="card-title ps-3 fw-bold text-primary">
                                            Add Student
                                        </h6>

                                        <div class="main-container " id="container">
                                            <!--  BEGIN SIDEBAR  -->
                                            <!--  END SIDEBAR  -->
                                            <!--  BEGIN CONTENT AREA  -->
                                            <div id="content" class="main-content">
                                                <div class="layout-px-spacing">
                                                    <div class="middle-content container-xxl p-0">
                                                        <!-- BREADCRUMB -->
                                                        <!-- /BREADCRUMB -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mng-add_quiz">
                                                                    <form id="add_student_form" class="p-3">
                                                                        @csrf

                                                                        <div class="q_quiz mb-3">
                                                                            <label class="form-label">Student Name</label>
                                                                            <input type="text" name="student_name" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Class Teacher Name</label>
                                                                            <select id="class_teacher_id" name="class_teacher_id" class="form-select form-control-solid">
                                                                                <option value="" disabled selected>Select a Class Teacher</option>
                                                                                @foreach($teacher as $data)
                                                                                    <option value="{{ $data->id }}">{{ $data->teacher_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="q_quiz mb-3">
                                                                            <label class="form-label">Class</label>
                                                                            <input type="text" name="class" class="form-control">
                                                                        </div>
                                                                        <div class="q_quiz mb-3">
                                                                            <label class="form-label">Admission Date</label>
                                                                            <input type="date" name="admission_date" id="admission_date" class="form-control">
                                                                        </div>
                                                                        <div class="q_quiz mb-3">
                                                                            <label class="form-label">Yearly Fees</label>
                                                                            <input type="text" name="yearly_fees" maxlength="9" class="form-control">
                                                                        </div>

                                                                        <div class="sqd_time">
                                                                            <div class="sqd_t-inner">
                                                                                <button type="submit" class="btn btn-primary me-2" value="publish" fdprocessedid="pvpsxl"
                                                                                    >Submit</button>
                                                                                <!--<a href="manage_cms_manage_quiz.php" class="publish_now">Publish Now</a>-->
                                                                                <button class="btn btn-danger">
                                                                                    <a href="{{ route('home') }}" style="text-decoration: none;color:white">Cancel</a>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  END CONTENT AREA  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
 <script>
        $("#add_student_form").validate({
            rules: {
                student_name: {
                    required: true
                },
                class_teacher_id: {
                    required: true
                },
                class: {
                    required: true
                },
                admission_date: {
                    required: true
                },
                yearly_fees: {
                    required: true
                },
            },
            messages: {
                student_name: {
                    required: "Please Enter Student Name"
                },
                class_teacher_id: {
                    required: "Please select Teacher Name"
                },
                class: {
                    required: "Please Enter class"
                },
                admission_date: {
                    required: "Please Select Admission Date"
                },
                yearly_fees: {
                    required: "Please Enter Yearly Fees"
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $.ajax({
                    url: "{{route('addstudentform')}}",
                    type: "POST",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.status == 200) {
                            toastr.success(result.message);
                            setTimeout(function() {
                                window.location.href ="{{route('home')}}";
                            }, 2000);
                        }
                    }
                });
            }
        });

        $(document).ready(function() {
        var today = new Date().toISOString().split("T")[0];
        $('#admission_date').attr('min', today);
    });
    </script>

@endsection
