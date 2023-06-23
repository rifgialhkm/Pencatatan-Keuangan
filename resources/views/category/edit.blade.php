@extends('_layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori</h1>
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
                                <form action="{{ route('category.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <select name="type" class="form-control">
                                            <option value="Pemasukan" {{ $data->type == "Pemasukan" ? 'selected' : '' }}>Pemasukan</option>
                                            <option value="Pengeluaran" {{ $data->type == "Pengeluaran" ? 'selected' : '' }}>Pengeluaran</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('category.index') }}" class="btn btn-secondary">Kembali</a>
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