@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12" style="position: center;">
            <div class=" card">
                <div class="card-header">
                    <h4 class="card-title">Edit Companies</h4>
                </div>
                <form action="{{ route('companies.update', $companies->id) }}" method="POST" class="form-group"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12 form-group">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control " value="{{ $companies->name }}" @error('name')
                            is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control " value="{{ $companies->email }}"
                            @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control @error('logo')
                                                is-invalid @enderror" value=" {{ $companies->logo }}">
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <img src="{{ url('images/company/' . $companies->logo) }}"
                            alt="companies-{{ $companies->name }}" style="max-height: 100px; max-width: 100px;">
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control " value="{{ $companies->website }}"
                            @error('website') is-invalid @enderror">
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
