@forelse ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
        <td><span class="badge {{ $item->type == 'Pemasukan' ? 'badge-success' : 'badge-danger' }}">{{ $item->type }}</span></td>
        <td>{{ $item->category->name }}</td>
        <td>Rp {{ number_format($item->amount) }}</td>
        <td>{{ $item->description }}</td>
        <td>
            <form action="{{ route('financial-report.delete', $item->id) }}" method="POST">
                <a href="{{ route('financial-report.edit', $item->id) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin?')"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
@empty
    <tr><td colspan="6" align="center">Tidak ada data</td></tr>
@endforelse