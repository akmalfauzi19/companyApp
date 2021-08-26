@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        @include('layouts.notification')
    </div>
    <div class="container">
        <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary ">
            Create
        </a>
        <div class="row justify-content-center">

            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">logo</th>
                            <th scope="col">Website</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($companies->currentpage()-1)* $companies->perpage() + 1;@endphp
                        @foreach ($companies as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <img src="{{ url('images/company/' . $item->logo) }}"
                                        alt="companies-{{ $item->name }}" style="max-height: 100px; max-width: 100px;">

                                </td>
                                <td>{{ $item->website }}</td>
                                <td style="text-align: center;">
                                    <div style="display:inline-flex;">
                                        <a href="{{ route('companies.index') }}/{{ $item->id }}/edit"
                                            data-toggle='tooltip' class="float-left btn btn-sm btn-primary rounded-pill">
                                            Edit
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <form action="{{ route('companies.index') }}/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="dltBtn float-right btn btn-sm btn-danger rounded-pill"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                {{ $companies->links() }}
            </div>
        </div>
    </div>

@endsection
