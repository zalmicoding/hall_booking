@extends('admin.dashboard')

@section('body-title')
    <h2>Manage User</h2>
@endsection

@section('body-upper-content')
@if (Session::has('couple_deleted'))
<div class="alert alert-success" role="alert">
    <strong>{{ Session::get('couple_deleted') }}</strong>
</div>
@endif
<div class="card-shadow">
    <div class="card-shadow-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Wedding Date</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">No .of Guest</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($couples as $couple)
                    <tr>
                        <td scope="row">{{ $couple['name'] }}</td>
                        <td>11/12/2020</td>
                        <td>{{ $couple['email'] }}</td>
                        <td>{{ $couple->profile->contact }}</td>
                        <td>250</td>
                        <td>$950</td>
                        <td>
                            <a href="{{ route('admin.delete.user', $couple['id']) }}" class="action-links">
                                <lord-icon
                                src="https://cdn.lordicon.com/qsloqzpf.json"
                                trigger="loop"
                                colors="primary:#121331"
                                state="hover-empty"
                                style="width:25px;height:25px">
                                </lord-icon>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $couples->links() }}
@endsection
