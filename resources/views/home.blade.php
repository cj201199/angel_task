@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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
                                                Manage Student
                                            </h2>

                                            <div class="ps-3">
                                                <a href="{{ route('addstudent') }}"
                                                    class="btn btn-sm fw-bold btn-primary" style="margin-bottom:10px;margin-left:85%">Add
                                                    Student
                                                </a>
                                            </div>
                                            <div class="simple-pill">
                                                <table id="example" class="table dt-table-hover" style="width:100%">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th class="text-center">Sr. No.</th>
                                                            <th class="text-center">Student Name</th>
                                                            <th class="text-center">Class Teacher</th>
                                                            <th class="text-center">Class</th>
                                                            <th class="text-center">Admission Date</th>
                                                            <th class="text-center">Yearly Fees</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">

                                                        @foreach ($student as $data)
                                                            <tr>
                                                                <td class="checkbox-column text-center">
                                                                    {{ $loop->iteration }}</td>
                                                                <td class="text-center"> {{ $data->student_name }}</td>
                                                                <td class="text-center"> {{ $data->teacher->teacher_name }}
                                                                </td>
                                                                <td class="text-center"> {{ $data->class }}</td>
                                                                <td class="text-center"> {{ $data->admission_date }}</td>
                                                                <td class="text-center"> {{ $data->yearly_fees }}</td>
                                                                <td class="text-center">
                                                                    <div class="actions-btn justify-content-center">
                                                                        <a href="{{ route('editstudent', $data->id) }}">
                                                                            <i class="fa fa-edit" data-bs-toggle="tooltip"
                                                                                title="Edit"></i>

                                                                        </a>

                                                                        <a href="#deleteEmployeeModal" class="delete"
                                                                            data-delete_id="{{ $data->id }}"
                                                                            data-bs-toggle="modal">
                                                                            <i class="fa fa-trash" data-bs-toggle="tooltip"
                                                                                title="Delete"></i>
                                                                        </a>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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

    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="delete_user_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Student</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="delete_user_id" id="delete_user_id">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="user_delete_btn">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).on("click", ".delete", function() {

            var delete_user_id = $(this).data('delete_id');

            // alert(delete_user_id);

            $('#delete_user_id').val(delete_user_id);

        });

        $(document).on("click", "#user_delete_btn", function(e) {
            e.preventDefault();
            var deleteUserId = $('#delete_user_id').val();

            $.ajax({
                url: "{{ route('deletestudent') }}",
                type: "POST",
                data: {
                    user_id: deleteUserId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.messages);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        alert(result.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });
    </script>
@endsection
