@extends('backend.master')

@section('title', 'View Contact')

@section('body')

<div class="page-header">
    <div>
        <h1 class="page-title">Contact Details</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Contact Information</h3>
                <div>
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Name</h6>
                        <p class="mb-3">{{ $contact->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Email</h6>
                        <p class="mb-3">
                            <a href="mailto:{{ $contact->email }}">{{ $contact->email ?? 'N/A' }}</a>
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Phone</h6>
                        <p class="mb-3">
                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Address</h6>
                        <p class="mb-3">{{ $contact->address ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Service Type</h6>
                        <p class="mb-3">
                            <span class="badge bg-primary">{{ $contact->service_type }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Status</h6>
                        <p class="mb-3">
                            @if($contact->status)
                                <span class="badge bg-success">Read</span>
                            @else
                                <span class="badge bg-warning text-dark">Unread</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-muted mb-1">Message</h6>
                        <div class="border p-3 rounded" style="background-color: #f8f9fa;">
                            {{ $contact->message ?? 'No message provided' }}
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-muted mb-2">Metadata</h6>
                        <small class="text-muted">
                            <p class="mb-1">
                                <strong>Submitted:</strong> {{ $contact->created_at->format('M d, Y \a\t h:i A') }}
                            </p>
                            <p class="mb-0">
                                <strong>Last Updated:</strong> {{ $contact->updated_at->format('M d, Y \a\t h:i A') }}
                            </p>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('contact.update', $contact->id) }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Mark Status</label>
                        <select class="form-control" name="status">
                            <option value="0" {{ $contact->status === 0 ? 'selected' : '' }}>Unread</option>
                            <option value="1" {{ $contact->status === 1 ? 'selected' : '' }}>Read</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fa fa-save"></i> Update Status
                    </button>
                </form>

                <hr>

                <div class="d-grid gap-2">
                    <a href="mailto:{{ $contact->email }}" class="btn btn-info btn-sm">
                        <i class="fa fa-envelope"></i> Reply via Email
                    </a>
                    <a href="tel:{{ $contact->phone }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-phone"></i> Call Now
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" id="deleteBtn">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>

                <form id="deleteForm" action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#deleteBtn').on('click', function() {
        swal({
            title: "Are you sure?",
            text: "You won't be able to recover this contact message!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $('#deleteForm').submit();
            }
        });
    });
});
</script>
@endpush
