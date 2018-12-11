@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
    LAPORAN PENDAPATAN PER JENIS TAMU
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!--  -->
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    {!! Form::open(['method'=>'GET','route'=>'filterlaporan.LaporanPendapatanPerJenisTamu'])  !!}
                        <div class="col-sm-4 col-xs-8 form-group pull-left input-group">
                            <input type="number" name="tahun" class="form-control" value="{{ $tahun }}" onChange="this.form.submit()">
                        </div>
                    {!! Form::close() !!}
                    
                    @if($laporan->count())
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>BULAN</th>
                                <th>JUMLAH TARIF</th>
                                <th>JENIS TAMU</th>
                            </tr>
                            </thead>
                            <?php $no = 0; ?>
                            @foreach($laporan as $data)
                                <?php $no++; ?>
                                <tbody>
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ date("F", strtotime($data->TGL_TRANSAKSI)) }}</td>
                                    <td align="right">{{number_format($data->JUMLAH_TARIF, 2, ',', '.')}}</td>
                                    <td>{{ $data->detilreservasi['JENIS_TAMU'] }}</td>
                                    
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <div class="alert">
                            <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form Elements -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection