<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kasir</h1>
                <p class="text-gray-600">Proses transaksi penjualan harian.</p>
            </div>
            <div class="text-sm text-gray-500">
                <span>POS Multi-tenant</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white shadow rounded p-4">
                <div class="flex items-center justify-between mb-4">
                    <label for="pencarian" class="font-semibold text-gray-700">Cari Produk</label>
                    <input id="pencarian" type="text" placeholder="Cari berdasarkan nama produk" class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $search }}">
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-2">Nama Produk</th>
                                <th class="px-4 py-2">Stok</th>
                                <th class="px-4 py-2">Harga Jual</th>
                                <th class="px-4 py-2">Jumlah</th>
                                <th class="px-4 py-2">Diskon</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody id="daftar-produk" class="divide-y divide-gray-200">
                            @foreach($produk as $item)
                                <tr class="produk-row" data-nama="{{ strtolower($item->nama_produk) }}">
                                    <td class="px-4 py-2 font-medium text-gray-800">{{ $item->nama_produk }}</td>
                                    <td class="px-4 py-2">{{ $item->stok }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">
                                        <input type="number" min="1" value="1" class="qty-input w-20 border rounded px-2 py-1" aria-label="Jumlah">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="number" min="0" step="500" value="0" class="diskon-input w-24 border rounded px-2 py-1" aria-label="Diskon per unit">
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <button type="button" class="btn-tambah bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded" data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}" data-harga="{{ $item->harga_jual }}" data-stok="{{ $item->stok }}">
                                            Tambah
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow rounded p-4">
                <form id="transaksi-form" method="POST" action="{{ route('kasir.store') }}" class="space-y-4">
                    @csrf
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Keranjang Belanja</h2>
                    <div class="border border-gray-200 rounded">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-gray-700 uppercase">
                                <tr>
                                    <th class="px-3 py-2 text-left">Nama Produk</th>
                                    <th class="px-3 py-2">Jumlah</th>
                                    <th class="px-3 py-2">Harga Satuan</th>
                                    <th class="px-3 py-2">Diskon</th>
                                    <th class="px-3 py-2">Total</th>
                                    <th class="px-3 py-2"></th>
                                </tr>
                            </thead>
                            <tbody id="keranjang" class="divide-y divide-gray-200">
                                <tr id="keranjang-kosong">
                                    <td colspan="6" class="px-3 py-4 text-center text-gray-500">Belum ada produk di keranjang.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-semibold">Total</span>
                            <span id="total-bayar" class="text-lg font-bold text-gray-900">Rp 0</span>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="input-bayar" class="text-gray-700 font-semibold">Bayar</label>
                            <input id="input-bayar" name="bayar" type="number" min="0" step="500" value="0" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-semibold">Kembalian</span>
                            <span id="kembalian" class="text-lg font-bold text-gray-900">Rp 0</span>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="metode_pembayaran" class="text-gray-700 font-semibold">Metode Pembayaran</label>
                            <select id="metode_pembayaran" name="metode_pembayaran" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                    </div>

                    <div id="item-fields"></div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded">Proses Transaksi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const cart = [];

        const formatRupiah = (angka) => {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
        };

        const renderCart = () => {
            const keranjang = document.getElementById('keranjang');
            keranjang.innerHTML = '';

            if (cart.length === 0) {
                keranjang.innerHTML = '<tr id="keranjang-kosong"><td colspan="6" class="px-3 py-4 text-center text-gray-500">Belum ada produk di keranjang.</td></tr>';
                updateSummary();
                return;
            }

            cart.forEach((item, index) => {
                const totalItem = Math.max((item.harga - item.diskon) * item.qty, 0);
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="px-3 py-2 font-medium text-gray-800">${item.nama}</td>
                    <td class="px-3 py-2"><input type="number" min="1" value="${item.qty}" class="cart-qty w-20 border rounded px-2 py-1" data-index="${index}"></td>
                    <td class="px-3 py-2">${formatRupiah(item.harga)}</td>
                    <td class="px-3 py-2"><input type="number" min="0" step="500" value="${item.diskon}" class="cart-diskon w-24 border rounded px-2 py-1" data-index="${index}"></td>
                    <td class="px-3 py-2 font-semibold text-gray-900">${formatRupiah(totalItem)}</td>
                    <td class="px-3 py-2 text-right"><button type="button" class="hapus-item text-red-600" data-index="${index}">Hapus</button></td>
                `;
                keranjang.appendChild(row);
            });

            bindCartEvents();
            updateSummary();
        };

        const bindCartEvents = () => {
            document.querySelectorAll('.cart-qty').forEach(input => {
                input.addEventListener('change', (e) => {
                    const idx = parseInt(e.target.dataset.index);
                    cart[idx].qty = Math.max(parseInt(e.target.value) || 1, 1);
                    renderCart();
                });
            });

            document.querySelectorAll('.cart-diskon').forEach(input => {
                input.addEventListener('change', (e) => {
                    const idx = parseInt(e.target.dataset.index);
                    cart[idx].diskon = Math.max(parseFloat(e.target.value) || 0, 0);
                    renderCart();
                });
            });

            document.querySelectorAll('.hapus-item').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const idx = parseInt(e.target.dataset.index);
                    cart.splice(idx, 1);
                    renderCart();
                });
            });
        };

        const updateSummary = () => {
            let total = 0;
            cart.forEach(item => {
                total += Math.max((item.harga - item.diskon) * item.qty, 0);
            });
            document.getElementById('total-bayar').textContent = formatRupiah(total);

            const bayar = parseFloat(document.getElementById('input-bayar').value) || 0;
            const kembalian = Math.max(bayar - total, 0);
            document.getElementById('kembalian').textContent = formatRupiah(kembalian);
        };

        document.querySelectorAll('.btn-tambah').forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const qtyInput = row.querySelector('.qty-input');
                const diskonInput = row.querySelector('.diskon-input');

                const qty = Math.max(parseInt(qtyInput.value) || 1, 1);
                const diskon = Math.max(parseFloat(diskonInput.value) || 0, 0);

                const id = parseInt(button.dataset.id);
                const existingIndex = cart.findIndex(item => item.id === id);

                if (existingIndex >= 0) {
                    cart[existingIndex].qty += qty;
                    cart[existingIndex].diskon = diskon;
                } else {
                    cart.push({
                        id,
                        nama: button.dataset.nama,
                        harga: parseFloat(button.dataset.harga),
                        qty,
                        diskon,
                    });
                }

                renderCart();
                qtyInput.value = '1';
                diskonInput.value = '0';
            });
        });

        document.getElementById('input-bayar').addEventListener('input', updateSummary);

        document.getElementById('pencarian').addEventListener('input', (event) => {
            const keyword = event.target.value.toLowerCase();
            document.querySelectorAll('#daftar-produk tr').forEach(row => {
                const nama = row.dataset.nama || '';
                row.classList.toggle('hidden', !nama.includes(keyword));
            });
        });

        document.getElementById('transaksi-form').addEventListener('submit', (event) => {
            const container = document.getElementById('item-fields');
            container.innerHTML = '';

            if (cart.length === 0) {
                event.preventDefault();
                alert('Keranjang masih kosong. Tambahkan produk terlebih dahulu.');
                return;
            }

            cart.forEach((item, index) => {
                const fields = [
                    { name: `items[${index}][produk_id]`, value: item.id },
                    { name: `items[${index}][qty]`, value: item.qty },
                    { name: `items[${index}][harga_satuan]`, value: item.harga },
                    { name: `items[${index}][diskon]`, value: item.diskon },
                ];

                fields.forEach(field => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = field.name;
                    input.value = field.value;
                    container.appendChild(input);
                });
            });
        });

        renderCart();
    </script>
</body>
</html>
