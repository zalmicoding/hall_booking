@extends('hall.dashboard')




@section('body-upper-content')
@section('body-title','Hall')

<a href="{{route('Halls.create')}}"  class="btn btn-warning">
    Add Hall
</a>
<div class="card-shadow">
    <div class="card-shadow-body p-0">
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-hover mb-0">
                @if (Session::has('success'))
                <p class="alert alert-success">{{session('success')}}</p>

                @endif
                @if (Session::has('massage'))
                <p class="alert alert-danger">{{session('massage')}}</p>

                @endif

                <thead class="">
                    <tr>


                        <th scope="col">ID</th>

                        <th scope="col">title</th>
                        <th scope="col">images</th>
                        <th scope="col">delete</th>

                        <th scope="col">edit</th>



                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $hall)


                    <tr>
                        <td>{{$hall->id}}</td>

                        <td>{{$hall->title}}</td>

                        <td>
                            {{--Fetch images here --}}
                        </td>

                        <td class="rounded-sm">

                            <form method="post" action="{{ route('hallcategory.destroy', $hall->id) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                            </form>

                        </td>
                        <td> <a href="{{route('hallcategory.edit',$hall->id)}}" class="action-links btn btn-primary btn-sm" >Edit</a></td>



                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

