<div class="form-group row">
    {!! Form::label('nama_kategori', 'Nama Kategori', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('nama_kategori', null, ['class' => 'form-control ' . ($errors->has('nama_kategori') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('nama_kategori', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.text-editor'
        });
    </script>
@endpush
