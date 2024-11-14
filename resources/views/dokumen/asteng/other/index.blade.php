@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dokumen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Other</li>

            </ol>
        </nav>

        <a href="/dokumen/asteng/other/tambah" type="button" class="btn btn-success">Tambah</a>
        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>
                        <b>No</b>
                    </th>
                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                        $No = 1;
                    ?>
                @foreach($dokumenother as $item)
                    <tr>

                        <td>{{ $No++ }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ url('dokumen/asteng/other/detail/'.$item->id) }}"
                                type="button" class="btn btn-primary">Detail</a>

                            <form
                                action="{{ url('/dokumen/asteng/other/delete/'.$item->id) }}"
                                method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                <!-- End Table with stripped rows -->

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-5">
                <div class="row">

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

</main>
<!-- End #main -->
@endsection
