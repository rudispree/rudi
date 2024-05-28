@php 
function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }

@endphp

@foreach ($presensi as $d)
@php
    $foto_in  = Storage::url('uploads/absensi/'.$d->foto_in);
    $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
@endphp

<tr>
    <td> {{ $loop->iteration }}</td>
    <td> {{ $d->nik }} </td>
    <td>{{ $d->nama_lengkap}} </td>
    <td>{{ $d->kode_dept}} </td>
    <td>{{$d->nama_jam_kerja}} ({{ $d->jam_masuk}} s/d {{$d->jam_pulang}})</td>
    <td>{{ $d->jam_in}} </td>
    <td>
        <img src="{{ url($foto_in)}}" class="img-circle img-bordered-sm" alt="" width="60" height="60">    
    </td>
    <!-- <td>{{ $d->jam_out !== null ? $d->jam_out : 'Belum Absen' }}</td>  -->
    <td>{!! $d->jam_out !== null ? $d->jam_out : '<span class="badge bg-danger">Belum Absen</span>' !!}</td> 
    <td>
        @if ($d->jam_out !== null)
            <img src="{{ url($foto_out) }}"   class="img-circle img-bordered-sm" alt="" width="60" height="60"> 
        @else
        <i class="fa fa-hourglass-start" aria-hidden="true"></i>
        @endif
    </td>
    <td>
        @if ($d->jam_in >=  $d->jam_masuk)
        @php
        $jamterlambat = selisih($d->jam_masuk,$d->jam_in);
        @endphp
        <span class="badge bg-danger">Terlambat {{ $jamterlambat}}</span>
        @else
        <span class="badge bg-success">Tepat Waktu</span>
        @endif 
    </td>
    <td>
        <a href="#" class="btn btn-primary tampilkanpeta" > <i class="fa fa-map" aria-hidden="true"></i></a>
        
    </td>

</tr>
@endforeach



<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>

<!-- <script type="text/javascript">
  $(function(){
      $(".tampilkanpeta").click(function(e) {
         //alert('test');
         $("#modal-tampilkanpeta").modal("show");
      });
    });

</script> -->

<script type="text/javascript">
$(window).load(function() {
    $(".tampilkanpeta").click(function(e) {
         //alert('test');
         $("#modal-tampilkanpeta").modal("show");
      });
});
</script>


