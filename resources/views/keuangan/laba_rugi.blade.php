@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Laporan Laba Rugi</h1>
    <div class="space-y-2">
        <p><span class="font-semibold">Total Pemasukan:</span> Rp{{ number_format($totalPemasukan,0,',','.') }}</p>
        <p><span class="font-semibold">Total Pengeluaran:</span> Rp{{ number_format($totalPengeluaran,0,',','.') }}</p>
        <p><span class="font-semibold">Laba Kotor:</span> Rp{{ number_format($labaKotor,0,',','.') }}</p>
        <p><span class="font-semibold">Laba Bersih:</span> Rp{{ number_format($labaBersih,0,',','.') }}</p>
    </div>
</div>
@endsection
