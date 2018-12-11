@extends('layouts.master')
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
                    <a href="{{ route('reservasi.tampil') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="{{ route('reservasi.konfirmasi', $reservasi->ID_BOOKING) }}" class="btn btn-success"><i class="fa fa-money"></i> Konfirmasi Pembayaran</a>
                </div>
                <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                <?php 
                    $hargaKamar = $reservasi->reservasi->kamar->tarifkamar['HARGA_KAMAR'] * $reservasi->JUMLAH_KAMAR;
                    $tarifPaket = $reservasi->reservasi->tarif['HARGA_TARIF'];
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
                            <td>TANGGAL RESERVASI</td>
                            <td>{{ date("d-M-Y h:m:s", strtotime($reservasi->reservasi['TGL_RESERVASI'])) }}</td>
                        </tr>
                        <tr>
                            <td>TANGGAL PEMAKAIAN</td>
                            <td>{{ date("d-M-Y", strtotime($reservasi->reservasi['TGL_MENGINAP'])) }} s/d
                                {{ date("d-M-Y", strtotime($reservasi->reservasi['TGL_SELESAI'])) }} ( {{ $interval }} hari )
                            </td>
                        </tr>
                        <tr>
                            <td width="200px">TARIF PAKET</td>
                            <td>Rp. {{number_format($tarifPaket, 2, ',', '.')}}</td>
                        </tr> 
                        <tr>
                            <td width="200px">STATUS PEMBAYARAN</td>
                            <td>{{ $reservasi->reservasi->transaksi['JENIS_STATUS'] }}</td>
                        </tr> 
                    </tbody>
                </table>

                @if($paket->count())
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="4">PAKET TAMBAHAN</th>
                        </tr>
                        <tr>
                            <th>NAMA ITEM</th>
                            <th>HARGA</th>
                            <th>JUMLAH</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($paket as $data)
                        <tr>
                            <td>{{ $data->item['NAMA_ITEM'] }}</td>
                            <td align="right">Rp. {{number_format($data->item['HARGA_ITEM'], 2, ',', '.')}}</td>
                            <td>{{ $data->JUMLAH_ITEM }}</td>
                            <td align="right">Rp. {{number_format($data->item['HARGA_ITEM'] * $data->JUMLAH_ITEM, 2, ',', '.')}}</td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
                @endif

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
                            <td width="200px">STATUS BOOKING</td>
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
                            <td>Rp. {{number_format($hargaKamar, 2, ',', '.')}}/hari x {{ $interval }} hari = {{number_format($hargaKamar * $interval, 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right" style="font-weight: bold;">TOTAL TRANSAKSI: Rp. {{number_format($reservasi->reservasi->transaksi['JUMLAH_TARIF'], 2, ',', '.')}}</td>
                        </tr>
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