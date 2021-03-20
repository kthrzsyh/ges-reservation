@extends('admin.base')
@section('content')

<a href="/admin/event/add" class="btn btn-primary mb-1">Tambah Event</a>
<table border="1" id="table">
    <tr>
        <th>Nama Event</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
        <th>Kuota</th>
        <th>Expired</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Hari</th>
        <th colspan="2">Action</th>
    </tr>
    @foreach($event as $eventAja)
    <tr>
        <td>{{$eventAja->nama}}</td>
        <td>{{$eventAja->deskripsi}}</td>
        <td>{{$eventAja->tanggal}}</td>
        <td>{{$eventAja->kuota}}</td>
        <td>{{$eventAja->expired}}</td>
        <td>{{$eventAja->jam_mulai}}</td>
        <td>{{$eventAja->jam_selesai}}</td>
        <td>{{$eventAja->hari}}</td>
        <td><button class="btn btn-hapus" id="HapusData" data-id='{{$eventAja->id}}'>Hapus</button></td>
        <td><a href="/admin/event/edit/{{$eventAja->id}}" id="DetailData" data-id='{{$eventAja->id}}'>Detail</a></td>
    </tr>
    @endforeach
</table>


@endsection

@section('js')
<script>
    $(document).ready(function() {
        // $('#table').DataTable();
        $('.btn-hapus').on("click", function() {
            console.log('test');

            let id = this.dataset.id;
            var isconfirm = confirm('Yakin Hapus Data?');
            if (isconfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/admin/event/delete/" + id,
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(result) {
                        console.log("Sukses Menghapus!")
                        alert("Hapus Berhasil!");
                        window.location.reload();
                    },
                    error: function(e) {
                        console.log("Error" + e)
                    }
                });
            }


            // alert("Hapus Berhasil dengan ID!" + id);
        })
    });
</script>
@endsection