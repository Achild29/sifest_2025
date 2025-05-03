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
                <th>Laporan Absensi Bulan {{ $Bulan }} </th>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table class="Identitas">
        <thead>
            <tr>
                <th>Nama: <span style="color: blue; font-size: 46px">{{ $student->user->name }}</span></th>
                <th>NIM: <span style="color: blue; font-size: 46px">{{ $student->nisn }}</span></th>
                <th>KELAS: <span style="color: blue; font-size: 46px">{{ $student->classRoom->name }}</span></th>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table class="jumlah">
        <thead>
            <tr>
                <td style="background-color: lightgreen">Hadir: {{ $jumlahKehadiran['h'] }}</td>
                <td style="background-color: rgb(233, 233, 233);">Sakit: {{ $jumlahKehadiran['s'] }}</td>
                <td style="background-color: cyan">Izin: {{ $jumlahKehadiran['i'] }}</td>
                <td style="background-color: tomato; color: white">Alpha: {{ $jumlahKehadiran['a'] }}</td>
                <td style="background-color: cadetblue">Others: {{ $jumlahKehadiran['o'] }}</td>
            </tr>
        </thead>
    </table>
    <div class="spacer"></div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 31; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ sprintf('%02d', $i).'-'.$Bulan }}</td>
                    @if ($absensi && $absensi->isNotEmpty())
                        @foreach ($absensi as $item)
                            @if ($item->tanggal === $bulan.'-'.sprintf('%02d', $i))
                                <td>
                                    {{ Str::substr(Str::upper($item->status), 0, 1) }}
                                </td>
                                <td>
                                    {{ $item->message }}
                                </td>
                            @endif
                        @endforeach
                    @endif
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>