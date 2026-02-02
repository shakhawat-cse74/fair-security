@extends('backend.master')

@section('title')
    Division Wise Security - Edit
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Division Wise Security Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Division Wise Security</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Division Wise Security Edit</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('division-wise-security.update', $divisionWiseSecurity->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Division Name</label>
                                    <select class="form-control" name="division_name">
                                        <option value="">-- Select Division --</option>
                                        <option value="Dhaka" {{ $divisionWiseSecurity->division_name == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                        <option value="Chattogram" {{ $divisionWiseSecurity->division_name == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                                        <option value="Khulna" {{ $divisionWiseSecurity->division_name == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                        <option value="Rajshahi" {{ $divisionWiseSecurity->division_name == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                        <option value="Barishal" {{ $divisionWiseSecurity->division_name == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                        <option value="Sylhet" {{ $divisionWiseSecurity->division_name == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                        <option value="Rangpur" {{ $divisionWiseSecurity->division_name == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                        <option value="Mymensingh" {{ $divisionWiseSecurity->division_name == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Security Quantity</label>
                                    <input type="number" class="form-control" name="security_qty" value="{{ $divisionWiseSecurity->security_qty }}" placeholder="Enter Security Quantity">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Security Purpose</label>
                                    <input type="text" class="form-control" name="security_purpose" value="{{ $divisionWiseSecurity->security_purpose }}" placeholder="Enter Security Purpose">   
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Deployment Area</label>
                                    <input type="text" class="form-control" name="deployment_area" value="{{ $divisionWiseSecurity->deployment_area }}" placeholder="Enter Deployment Area">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Support Staff</label>
                                    <input type="number" class="form-control" name="support_staff" value="{{ $divisionWiseSecurity->support_staff }}" placeholder="Enter Support Staff">
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


