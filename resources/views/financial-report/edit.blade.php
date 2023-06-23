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
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{ route('financial-report.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="date" class="form-control" value="{{ $data->date }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}" {{ $data->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $data->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="description" class="form-control" value="{{ $data->description }}">
                                    </div>
                                    <input type="hidden" name="type" value="{{ $data->type }}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('financial-report.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        const config = {
			currencySymbol : 'Rp ',
			decimalCharacter : ',',
			digitGroupSeparator : '.',
			unformatOnSubmit: true,
			modifyValueOnWheel: false
		}

		const amount = new AutoNumeric("#amount", config);
    </script>
@endsection