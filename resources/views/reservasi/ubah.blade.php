@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	UBAH RESERVASI
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
                                {!! Form::model($detilreservasi, ['route'=>['reservasi.simpanperubahan', $detilreservasi->ID_DETIL_RESERVASI], 'method'=> 'PATCH', 'role'=>'form'])  !!}
                                <form>
                                    <tr>
                                        <td width="200px">NAMA LENGKAP</td>
                                        <td>{{ $detilreservasi->reservasi->datadiri['NAMA'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KOTA</td>
                                        <td><select class="form-control" name="kota">
                                                @foreach ($kota as $data)
                                                    <option value="{{ $data->ID_KOTA }}" 
                                                        <?php if($data->ID_KOTA == $detilreservasi->reservasi['ID_KOTA']) echo "selected"; ?>>
                                                    {{ $data->NAMA_KOTA }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KAMAR</td>
                                        <td><select class="form-control" name="kamar">
                                                @foreach ($kamar as $data)
                                                    <option value="{{ $data->ID_KAMAR }}" <?php if($data->ID_KAMAR == $detilreservasi->reservasi['ID_KAMAR']) echo "selected"; ?>>
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
                                                    <option value="{{ $data->ID_TARIF }}"
                                                        <?php if($data->ID_TARIF == $detilreservasi->reservasi['ID_TARIF']) echo "selected"; ?>>
                                                    Rp. {{number_format($data->HARGA_TARIF, 2, ',', '.')}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TGL MULAI</td>
                                        <td><input type="date" class="form-control" name="tgl_mulai" value="{{  date('Y-m-d', strtotime($detilreservasi->reservasi['TGL_MENGINAP'])) }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">TGL SELESAI</td>
                                        <td><input type="date" class="form-control" name="tgl_selesai" value="{{  date('Y-m-d', strtotime($detilreservasi->reservasi['TGL_SELESAI'])) }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KATEGORI</td>
                                        <td>
                                            <input type="radio" name="kategori" id="optionsRadiosInline1" value="Personal"
                                                <?php if($detilreservasi->JENIS_TAMU == "Personal") echo "checked"; ?>> Personal &emsp;
                                            <input type="radio" name="kategori" id="optionsRadiosInline2" value="Grup"
                                                <?php if($detilreservasi->JENIS_TAMU == "Grup") echo "checked"; ?>> Grup
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JUMLAH TAMU</td>
                                        <td>DEWASA : <input type="number" name="tamu_dewasa" value="{{ $detilreservasi->JUMLAH_DEWASA }}" required>
                                            ANAK : <input type="number" name="tamu_anak" value="{{ $detilreservasi->JUMLAH_ANAK }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JUMLAH KAMAR</td>
                                        <td><input type="number" name="jumlah_kamar" value="{{ $detilreservasi->JUMLAH_KAMAR }}" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                            <a href="{{ route('tamu.tampil') }}" class="btn btn-danger"> Batal</a>
                                        </td>
                                    </tr>
                                </form>
                                {!! Form::close() !!}
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