@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Kelas</title>
    <style>
        {!! file_get_contents(public_path('css/pdf-style.css')) !!}
    </style>
</head>
<body>
    {{-- @dd($bulan, $schedules, $kelas) --}}
    <table class="Judul">
        <thead>
            <tr>
                <th>Jadwal Kelas</th>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table class="jumlah">
        <thead>
            <tr>
                <td style="background-color: lightgreen">Kelas: {{ $kelas->name }}</td>
                <td style="background-color: cyan">{{ $bulan ? 'Bulan: '.$bulan : 'Semua Bulan' }}</td>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Carbon::createFromFormat('Y-m-d', $item->tanggal)->format('d-M-Y')}}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td>{{ $item->link }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>