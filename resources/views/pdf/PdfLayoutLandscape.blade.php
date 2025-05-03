<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Kehadiran</title>
    <style>
        {!! file_get_contents(public_path('css/pdf-style.css')) !!}
    </style>
</head>
<body>
    <table class="Judul">
        <thead>
            <tr>
                <th>Laporan Absensi Bulan 
                    {{ $Bulan }} 
                </th>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table class="Identitas">
        <thead>
            <tr>
                <th>Nama Kelas: 
                    <span style="color: blue; font-size: 64">{{ $kelas->name }}</span>
                </th>
                <th>Jumlah Siswa: 
                    <span style="color: blue; font-size: 64px">{{ $kelas->students->count() }}</span>
                    siswa
                </th>
                <th>Description: 
                    <span style="color: blue; font-size: 64px">{{ $kelas->description }}</span>
                </th>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <@for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @if ($absensi && $absensi->isNotEmpty())
                @foreach ($absensi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->student->user->name }}</td>
                        @for ($i = 1; $i <= 31; $i++)
                            @if ($item->tanggal === $bulan.'-'.sprintf('%02d', $i))
                                <td>{{ Str::substr(Str::upper($item->status), 0, 1) }}</td>
                            @else
                                <td>-</td>
                            @endif
                        @endfor
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="33" style="text-align: center; color: red">Belum ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>