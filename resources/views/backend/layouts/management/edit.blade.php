@extends('backend.master')

@section('title')
    Management - Edit
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Management Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Management Edit</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('management.update', $management->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Branch</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $management->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $management->name }}">
                                </div>
                            </div>

                            

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control dropify" name="image" data-default-file="{{ $management->image ? asset($management->image) : '' }}">
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" class="form-control" name="designation" value="{{ $management->designation }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $management->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $management->phone }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee ID</label>
                                    <input type="text" class="form-control" name="employee_id" value="{{ $management->employee_id }}">
                                </div>
                            </div>
                            
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Joining Date</label>
                                    <input type="text" class="form-control" name="joining_date" value="{{ $management->joining_date }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control summernote" name="message">{{ $management->message }}</textarea>
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200
            });
        });
    </script>
@endpush
