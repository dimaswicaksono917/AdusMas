@extends('_layouts.admin')
@section('page_title', 'Masyarakat Terverifikasi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                
                <div class="card-body">
                    <table class="table" id="data-table">
                        <thead>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Nomor telepon</th>
                            <th>Registrasi pada</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                ajax: '{{ route('admin.get-verif') }}',
                columns: [{
                        data: 'nik'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telp'
                    },
                    {
                        data: 'created_at'
                    }
                ],
                // language: {
                //     search: "_INPUT_",
                //     searchPlaceholder: "Cari Data",
                //     lengthMenu: "Tampilkan _MENU_ baris",
                //     zeroRecords: "Tidak ada data",
                //     infoEmpty: "Menampilkan 0 - 0 (0 data)",
                //     infoFiltered: "(Difilter dari _MAX_ total data)",
                //     info: "Menampilkan _START_ - _END_ (_TOTAL_ data)",
                //     paginate: {
                //         previous: '<i class="fa fa-angle-left"></i>',
                //         next: "<i class='fa fa-angle-right'></i>",
                //     }
                // },
            })
        }
    </script>
@endsection
