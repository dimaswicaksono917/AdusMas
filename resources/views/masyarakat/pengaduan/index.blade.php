@extends('_layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Pengaduan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pengaduanku</h4>
                        <a href="{{route('masyarakat.pengaduan.create')}}" class="btn btn-sm btn-primary">+ Buat Pengaduan</a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <span>Berdasarkan data yang kami kelola kamu telah membuat pengaduan sebanyak
                                {{ $pengaduan }}</span>
                        </div>
                        <div class="table table-responsive">
                            <table class="table" id="data-table">
                                <thead>
                                    <th>Pengaduan</th>
                                    <th>Dibuat tanggal</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            initiateDatatable();
        })

        function initiateDatatable() {
            $('#data-table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                autoWidth: false,
                ordering: false,
                ajax: '{{ route('masyarakat.get-pengaduan') }}',
                columns: [
                    {
                        data: 'isi_laporan'
                    },
                    {
                        data: 'tgl_pengaduan'
                    },
                    {
                        data: 'foto'
                    },
                    {
                        data: 'status'
                    }
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari Data",
                    lengthMenu: "Tampilkan _MENU_ baris",
                    zeroRecords: "Tidak ada data",
                    infoEmpty: "Menampilkan 0 - 0 (0 data)",
                    infoFiltered: "(Difilter dari _MAX_ total data)",
                    info: "Menampilkan _START_ - _END_ (_TOTAL_ data)",
                    paginate: {
                        previous: '<i class="fa fa-angle-left"></i>',
                        next: "<i class='fa fa-angle-right'></i>",
                    }
                },
            })
        }
    </script>
@endsection
