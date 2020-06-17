@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    <div class="comments_panel">
                        <div class="comments">
                        @foreach($comments as $commentObj)
                            <div class="row">
                                <div class="col-7 {{ Auth::user()->username == $commentObj['user']['username'] ? 'offset-5':'' }}">
                                    <div class="comment_container">
                                        <input type="hidden" name="comment_id" class="comment_id" value="{{ $commentObj['id'] }}">
                                        @if ( \Auth::user()->username == $commentObj['user']['username'] )
                                            <div class="comment_container_actions">
                                                <div class="del"><i class="fas fa-times-circle"></i></div>
                                            </div>
                                        @endif
                                        <div class="comment_main">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="comment_by"><i class="fas fa-user"></i> {{ $commentObj['user']['username'] }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="comment">{{ $commentObj['comment'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment_info">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="comment_like_count">
                                                    @if ( array_search(Auth::id(), array_column($commentObj['likes'], 'user_id')) !== false )
                                                        <i class="fas fa-thumbs-up" title="You{{ ($commentObj['likes_count'] > 1 ) ? ' and '. ($commentObj['likes_count']-1) .' other' : '' }} liked this comment"></i>
                                                    @else
                                                        <button type="button" class="like_button" ><i class="far fa-thumbs-up"></i></button>
                                                    @endif 
                                                    {{ $commentObj['likes_count'] }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="comment_date"><i class="far fa-calendar-alt"></i> {{ $commentObj['created_at'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="create_comment">
                            <form method="post" action="{{ route('comments.save') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <textarea id="add_comment" name="comment" class="form-control"></textarea>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary">Add Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection