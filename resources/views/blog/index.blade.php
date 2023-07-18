


<x-app-layout>
    <div class="container">
        <a href="{{ route('createBlog') }}" class="btn btn-primary">Add Blog</a>
    @foreach ($blogs as $blog)

    <div class="container py-12">
        <h4>{{$blog->title}}</h4> by: <p>{{$blog->user->name}}</p>

        <div class="p-6 text-gray-900">
            <p>{{$blog->content}}</p>
        </div>
    </div>
    <h4>Comments:</h4>
    @foreach ($blog->comments as $comment)

    <p>Name: {{$comment->name}}</p>
    <p>Email: {{$comment->email}}</p>
    <p>Comment: {{$comment->comment}}</p>

    @endforeach
    <a href="{{ url('post/'.$blog->id.'/edit') }}" class="btn btn-primary">Edit Blog</a>
    <a href="{{ url('post/'.$blog->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete Blog</a>

<form method="POST" action="{{ url('comment/'.$blog->id) }}">
    @csrf
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" name="name" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Email Address Optional</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Comments</label>
    <input type="text" name="comment" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    @endforeach

    </div>

</x-app-layout>
