<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test fastprint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('gagal'))
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
    @endif

    <div class="container">
        <h3>Form Tambah Barang</h3>
        <form method="POST" action="{{route('dataCRUD.store')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly name="id_produk">

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                <input type="text" class="form-control is-invalid" name="nama_produk">
                @error('nama_produk')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Harga</label>
                <input type="number" class="form-control is-invalid" name="harga">
                @error('harga')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kategori</label>
                <input type="text" class="form-control is-invalid" name="kategori">
                @error('kategori')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Pilih Status</label>
                <select id="disabledSelect" class="form-select" name="status">
                  <option value="bisa dijual">bisa dijual</option>
                  <option value="tidak bisa dijual">tidak bisa dijual</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <br> <hr>
        @if (count($data) == 0)
            <h3>Data masih kosong, TEKAN BUTTON DULU !</h3>
        @else
            <h3>Data barang</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Status</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $item->id_produk }}</th>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <form action="{{ route('dataCRUD.destroy', $item->id_produk) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                            <td>
                                <button type="submit"
                                class="btn btn-primary update-btn"
                                data-id = "{{$item->id_produk}}"
                                data-nama_produk="{{ $item->nama_produk }}"
                                data-harga="{{ $item->harga }}"
                                data-kategori="{{ $item->kategori }}"
                                data-status="{{ $item->status }}"
                                >
                                    Update
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <br><br>
        <h4>Ambil data disini</h4>
        <a href="{{ route('getdata') }}" class="btn btn-primary"> Get Data</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var confirmation = confirm("Are you sure you want to delete this data?");
                if (confirmation) {
                    $(this).closest('.delete-form').submit();
                }
            });

            $('.update-btn').on('click', function(e) {
                e.preventDefault();

                // Tangkap data dari atribut tombol "Update"
                var id_produk = $(this).data('id');
                var nama_produk = $(this).data('nama_produk');
                var harga = $(this).data('harga');
                var kategori = $(this).data('kategori');
                var status = $(this).data('status');
                console.log(nama_produk);

                // Isi input form dengan data yang ditangkap
                $('input[name="id_produk"]').val(id_produk);
                $('input[name="nama_produk"]').val(nama_produk);
                $('input[name="harga"]').val(harga);
                $('input[name="kategori"]').val(kategori);
                $('select[name="status"]').val(status);
            });
        });
    </script>
</body>

</html>
