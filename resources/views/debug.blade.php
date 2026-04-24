<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Debug</title>
</head>
<body>
    <h1>DEBUG</h1>
    
    {{-- <pre>{{ json_encode($debug, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> --}}

    <br>
    <br>
    <pre>{{ json_encode($tess ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    <p>spasi</p>
    {{-- @forelse ($debug ?? [] as $item)
    <pre>{{ json_encode($item->name, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    <pre>{{ json_encode($item->daftarNilaiSiswa, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        @foreach ($item->daftarNilaiSiswa as $nilai)
        <pre>{{ json_encode($nilai->mapel->nama_mapel, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        @endforeach
    <h2>{{$rapor->siswa->name}}</h2>
    @empty
    <p>kosong</p>
    @endforelse

    <p>spasi2</p> --}}


    <pre>{{ json_encode($tes ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    <br>
    <pre>{{ json_encode($tesss ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

    {{-- <p>{{$tes}}</p> --}}
    {{-- <h1>{{$tess}}</h1> --}}
 
    {{-- <p>{{$daftarSiswa}}</p> --}}

    <img src="{{ asset('asset/school-solid-full.png') }}" alt="hah">
</body>
</html>