<div class="form-group row">
    {!! Form::label('kabupaten_id', 'Kabupaten ID', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kabupaten_id', null, ['class' => 'form-control ' . ($errors->has('kabupaten_id') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kabupaten_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kabupaten', 'Kabupaten', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kabupaten', null, ['class' => 'form-control ' . ($errors->has('kabupaten') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kabupaten', '<p class="help-block">:message</p>') !!}
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
