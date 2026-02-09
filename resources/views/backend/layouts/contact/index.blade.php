@extends('backend.master')

@section('title', 'Contact Messages')

@section('body')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="page-header">
    <div>
        <h1 class="page-title">Contact Messages</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Contact</a></li>
            <li class="breadcrumb-item active">Messages</li>
        </ol>
    </div>
</div>

<!-- Unread Messages Table -->
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fa fa-envelope text-warning"></i> Unread Messages
            <span class="badge bg-warning text-dark ms-2" id="unread-count">0</span>
        </h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="unread-table">
                <thead>
                    <tr>
                        <th width="5%">SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="7%">Service Type</th>
                        <th width="25%">Message</th>
                        <th width="10%">Status</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Read Messages Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fa fa-check text-success"></i> Read Messages
            <span class="badge bg-success ms-2" id="read-count">0</span>
        </h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="read-table">
                <thead>
                    <tr>
                        <th width="5%">SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="7%">Service Type</th>
                        <th width="25%">Message</th>
                        <th width="10%">Status</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let unreadTable, readTable;

    // Initialize Unread Table
    function initUnreadTable() {
        unreadTable = $('#unread-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('contact.data') }}",
                type: 'GET',
                data: function(d) {
                    d.status = 0; // Filter for unread only
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'service_type'},
                {
                    data: 'message',
                    render: function(data) {
                        return '<span title="' + (data || '') + '">' + (data && data.length > 50 ? data.substring(0, 50) + '...' : data) + '</span>';
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        return '<span class="badge bg-warning text-dark">Unread</span>';
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `
                            <button class="btn btn-sm btn-primary toggle-status" data-id="${data.id}" data-status="1" title="Mark as Read">
                                <i class="fa fa-check"></i> Read
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[0, 'desc']]
        });
    }

    // Initialize Read Table
    function initReadTable() {
        readTable = $('#read-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('contact.data') }}",
                type: 'GET',
                data: function(d) {
                    d.status = 1; // Filter for read only
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'service_type'},
                {
                    data: 'message',
                    render: function(data) {
                        return '<span title="' + (data || '') + '">' + (data && data.length > 50 ? data.substring(0, 50) + '...' : data) + '</span>';
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        return '<span class="badge bg-success">Read</span>';
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `
                            <button class="btn btn-sm btn-warning toggle-status" data-id="${data.id}" data-status="0" title="Mark as Unread">
                                <i class="fa fa-envelope"></i> Unread
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[0, 'desc']]
        });
    }

    // Update counts for badges
    function updateCounts() {
        $.ajax({
            url: "{{ route('contact.data') }}",
            type: 'GET',
            data: {status: 0, length: -1},
            success: function(response) {
                $('#unread-count').text(response.recordsTotal || 0);
            }
        });

        $.ajax({
            url: "{{ route('contact.data') }}",
            type: 'GET',
            data: {status: 1, length: -1},
            success: function(response) {
                $('#read-count').text(response.recordsTotal || 0);
            }
        });
    }

    // Initialize tables on page load
    initUnreadTable();
    initReadTable();
    updateCounts();

    // Toggle status button
    $(document).on('click', '.toggle-status', function(e) {
        e.preventDefault();
        const contactId = $(this).data('id');
        const newStatus = $(this).data('status');

        $.ajax({
            url: "{{ route('contact.update', ':id') }}".replace(':id', contactId),
            type: 'POST',
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {status: newStatus},
            success: function(response) {
                toastr.success('Status updated successfully');
                if (unreadTable) unreadTable.ajax.reload();
                if (readTable) readTable.ajax.reload();
                updateCounts();
            },
            error: function(response) {
                toastr.error(response.responseJSON?.message || 'Error updating status');
            }
        });
    });

    // Delete button
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        const contactId = $(this).data('id');
        
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{ route('contact.destroy', ':id') }}".replace(':id', contactId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message || 'Message deleted successfully');
                        if (unreadTable) unreadTable.ajax.reload();
                        if (readTable) readTable.ajax.reload();
                        updateCounts();
                        swal("Deleted!", "Message has been deleted.", "success");
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = 'Error deleting message';
                        if (xhr.responseJSON) {
                            errorMsg = xhr.responseJSON.message || xhr.responseJSON.error || errorMsg;
                        }
                        swal("Error!", errorMsg, "error");
                    }
                });
            }
        });
    });
});
</script>
@endpush

@endsection
