@extends('layouts.masterCustomerCopy')
@section('custom_css')
@endsection

@section('title')
	DATA RESERVASI
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
                            <form action = "{{ route('reservasinonlogin.simpan') }}" method="post" role="form">
                                {{ csrf_field() }}
                                <thead>
                                    <tr>
                                        <th colspan="2">DATA DIRI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="200px">NAMA LENGKAP</td>
                                        <td width="300px"><input class="form-control" name="nama" value="{{ old('nama') }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NO. IDENTITAS</td>
                                        <td width="300px"><input class="form-control" name="no_identitas" value="{{ old('no_identitas') }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JENIS KELAMIN</td>
                                        <td width="300px">
                                            <input type="radio" name="kelamin" id="optionsRadiosInline1" value="Laki-laki" checked> Laki-laki &emsp;
                                            <input type="radio" name="kelamin" id="optionsRadiosInline2" value="Perempuan"> Perempuan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NAMA INSTITUSI</td>
                                        <td width="300px"><input class="form-control" name="institusi" value="{{ old('institusi') }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NO. TELP</td>
                                        <td width="300px"><input class="form-control" name="telp" value="{{ old('telp') }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">EMAIL</td>
                                        <td width="300px"><input class="form-control" name="email" value="{{ old('email') }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">ALAMAT</td>
                                        <td width="300px"><textarea class="form-control" name="alamat" required>{{ old('alamat') }}</textarea></td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="2">DATA RESERVASI</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <td width="200px">TARIF</td>
                                        <td><select class="form-control" name="tarif">
                                                @foreach ($tarif as $data)
                                                    <option value="{{ $data->ID_TARIF }}">Rp. {{number_format($data->HARGA_TARIF, 2, ',', '.')}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                        <td width="200px">TGL MULAI</td>
                                        <td><input type="date" class="form-control" name="tgl_mulai" value="{{ old('tgl_mulai') }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TGL SELESAI</td>
                                        <td><input type="date" class="form-control" name="tgl_selesai" value="{{ old('tgl_selesai') }}" required></td>
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
                                            <a href="{{ route('home') }}" class="btn btn-danger"> Batal</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
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