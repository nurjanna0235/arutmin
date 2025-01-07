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
        <form method="GET" action="{{ url('/rate-contract/asbar/daywork-asbar') }}" class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
            </div>

            <!-- Input Filter Item -->
            <div class="form-group">
                <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                    <option selected value="">Pilih Item</option>
                    <option value="Excavator 20 Ton / PC200 / ZX200">Excavator 20 Ton / PC200 / ZX200</option>
                    <option value="Excavator 30 Ton / PC300 / Cat 325D / ZX330">Excavator 30 Ton / PC300 / Cat 325D / ZX330</option>
                    <option value="Excavator 40 Ton / PC400 / ZX450">Excavator 40 Ton / PC400 / ZX450</option>
                    <option value="Excavator 50 Ton / DX500">Excavator 50 Ton / DX500</option>
                    <option value="Excavator 50 Ton / DX800">Excavator 50 Ton / DX800</option>
                    <option value="Excavator 120 Ton / EX1200">Excavator 120 Ton / EX1200</option>
                    <option value="Excavator 120 Ton / PC1250">Excavator 120 Ton / PC1250</option>
                    <option value="Excavator 200 Ton / PC2000">Excavator 200 Ton / PC2000</option>
                    <option value="Excavator 250 Ton / EX2500">Excavator 250 Ton / EX2500</option>
                    <option value="Excavator 260 Ton / EX2600">Excavator 260 Ton / EX2600</option>
                    <option value="Front-End Loader (FEL) Cat 992G (min. 250 hrs)">Front-End Loader (FEL) Cat 992G (min. 250 hrs)</option>
                    <option value="Front-End Loader (FEL) Cat 992G (min. 300 hrs)">Front-End Loader (FEL) Cat 992G (min. 300 hrs)</option>
                    <option value="Front-End Loader (FEL) Cat 992G (min. 350 hrs)">Front-End Loader (FEL) Cat 992G (min. 350 hrs)</option>
                    <option value="Loader WA500">Loader WA500</option>
                    <option value="HD785 / 777D">HD785 / 777D</option>
                    <option value="Cat 777A">Cat 777A</option>
                    <option value="HD465 / 773E">HD465 / 773E</option>
                    <option value="Iveco / Hino">Iveco / Hino</option>
                    <option value="Volvo FM440">Volvo FM440</option>
                    <option value="CWB45">CWB45</option>
                    <option value="DT Hino">DT Hino</option>
                    <option value="Dozer D85ESS / D7G">Dozer D85ESS / D7G</option>
                    <option value="Dozer D8 / D155">Dozer D8 / D155</option>
                    <option value="Dozer D375A / D10T (min. 250 hrs)">Dozer D375A / D10T (min. 250 hrs)</option>
                    <option value="Dozer D375A / D10T (min. 300 hrs)">Dozer D375A / D10T (min. 300 hrs)</option>
                    <option value="Dozer D375A / D10T (min. 350 hrs)">Dozer D375A / D10T (min. 350 hrs)</option>
                    <option value="Grader 16H / GD825">Grader 16H / GD825</option>
                    <option value="Grader 14H / GD705">Grader 14H / GD705</option>
                    <option value="Grader 12 H">Grader 12 H</option>
                    <option value="Compactor">Compactor</option>
                    <option value="Water Pump LC100">Water Pump LC100</option>
                    <option value="Water Pump LC200">Water Pump LC200</option>
                    <option value="Water Pump MF420E">Water Pump MF420E</option>
                    <option value="Lightning Plant">Lightning Plant</option>
                    <option value="Water Truck 20KL">Water Truck 20KL</option>
                    <option value="Fuel Truck">Fuel Truck</option>
                    <option value="Crane Truck">Crane Truck</option>
                    <option value="Hydraulik Excavator (HL) 200">Hydraulik Excavator (HL) 200</option>
                    <option value="Crane 55 Ton">Crane 55 Ton</option>
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
                    <th scope="col" style="width: 15%;"> Labour </th>
                    <th scope="col" style="width: 15%;"> (Rp/Hrs) </th>
                    <th scope="col" style="width: 15%;"> Currency Adjustment </th>
                    <th scope="col" style="width: 15%;"> Index </th>
                    <th scope="col" style="width: 15%;"> Premium Rate </th>
                    <th scope="col" style="width: 15%;"> General Escalation </th>
                    <th scope="col" style="width: 15%;"> Actual Rate Exc. Fuel (Rp/Hrs) </th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-danger fw-bold"></td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('rate-contract/asbar/daywork-asbar/detail/1') }}">
                                <i class="ri-information-line" title="Detail"></i>
                            </a>
                            <a href="{{ url('rate-contract/asbar/daywork-asbar/edit/1') }}">
                                <i class="ri-edit-2-line text-warning" title="Edit"></i>
                            </a>
                            <form action="{{ url('/rate-contract/asbar/daywork-asbar/delete/1') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none;">
                                    <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
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