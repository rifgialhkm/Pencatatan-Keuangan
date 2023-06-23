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
                <div class="col-12 col-sm-6 mx-auto">
                    <div class="card card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active bg-success" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pemasukan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pengeluaran</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <form method="POST" action="{{ route('financial-report.store') }}">
                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" name="date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" name="category_id" required>
                                                    <option selected disabled>--- Pilih Kategori ---</option>
                                                    @foreach ($incomeCategory as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="text" name="amount" id="incomeAmount" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="description" class="form-control">
                                            </div>
                                            <input type="hidden" name="type" value="Pemasukan">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <a href="{{ route('financial-report.index') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <form method="POST" action="{{ route('financial-report.store') }}">
                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" name="date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" name="category_id">
                                                    <option selected disabled>--- Pilih Kategori ---</option>
                                                    @foreach ($expenditureCategory as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="text" name="amount" id="expenditureAmount" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="description" class="form-control">
                                            </div>
                                            <input type="hidden" name="type" value="Pengeluaran">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <a href="{{ route('financial-report.index') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $( "#custom-tabs-one-home-tab" ).on( "click", function() {
            $(this).addClass("bg-success");
            $('#custom-tabs-one-profile-tab').removeClass('bg-danger');
        });

        $( "#custom-tabs-one-profile-tab" ).on( "click", function() {
            $(this).addClass("bg-danger");
            $('#custom-tabs-one-home-tab').removeClass('bg-success');
        });

        const config = {
			currencySymbol : 'Rp ',
			decimalCharacter : ',',
			digitGroupSeparator : '.',
			unformatOnSubmit: true,
			modifyValueOnWheel: false
		}

		const incomeAmount = new AutoNumeric("#incomeAmount", config);
		const expenditureAmount = new AutoNumeric("#expenditureAmount", config);
    </script>
@endsection