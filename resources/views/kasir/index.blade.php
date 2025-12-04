@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">POS Kasir</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="formKasir" method="POST" action="{{ route('kasir.proses') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-select">
                    <option value="">Umum</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bayar (Rp)</label>
                <input type="number" step="0.01" name="bayar" id="bayarInput" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Cari Produk</label>
            <input type="text" id="cariProduk" class="form-control" placeholder="Ketik nama atau SKU...">
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered" id="tabelProduk">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $item)
                        <tr data-id="{{ $item->id }}" data-harga="{{ $item->harga_jual }}" data-nama="{{ $item->nama_produk }}">
                            <td>{{ $item->nama_produk }}</td>
                            <td>Rp {{ number_format($item->harga_jual,0,',','.') }}</td>
                            <td>{{ $item->stok }}</td>
                            <td><input type="number" min="1" value="1" class="form-control form-control-sm qty-input"></td>
                            <td class="subtotal">Rp {{ number_format($item->harga_jual,0,',','.') }}</td>
                            <td><button type="button" class="btn btn-sm btn-primary tambah-keranjang">Tambah</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h5>Keranjang</h5>
        <div class="table-responsive mb-3">
            <table class="table" id="keranjang">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="2"></textarea>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: Rp <span id="totalLabel">0</span></h4>
            <h5>Kembalian: Rp <span id="kembalianLabel">0</span></h5>
        </div>

        <button type="submit" class="btn btn-success mt-3">Proses Transaksi</button>
    </form>
</div>

<script>
    const keranjangBody = document.querySelector('#keranjang tbody');
    const totalLabel = document.getElementById('totalLabel');
    const kembalianLabel = document.getElementById('kembalianLabel');
    const bayarInput = document.getElementById('bayarInput');

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID').format(value);
    }

    function hitungTotal() {
        let total = 0;
        keranjangBody.querySelectorAll('tr').forEach(row => {
            total += parseFloat(row.dataset.subtotal);
        });
        totalLabel.textContent = formatRupiah(total);
        const bayar = parseFloat(bayarInput.value || 0);
        kembalianLabel.textContent = formatRupiah(Math.max(bayar - total, 0));
    }

    document.querySelectorAll('.tambah-keranjang').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('tr');
            const id = row.dataset.id;
            const nama = row.dataset.nama;
            const harga = parseFloat(row.dataset.harga);
            const qty = parseInt(row.querySelector('.qty-input').value || 1);
            const subtotal = harga * qty;

            const newRow = document.createElement('tr');
            newRow.dataset.subtotal = subtotal;
            newRow.innerHTML = `
                <td>${nama}<input type="hidden" name="items[][produk_id]" value="${id}"></td>
                <td><input type="number" name="items[][qty]" value="${qty}" min="1" class="form-control form-control-sm qty-cart"></td>
                <td>Rp ${formatRupiah(harga)}<input type="hidden" name="items[][harga_satuan]" value="${harga}"></td>
                <td class="subtotal-cart">Rp ${formatRupiah(subtotal)}</td>
                <td><button type="button" class="btn btn-sm btn-danger hapus-item">Hapus</button></td>
            `;
            keranjangBody.appendChild(newRow);
            hitungTotal();
        });
    });

    keranjangBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('hapus-item')) {
            e.target.closest('tr').remove();
            hitungTotal();
        }
    });

    keranjangBody.addEventListener('change', (e) => {
        if (e.target.classList.contains('qty-cart')) {
            const row = e.target.closest('tr');
            const harga = parseFloat(row.querySelector('input[name="items[][harga_satuan]"]').value);
            const qty = parseInt(e.target.value || 1);
            const subtotal = harga * qty;
            row.dataset.subtotal = subtotal;
            row.querySelector('.subtotal-cart').textContent = 'Rp ' + formatRupiah(subtotal);
            hitungTotal();
        }
    });

    bayarInput.addEventListener('input', hitungTotal);
</script>
@endsection
