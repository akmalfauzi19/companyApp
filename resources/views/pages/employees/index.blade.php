@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        @include('layouts.notification')
    </div>
    <div class="container">
        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary ">
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
                            <th scope="col">Company</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($employees->currentpage()-1)* $employees->perpage() + 1;@endphp
                        @foreach ($employees as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->companies->name }}</td>
                                <td style="text-align: center;">
                                    <div style="display:inline-flex;">
                                        <a href="{{ route('employees.index') }}/{{ $item->id }}/edit"
                                            data-toggle='tooltip' class="float-left btn btn-sm btn-primary rounded-pill">
                                            Edit
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <form action="{{ route('employees.index') }}/{{ $item->id }}" method="POST">
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
                {{ $employees->links() }}
            </div>
        </div>
    </div>

@endsection
