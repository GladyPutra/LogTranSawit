@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	KONFIRMASI PEMBAYARAN
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
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <tbody>
                                <form action = "{{ route('reservasi.simpankonfirmasi') }}" method="post" role="form">
                                {{ csrf_field() }}
                                    <tr>
                                        <td width="200px">ID BOOKING</td>
                                        <td><input class="form-control" value="{{ $transaksi->ID_BOOKING }}" readonly="">
                                            <input type="hidden" name="id_booking" value="{{ $transaksi->ID_BOOKING }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JENIS PEMBAYARAN</td>
                                        <td>
                                            <input type="radio" name="pembayaran" id="optionsRadiosInline1" value="Transfer"> Transfer &emsp;
                                            <input type="radio" name="pembayaran" id="optionsRadiosInline2" value="Kredit"> Kredit
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NO. KARTU KREDIT</td>
                                        <td><input class="form-control" name="rekening" value="{{ old('rekening') }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">STATUS PEMBAYARAN</td>
                                        <td><input type="checkbox" name="statusbayar" value="LUNAS"> LUNAS</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                            <a href="{{ route('reservasi.tampil') }}" class="btn btn-danger"> Batal</a>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
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