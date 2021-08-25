@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12" style="position: center;">
            <div class=" card">
                <div class="card-header">
                    <h4 class="card-title">Create employees</h4>
                </div>
                <form action="{{ route('employees.store') }}" method="POST" class="form-group"
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
                        <label class="form-label">Company</label>
                        <select name="company_id" id="companies"
                            class="form-control @error('company_id') is-invalid @enderror">
                            @foreach ($companies as $id => $item)
                                <option value="{{ $id }}">
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
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
