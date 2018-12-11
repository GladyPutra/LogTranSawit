@extends('layouts.masterCustomerCopy')
@section('custom_css')
@endsection

@section('title')
	LENGKAPI DATA DIRI
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
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="2">DATA DIRI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action = "{{ route('customer.simpan') }}" method="post" role="form">
                                        {{ csrf_field() }}
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
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
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