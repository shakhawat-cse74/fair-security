@extends('backend.master')

@section('title')
    Mission - List
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Mission List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Mission</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- TABLE -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Mission List</h3>
            <a href="{{ route('missions.create') }}" class="btn btn-danger">
                <i class="fa fa-plus"></i> Add Mission
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="missions-table">
                    <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- TABLE END -->
@endsection

@push('scripts')

{{-- Status Switch CSS --}}
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 46px;
    height: 24px;
}
.switch input { display: none; }
.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #dc3545;
    transition: .4s;
    border-radius: 34px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: #fff;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider { background-color: #28a745; }
input:checked + .slider:before { transform: translateX(22px); }
</style>

<script>
$(document).ready(function () {

    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    let table = $('#missions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('missions.data') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'sub_title', name: 'sub_title' },
            { data: 'image', name: 'image' },
            {
                data: 'status',
                render: function (data, type, row) {
                    let checked = parseInt(data) === 1 ? 'checked' : '';
                    return `
                    <label class="switch">
                        <input type="checkbox" class="toggle-status" data-id="${row.id}" ${checked}>
                        <span class="slider"></span>
                    </label>`;
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'action',  
                render: function(data, type, row) {
                    let editUrl = `/missions/${row.id}/edit`;
                    let deleteUrl = `/missions/${row.id}`;
                    return `
                    <a href="${editUrl}" class="btn btn-sm btn-warning me-1" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-item" data-id="${row.id}" title="Delete">
                        <i class="fa fa-trash"></i> 
                    </button>
                    <form id="delete-form-${row.id}" action="${deleteUrl}" method="POST" style="display:none;">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    `;
                },
                orderable: false,
                searchable: false
            }
            
        ],
        order: [[0, 'desc']]
    });

    // Status Toggle AJAX
    $(document).on('change', '.toggle-status', function () {
        let id = $(this).data('id');
        let status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/missions/' + id + '/status',
            type: 'POST',
            data: {
                _token: csrfToken,
                status: status
            },
            success: function (res) {
                toastr.success(res.message);
            },
            error: function () {
                toastr.error('Failed to update status');
            }
        });
    });

    // Delete Confirmation with SweetAlert
    $(document).on('click', '.delete-item', function () {
        let id = $(this).data('id');
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
                $(`#delete-form-${id}`).submit();
            }
        });
    });

});
</script>

@endpush