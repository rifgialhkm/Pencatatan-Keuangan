@extends('_layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan Keuangan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-long-arrow-alt-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pemasukan</span>
                            <span class="info-box-number">Rp {{ number_format($income) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-long-arrow-alt-down"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengeluaran</span>
                            <span class="info-box-number">Rp {{ number_format($expenditure) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="form-row">
                        <div class="col-md-3 col-sm-7 col-6">
                            <select class="form-control" id="type" name="type">
                                <option selected disabled>Filter berdasarkan tipe</option>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="col-md-9 col-sm-5 col-4">
                            <button class="btn btn-primary" id="typeFilter">Filter</button>
                        </div>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('financial-report.export') }}" class="btn btn-success">Export</a>
                        <a href="{{ route('financial-report.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    @if (session()->has('success'))    
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @include('financial-report.tbody')
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{  $data->links()  }}
                    </ul>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $('#typeFilter').on('click', function() {
            var type = $('#type').val();

            $.ajax({
                url: "{{ route('financial-report.index') }}" + '?type=' + type,
                dataType: 'html',
                beforeSend:function(){
                    $('#typeFilter').text('Proses...');
                    $('#typeFilter').prop('disabled', true);
                },
                success: function(data) {
                    $('#typeFilter').text('Filter');
                    $('#typeFilter').prop('disabled', false);

                    $('#table-body').html(data);
                }
            })
        })
    </script>
@endsection