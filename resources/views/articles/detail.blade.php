@extends("layouts.app")

@section("content")
    <div class="container">

        <div class="card border-1 border-primary mb-3">
            <div class="card-body">
                <h3>{{ $article->title }}</h3>
                <small class="text-muted">
                    {{ $article->created_at->diffForHumans() }}
                    <b class="text-success"> Category: {{ $article->category->name }} </b>
                </small>
                <div>{{ $article->body }}</div>
            </div>
            <div class="card-footer">
                <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-danger btn-sm me-2">Delete</a>
                <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-primary btn-sm">Edit</a>
            </div>
        </div>

        <h4 class="h5 ms-1 mt-5">Comments ({{ count($article->comments) }})</h4>
        <ul class="list-group">
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}"
                        class="btn-close btn-close-success float-end" aria-label="Close"></a>
                        <div>
                            <small>
                                <b class="text-success">
                                    {{ $comment->user->name }}
                                </b>
                                {{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>

        @auth
        <form action="{{ url("/comments/add") }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id}}">
            <textarea name="content" class="form-control my-2"></textarea>
            <button class="btn btn-success">Add Comment</button>
        </form>
        @endauth

    </div>
@endsection
