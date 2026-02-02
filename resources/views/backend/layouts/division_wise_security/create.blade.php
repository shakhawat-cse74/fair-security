@extends('backend.master')

@section('title')
    Division Wise Security - Create
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Division Wise Security Create</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Division Wise Security</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Division Wise Security Create</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('division-wise-security.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Division Name</label>
                                    <select class="form-control" name="division_name">
                                        <option value="">-- Select Division --</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Chattogram">Chattogram</option>
                                        <option value="Khulna">Khulna</option>
                                        <option value="Rajshahi">Rajshahi</option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Mymensingh">Mymensingh</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Security Quantity</label>
                                    <input type="number" class="form-control" name="security_qty" placeholder="Enter Security Quantity">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Security Purpose</label>
                                    <input type="text" class="form-control" name="security_purpose" placeholder="Enter Security Purpose">   
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Deployment Area</label>
                                    <input type="text" class="form-control" name="deployment_area" placeholder="Enter Deployment Area">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Support Staff</label>
                                    <input type="number" class="form-control" name="support_staff" placeholder="Enter Support Staff">
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


