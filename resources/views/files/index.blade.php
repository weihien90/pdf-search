@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($files as $file)
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $file->name }}</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('files.show', $file) }}"><i class="fa fa-file-pdf-o"></i></a>
                            <a href="{{ route('files.edit', $file) }}"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('files.destroy', $file) }}"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>

                    <div class="box-body">
                        {{ $file->content }}...
                    </div>

                    <div class="box-footer">
                        {{ $file->description }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
