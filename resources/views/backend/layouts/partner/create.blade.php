@extends('backend.master')

@section('title')
    Partner - Create
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Partner Create</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Partner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Partner Create</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('partners.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" placeholder="Enter Short Description"></textarea>
                                </div>
                            </div>  
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" class="form-control dropify" name="logo">
                                </div>
                            </div>  
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


