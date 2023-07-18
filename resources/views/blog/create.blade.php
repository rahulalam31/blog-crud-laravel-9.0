<x-app-layout>
<div class="container">
    <form action="{{ route('storeBlog') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <input type="text" name="content"  required/>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

</x-app-layout>
