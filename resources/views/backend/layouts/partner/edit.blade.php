@extends('backend.master')

@section('title')
    Partner - Edit
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Partner Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Partner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Partner Edit</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('partners.update', $partner->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ $partner->company_name }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control summernote" name="short_description">{{ $partner->short_description }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" class="form-control dropify" name="logo" data-default-file="{{ $partner->logo ? asset($partner->logo) : '' }}">
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


