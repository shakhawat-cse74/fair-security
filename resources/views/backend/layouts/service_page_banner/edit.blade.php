@extends('backend.master')

@section('title')
     Service Page Banner - Edit
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Service Page Banner Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Service Page Banner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Service Page Banner</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('service-page-banners.update', $servicePageBanner->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $servicePageBanner->title }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" class="form-control" name="sub_title" value="{{ $servicePageBanner->sub_title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control dropify" name="image" data-default-file="{{ $servicePageBanner->image ? asset($servicePageBanner->image) : '' }}">
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


