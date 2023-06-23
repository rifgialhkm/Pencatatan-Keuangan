<table>
    <thead>
        <tr>
            <th colspan="8" rowspan="2" style="text-align: center; vertical-align: middle;font-size:16px;"><b>Catatan Keuangan</b></th>
        </tr>
        <tr></tr>
        <tr>
            <th><b>Tanggal</b></th>
            <th><b>Tipe</b></th>
            <th><b>Kategori</b></th>
            <th><b>Jumlah</b></th>
            <th><b>Keterangan</b></th>
        </tr>
    </thead>
    <tbody>
    @forelse($data as $item)
        <tr>
            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->description }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Tidak ada data</td>
        </tr>
    @endforelse
    </tbody>
</table>