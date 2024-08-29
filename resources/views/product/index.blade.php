@extends('layouts.layout')

@section('content')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Vertical Hovered</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                        <li class="breadcrumb-item active">Vertical Hovered</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Ajax Datatables</h5>
                                </div>
                                <div class="card-body">
                                    <table id="ajax-product" class="display table table-bordered dt-responsive datatable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Extn.</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Extn.</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // console.log('testing');
    // $(document).ready(function() {
    //     $('#ajax-product').DataTable();
    // });

    $(document).ready(function() {
    const authToken = localStorage.getItem('token');
    console.log('auth ', authToken);
    $('#ajax-product').DataTable({
        "processing": true,
        "serverSide": true, // Aktifkan server-side processing
        "ajax": {
            "url": "{{ route('product.index') }}", // Gantilah dengan nama route yang sesuai
            "type": "GET", // Metode HTTP yang digunakan (GET atau POST)
            "headers": {
                'Authorization': authToken // Gantilah dengan token autentikasi Anda
            }
        },
        // "columns": [
        //     { "data": "column1" }, // Gantilah dengan nama kolom yang sesuai
        //     { "data": "column2" }, // Gantilah dengan nama kolom yang sesuai
        //     // Tambahkan kolom-kolom lain sesuai kebutuhan
        // ]
    });
});

   
</script>
@endsection

