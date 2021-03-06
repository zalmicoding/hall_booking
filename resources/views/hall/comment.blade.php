@extends('hall.dashboard')

@section('body-title')
    <h2>Comments</h2>
@endsection

@section('body-upper-content')
@if (Session::has('comment_deleted'))
<div class="alert alert-success" role="alert">
    <strong>{{ Session::get('comment_deleted') }}</strong>
</div>
@endif
<div class="card-shadow">
    <div class="card-shadow-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Hall Name</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($halls as $comment)
                        @foreach ($comment->comments as $comm)
                            @php
                                $comment_id = $comm->id;
                                $hall_id = $comm->hall_id;
                                $hall_name = $comm->hall_name;
                            @endphp
                        <tr>
                            <td>{{ $comm['username'] }}</td>
                            <td>{{ $comm['hall_name'] }}</td>
                            <td>{{ $comm['comment'] }}</td>
                            <td>
                                <a style="color: #17a2b8"
                                data-name="{{ $comm['username'] }}"
                                data-id="{{ $comm['id'] }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                class="myReplyModalBtn"
                                title="Reply">
                                <i class="fa fa-reply"></i>
                            </a> |
                                <a href="{{ route('hall.reply', $comm['id']) }}"
                                style="color: #17a2b8"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Replies">
                                    <i class="fa fa-reply-all"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reply User's Message</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form class="myModalForm" action="{{ route('hall.reply.create', $comment_id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Message Reply To</label>
                                                <input type="text" class="form-control" id="contact_username" name="comment_username">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="contact_id" name="comment_id">
                                                <input type="hidden" name="hall_id" value="{{ $hall_id }}">
                                                <input type="hidden" name="hall_name" value="{{ $hall_name }}">
                                                <input type="text" id="contactReply" name="reply" class="form-control" placeholder="Enter reply here" required>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $halls->links() }}
@endsection
