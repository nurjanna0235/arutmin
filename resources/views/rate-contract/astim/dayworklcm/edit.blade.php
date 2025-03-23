@extends('componen.template-admin')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Daywork</li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action="/rate-contract/astim/daywork-lcm/update/{{ $rate_contract->id_contract }}" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>Item</th>
                                        <th>Model</th>
                                        <th>Actual Rate Exc. Fuel (Rp/Hrs)</th>
                                        <th>FBR (liter/hrs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dokumen as $item)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="id_dokumen[]" value="{{ $item['id_daywork_lcm'] }}">
                                                <input type="hidden" name="item[]" value="{{ $item['item'] }}">
                                                <small>{{ $item['item'] }}</small>
                                            </td>
                                            <td>
                                                <input type="hidden" name="model[]" value="{{ $item['model'] }}">
                                                <small>{{ $item['model'] }}</small>
                                            </td>
                                            <td>
                                                <div class="col-12">
                                                    <input name="actual_rate[]" type="text" class="form-control"
                                                        value="{{ old('actual_rate.' . $loop->index, $item['rate_per_hour']) }}"
                                                        required>
                                                    @error('actual_rate.' . $loop->index)
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12">
                                                    <input name="fbr[]" type="number" class="form-control"
                                                        value="{{ old('fbr.' . $loop->index, $item['fuel_burn_rate']) }}"
                                                        required>
                                                    @error('fbr.' . $loop->index)
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input value="{{ $dokumen->name_contract }}" name="name_contract" type="text"
                                class="form-control" id="name_contract">
                        </div>

                            <!-- Contract Reference -->
                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                @if ($rate_contract->contract_refren)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $rate_contract->contract_refren) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/' . $rate_contract->contract_refren) }}"
                                                alt="Image" style="max-width: 200px;">
                                        </a>
                                    </div>
                                @endif
                                <input type="file" name="contract_reference" class="form-control"
                                    id="contract_reference">
                                <small class="text-muted">Upload file baru jika ingin mengganti gambar yang
                                    ada</small>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="/rate-contract/astim/daywork-lcm" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div><!-- End Card with an image on left -->



            </div><!-- End sidebar recent posts-->

            </div>
            </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
