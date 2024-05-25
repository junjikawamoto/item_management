<!DOCTYPE html>
<html>
<head>
    <title>ファイルアップロード</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>ファイルアップロード</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <br>
            <strong>アップロードされたファイル:</strong> {{ session('file') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">ファイルを選択</label>
            <input type="file" name="file" class="form-control" required>
            @if($errors->has('file'))
                <span class="text-danger">{{ $errors->first('file') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">アップロード</button>
    </form>
</div>
</body>
</html>
