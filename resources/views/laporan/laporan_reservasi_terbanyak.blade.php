@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
    LAPORAN JUMLAH DENGAN RESERVASI TERBANYAK
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
                    
                    @if($laporan->count())
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA PELANGGAN</th>
                                <th>JUMLAH RESERVASI</th>
                            </tr>
                            </thead>
                            <?php $no = 0; ?>
                            @foreach($laporan as $data)
                                <?php $no++; ?>
                                <tbody>
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $data->NAMA }}</td>
                                    <td align="center">{{ $data->TOTAL }}</td>
                                    
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