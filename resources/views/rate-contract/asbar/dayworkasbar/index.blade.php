@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork</li>
            </ol>
        </nav>
    </div>
    <div class="icon mb-3">
        <a href="/rate-contract/asbar/daywork-asbar/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
    </div>

    <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/rate-contract/asbar/daywork-asbar') }}"
            class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun"
                    value="{{ request('tahun') }}">
            </div>

            <!-- Input Filter Item -->
            <div class="form-group">
                <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                    <option selected value="">Pilih Item</option>
                    @foreach($itemList as $item)
                    <option value="{{$item->id_item_daywork_asbar}}">{{$item->nama_item}}</option>
                    @endforeach
                </select>

            </div>

            <!-- Tombol Submit untuk Search -->
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <!-- Table with stripped rows -->
    <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 5%;"> No</th>
                    <th scope="col" style="width: 15%;"> Bulan/Tahun </th>
                    <th scope="col" style="width: 10%;"> Item </th>
                    <th scope="col" style="width: 15%;"> Base Rate Exc. Fuel (Rp/Hrs) </th>
                    <th scope="col" style="width: 15%;"> Currency Adjustment </th>
                    <th scope="col" style="width: 15%;"> Index </th>
                    <th scope="col" style="width: 15%;"> Premium Rate </th>
                    <th scope="col" style="width: 15%;"> General Escalation </th>
                    <th scope="col" style="width: 15%;"> Actual Rate Exc. Fuel (Rp/Hrs) </th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $No = 1; ?>
                @foreach($dokumendaywork as $item)
                <tr>
                    <td>{{$No++}}</td>
                    <td>{{ $item->bulan_tahun }}</td>
                    <td>{{ $item->nama_item }}</td>
                    <td>{{ $item->base_rate_exc_fuel }}</td>
                    <td>{{ $item->currency_adjustment }}</td>
                    <td>{{ $item->index }}</td>
                    <td>{{ $item->premium_rate }}</td>
                    <td>{{ $item->general_escalation }}</td>
                    <td>{{ $item->actual_rate_exc_fuel }}</td>

                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('rate-contract/asbar/daywork-asbar/detail/'.$item->id_daywork_asbar)}}">
                                <i class="ri-information-line" title="Detail"></i>
                            </a>
                            <a href="{{ url('rate-contract/asbar/daywork-asbar/edit/'.$item->id_daywork_asbar) }}">
                                <i class="ri-edit-2-line text-warning" title="Edit"></i>
                            </a>
                            <form
                                action="{{ url('/rate-contract/asbar/daywork-asbar/delete/'.$item->id_daywork_asbar) }}"
                                method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none;">
                                    <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row"></div>
        <div class="icon mb-5">
            <a type="submit" href="/rate-contract/asbar" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection