@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card mb-2">
            <div class="card-header">
                <h4 class="mb-0">Upload Products</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="uploadForm" action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Choose Excel File:</label>
                        <input type="file" id="file" name="file" accept=".xlsx, .xls" class="form-control">
                    </div>
                    <div class="my-1 text-end">
                        <button type="submit" class="btn btn-success">Import Products</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-5">
            <div class="card-header">
                <h4 class="mb-0">Products Lists</h4>
            </div>
            <div class="card-body">
                <div id="productTable" class="mt-4">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            function updateProductTable() {
                $.get("{{ route('products.table') }}", function(data) {
                    $("#productTable").html(data);
                });
            }
            updateProductTable();


            $("#uploadForm").submit(function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return;
                }
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Products imported successfully!',
                        });

                        updateProductTable();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while importing products.',
                        });

                        console.error(xhr.responseText);
                    }
                });
            });

            function validateForm() {
                var fileInput = $("#file")[0];
                if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please choose a file to upload.',
                    });
                    return false;
                }

                return true;
            }

            $(document).on('change', '#selectAll', function() {
                $(".productCheckbox").prop('checked', $(this).prop('checked'));
            });

            $(document).on('click', '#deleteSelected', function() {
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                var selectedProductIds = $(".productCheckbox:checked").map(function() {
                    return $(this).data("product-id");
                }).get();

                if (selectedProductIds.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Please select at least one product to delete.',
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('products.deleteSelected') }}",
                    type: 'DELETE',
                    data: { _token: csrf_token, ids: selectedProductIds },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Selected products deleted successfully!',
                        });

                        updateProductTable();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while deleting selected products.',
                        });

                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
