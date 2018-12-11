@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	TAMBAH RESERVASI
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
                            <thead>
                                <tr>
                                    <th colspan="2">DATA DIRI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action = "{{ route('reservasi.simpan') }}" method="post" role="form">
                                {{ csrf_field() }}
                                    <tr>
                                        <td width="200px">NAMA LENGKAP</td>
                                        <td>{{ $customer->NAMA }}<input type="hidden" name="id_data_diri" value="{{ $customer->ID_DATA_DIRI }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KOTA</td>
                                        <td><select class="form-control" name="kota">
                                                @foreach ($kota as $data)
                                                    <option value="{{ $data->ID_KOTA }}">{{ $data->NAMA_KOTA }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KAMAR</td>
                                        <td><select class="form-control" name="kamar">
                                                @foreach ($kamar as $data)
                                                    <option value="{{ $data->ID_KAMAR }}">
                                                        <?php 
                                                        echo $data->ID_KAMAR .' ('. $data->detilkamar['NAMA_KAMAR'] . ')' .
                                                            ' ; Tempat Tidur: '. $data->TEMPAT_TIDUR .
                                                            ' ; Smoking: '. $data->STAUS_SMOKING
                                                        ; ?>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TARIF PAKET</td>
                                        <td><select class="form-control" name="tarif">
                                                <option value="0">Tanpa Paket</option>
                                                @foreach ($tarif as $data)
                                                    <option value="{{ $data->ID_TARIF }}">Rp. {{number_format($data->HARGA_TARIF, 2, ',', '.')}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TGL MULAI</td>
                                        <td><input type="date" class="form-control" name="tgl_mulai" value="{{ old('tgl_mulai') }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TGL SELESAI</td>
                                        <td><input type="date" class="form-control" name="tgl_selesai" value="{{ old('tgl_selesai') }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KATEGORI</td>
                                        <td>
                                            <input type="radio" name="kategori" id="optionsRadiosInline1" value="Personal" checked> Personal &emsp;
                                            <input type="radio" name="kategori" id="optionsRadiosInline2" value="Grup"> Grup
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JUMLAH TAMU</td>
                                        <td>DEWASA : <input type="number" name="tamu_dewasa" value="0" required>
                                            ANAK : <input type="number" name="tamu_anak" value="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JUMLAH KAMAR</td>
                                        <td><input type="number" name="jumlah_kamar" value="0" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                            <a href="{{ route('tamu.tampil') }}" class="btn btn-danger"> Batal</a>
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