@extends('layouts.masterCustomer')
@section('custom_css')
@endsection

@section('title')
    NOTA RESERVASI
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
    <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ route('customer.print', 'UnduhReservasi') }}" class="btn btn-primary"><i class="fa fa-download"></i> Unduh</a>
                <a href="{{ route('customer.print', 'PrintReservasi') }}" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
            </div>
            <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <label>Tanggal : {{ DATE('d-M-Y') }}</label>
                </div>
                <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="2">TANDA TERIMA PEMESANAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">ID BOOKING</td>
                            <td>{{ $reservasi->ID_BOOKING }}</td>
                        </tr>
                        <tr>
                            <td width="200px">NAMA</td>
                            <td>{{ $reservasi->datadiri['NAMA'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">ALAMAT</td>
                            <td>{{ $reservasi->datadiri['ALAMAT'] }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="2" align="center">DETIL PEMESANAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">Check In</td>
                            <td><?php if(!empty($reservasi->checkinout)) echo date("d-M-Y", strtotime($reservasi->checkinout['TGL_CHECKIN']));?></td>
                        </tr>                        
                        <tr>
                            <td width="200px">Check Out</td>
                            <td><?php if(!empty($reservasi->checkinout)) echo date("d-M-Y", strtotime($reservasi->checkinout['TGL_CHECKOUT']));?></td>
                        </tr>
                        <tr>
                            <td width="200px">Dewasa</td>
                            <td>{{ $reservasi->detilreservasi['JUMLAH_DEWASA'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">Anak-Anak</td>
                            <td>{{ $reservasi->detilreservasi['JUMLAH_ANAK'] }}</td>
                        </tr>
                        <tr>
                            <td width="200px">Tgl Pembayaran</td>
                            <td>{{ date("d-M-Y", strtotime($reservasi->transaksi['TGL_TRANSAKSI'])) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive">
                @if($reservasi->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th colspan="5"></th>
                        </tr>
                        <tr>
                            <th>JENIS KAMAR</th>
                            <th>BED</th>
                            <th>JUMLAH</th>
                            <th>HARGA</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        </thead>
                        <?php $total = 0; ?>
                        @foreach($kamar as $data)
                        <tbody>
                        <tr>
                            <?php 
                                $subtotal = $data->tarifkamar['HARGA_KAMAR'] * $data->reservasi->detilreservasi['JUMLAH_KAMAR'];
                                $start = new DateTime($data->reservasi['TGL_MENGINAP']);
                                $end = new DateTime($data->reservasi['TGL_SELESAI']);
                                $interval = $start->diff($end)->days;
                            ?>
                            <td>{{ $data->detilkamar['NAMA_KAMAR'] }}</td>
                            <td>{{ $data->TEMPAT_TIDUR }}</td>
                            <td>{{ $data->reservasi->detilreservasi['JUMLAH_KAMAR'] }} x {{ $interval }} hari</td>
                            <td align="right">Rp. {{number_format($data->tarifkamar['HARGA_KAMAR'], 2, ',', '.')}}</td>
                            <td align="right">Rp. {{number_format($interval * $subtotal, 2, ',', '.')}}</td>
                        </tr>
                        </tbody>
                        @endforeach

                        <thead>
                        <tr>
                            <th colspan="5">EKSTRA ITEM</th>
                        </tr>
                        <tr>
                            <th colspan="2">ITEM</th>
                            <th>JUMLAH</th>
                            <th>HARGA</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        </thead>
                        @foreach($ekstraitem as $data2)
                        <tbody>
                            <tr>
                                <td colspan="2">{{ $data2->ID_ITEM }}. {{ $data2->item['NAMA_ITEM'] }}</td>
                                <td>{{ $data2->JUMLAH_ITEM }}</td>
                                <td align="right">Rp. {{number_format($data2->item['HARGA_ITEM'], 2, ',', '.')}}</td>
                                <td align="right">Rp. {{number_format($data2->JUMLAH_ITEM * $data2->item['HARGA_ITEM'], 2, ',', '.')}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                        <tr>
                            <td colspan="4" align="right">TOTAL</td>
                            <td align="right" style="font-weight: bold;">Rp. {{number_format($data->reservasi->transaksi['JUMLAH_TARIF'], 2, ',', '.')}}</td>
                        </tr>
                    </table>
                </div>
                @endif
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection