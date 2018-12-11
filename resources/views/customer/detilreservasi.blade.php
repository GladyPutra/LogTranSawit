@extends('layouts.masterCustomer')
@section('custom_css')
@endsection

@section('title')
    DETIL RESERVASI
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
    <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!--  -->
            </div>
            <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <a href="{{ route('customer.datareservasi') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a target="_blank" href="{{ route('customer.cetaknota', $reservasi->ID_BOOKING) }}" class="btn btn-success"><i class="fa fa-print"></i> Cetak Nota</a>
                </div>
                <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <?php 
                        $start = new DateTime($reservasi->reservasi['TGL_MENGINAP']);
                        $end = new DateTime($reservasi->reservasi['TGL_SELESAI']);
                        $interval = $start->diff($end)->days;
                    ?>
                    <thead>
                        <tr>
                            <th colspan="2">RESERVASI KAMAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">ID BOOKING</td>
                            <td>{{ $reservasi->ID_BOOKING }}</td>
                        </tr>
                        <tr>
                            <td width="200px">JENIS TAMU</td>
                            <td>{{ $reservasi->JENIS_TAMU }}</td>
                        </tr>
                        <tr>
                            <td width="200px">JUMLAH TAMU</td>
                            <td>{{ $reservasi->JUMLAH_TAMU }} orang, terdiri &emsp;Anak : {{ $reservasi->JUMLAH_ANAK }} orang &emsp; 
                                Dewasa : {{ $reservasi->JUMLAH_DEWASA }} orang</td>
                        </tr>
                        <tr>
                            <td width="200px">STATUS BATAL</td>
                            <td>{{ $reservasi->STATUS_BATAL }}</td>
                        </tr>
                        <tr>
                            <td width="200px">JUMLAH KAMAR</td>
                            <td>{{ $reservasi->JUMLAH_KAMAR }}</td>
                        </tr>
                        <tr>
                            <td width="200px">KOTA</td>
                            <td>{{ $reservasi->reservasi->kota['NAMA_KOTA'] }}</td>
                        </tr>
                        <tr>
                            <td>TGL RESERVASI</td>
                            <td>{{ date("d-M-Y h:m:s", strtotime($reservasi->reservasi['TGL_RESERVASI'])) }}</td>
                        </tr>
                        <tr>
                            <td>TGL PEMAKAIAN</td>
                            <td><small>Dari : {{ date("d-M-Y", strtotime($reservasi->reservasi['TGL_MENGINAP'])) }}</small>
                                <form action = "{{ route('customer.simpan_perubahan_reservasi') }}" method="post" role="form">
                                {{ csrf_field() }}
                                    <input type="hidden" value="{{ $reservasi->ID_BOOKING}}" name="id_booking">
                                    <input type="date" class="form-control" name="tgl_mulai" 
                                        value="{{  date('Y-m-d', strtotime($reservasi->reservasi['TGL_MENGINAP'])) }}"><br/>

                                <small>Sampai: {{ date("d-M-Y", strtotime($reservasi->reservasi['TGL_SELESAI'])) }}</small>
                                    <input type="date" class="form-control" name="tgl_selesai" 
                                        value="{{  date('Y-m-d', strtotime($reservasi->reservasi['TGL_SELESAI'])) }}">
                                    <br><button type="submit" class="btn btn-xs btn-primary"
                                        onclick="return confirm('Apakah Anda Ingin Mengubah Tanggal Pemesanan?');">
                                        <i class="fa fa-save fa-fw"></i> Ubah Tanggal</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>LAMA HARI</td>
                            <td>{{ $interval }} hari</td>
                        </tr>
                        <tr>
                            <td width="200px">TARIF EKSTRA ITEM</td>
                            <td>Rp. {{number_format($reservasi->reservasi->tarif['HARGA_TARIF'], 2, ',', '.')}}</td>
                        </tr>                        
                    </tbody>
                </table>
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="2">DATA DIRI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">NAMA KAMAR</td>
                            <td>{{ $reservasi->reservasi->datadiri['NAMA'] }}</td>
                        </tr>                        
                        <tr>
                            <td width="200px">NO. IDENTITAS</td>
                            <td>{{ $reservasi->reservasi->datadiri['NO_IDENTITAS'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">NAMA INSTITUSI</td>
                            <td>{{ $reservasi->reservasi->datadiri['NAMA_INSTITUSI'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">NO TELP</td>
                            <td>{{ $reservasi->reservasi->datadiri['NO_TELEPON'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td>{{ $reservasi->reservasi->datadiri['EMAIL'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">ALAMAT</td>
                            <td>{{ $reservasi->reservasi->datadiri['ALAMAT'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">JENIS KELAMIN</td>
                            <td>{{ $reservasi->reservasi->datadiri['JENIS_KELAMIN'] }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="2">DETIL KAMAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">NAMA KAMAR</td>
                            <td>{{ $reservasi->reservasi->kamar->detilkamar['NAMA_KAMAR'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">ID KAMAR</td>
                            <td>{{ $reservasi->reservasi->kamar['ID_KAMAR'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">TEMPAT TIDUR</td>
                            <td>{{ $reservasi->reservasi->kamar['TEMPAT_TIDUR'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">SMOKING</td>
                            <td>{{ $reservasi->reservasi->kamar['STAUS_SMOKING'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">TEMPAT TIDUR</td>
                            <td>{{ $reservasi->reservasi->kamar['STATUS_BOOKING'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">FASILITAS KAMAR</td>
                            <td>{{ $reservasi->reservasi->kamar->detilkamar['FASILITAS'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">SEASON KAMAR</td>
                            <td>{{ $reservasi->reservasi->kamar->tarifkamar->season['NAMA_SEASON'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">HARGA KAMAR</td>
                            <td>Rp. {{number_format($reservasi->reservasi->kamar->tarifkamar['HARGA_KAMAR'], 2, ',', '.')}}/hari</td>
                        </tr>
                        <!-- <tr>
                            <td width="200px">TANGGAL KAMAR</td>
                            <td>Tgl. Mulai: {{$reservasi->reservasi->kamar->tarifkamar['TGL_MULAI'] }} 
                                &emsp;Tgl. Selesai: {{$reservasi->reservasi->kamar->tarifkamar['TGL_SELESAI'] }}</td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection