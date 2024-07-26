<div class="">
    <input type="text" name="title" id="title" value="{{ old('title',optional($post ?? null)->title) }}" class="form-control" placeholder="enter title">
    <div>
        @error('title')

        {{ $message }}

        @enderror
    </div>
</div>
<div class="my-3">
    <textarea name="content" id="content" class="form-control" placeholder="enter content">
    {{ old('content',optional($post ?? null)->content) }}
    </textarea>
    <div>
        @error('content')

        {{ $message }}

        @enderror
    </div>
</div>

<div class="my-3">
    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" placeholder="upload file">
    <div>
        @error('thumbnail')

        {{ $message }}

        @enderror
    </div>
</div>