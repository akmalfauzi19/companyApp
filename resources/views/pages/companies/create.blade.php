@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12" style="position: center;">
            <div class=" card">
                <div class="card-header">
                    <h4 class="card-title">Create Companies</h4>
                </div>
                <form action="{{ route('companies.store') }}" method="POST" class="form-group"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-md-12 form-group">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control  @error('logo') is-invalid @enderror">
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control  @error('website') is-invalid @enderror">
                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8form-group">
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </form>
            </div>
        </div>

    </div>

@endsection
