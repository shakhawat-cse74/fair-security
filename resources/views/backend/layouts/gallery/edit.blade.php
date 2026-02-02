@extends('backend.master')

@section('title')
    Gallery - Edit
@endsection

@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Gallery Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gallery Edit</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('galleries.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                        {{-- TITLE --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $gallery->title }}">
                            </div>
                        </div>


                        {{-- EXISTING IMAGES --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Existing Images</label>
                            <div class="row">

                                @php
                                    $images = json_decode($gallery->image, true) ?? [];
                                @endphp

                                @forelse($images as $key => $img)
                                    <div class="col-md-3 mb-3 text-center" id="imageBox{{ $key }}">
                                        <img src="{{ asset($img) }}" 
                                             class="img-fluid rounded mb-2 border" 
                                             style="height:130px; width:100%; object-fit:cover;">

                                        <button type="button"
                                                class="btn btn-sm btn-danger removeImageBtn mt-1"
                                                data-id="{{ $gallery->id }}"
                                                data-image="{{ $img }}"
                                                data-key="{{ $key }}">
                                            🗑 Delete
                                        </button>
                                    </div>
                                @empty
                                    <p class="text-muted ms-3">No images uploaded yet.</p>
                                @endforelse

                            </div>
                        </div>

                        <hr>

                        {{-- ADD NEW IMAGES --}}
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Add New Images (Appends to existing)</label>
                            <input type="file" class="form-control mb-2" id="newImagesInput" name="image[]" multiple accept="image/*">
                            
                            <div id="imagePreviewContainer" class="row mt-3">
                                {{-- New image previews will be appended here --}}
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

@section('script')

{{-- IMAGE PREVIEW FOR NEW IMAGES --}}
<script>
    $('#newImagesInput').on('change', function() {
        const container = $('#imagePreviewContainer');
        container.empty();
        
        const files = this.files;
        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const html = `
                        <div class="col-md-2 mb-3 text-center">
                            <img src="${e.target.result}" class="img-fluid rounded border" style="height:100px; width:100%; object-fit:cover;">
                            <small class="text-muted d-block mt-1">Pending...</small>
                        </div>
                    `;
                    container.append(html);
                }
                reader.readAsDataURL(file);
            });
        }
    });
</script>

{{-- DELETE SINGLE IMAGE AJAX --}}
<script>
    $(document).on('click', '.removeImageBtn', function () {
        let btn = $(this);
        let id = btn.data('id');
        let image = btn.data('image');
        let key = btn.data('key');

        if (!confirm('Are you sure you want to delete this image?')) return;

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: "{{ route('gallery.delete.image') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                image: image
            },
            success: function (res) {
                if (res.success) {
                    $('#imageBox' + key).fadeOut(400, function() {
                        $(this).remove();
                    });
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message);
                    btn.prop('disabled', false).html('🗑 Delete');
                }
            },
            error: function(xhr) {
                toastr.error('Something went wrong!');
                btn.prop('disabled', false).html('🗑 Delete');
            }
        });
    });
</script>

@endsection


