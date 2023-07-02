<div class="form-group row">
    {!! Form::label('provinsi_id', 'Provinsi ID', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('provinsi_id', null, ['class' => 'form-control ' . ($errors->has('provinsi_id') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('provinsi_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('provinsi', 'Provinsi', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('provinsi', null, ['class' => 'form-control ' . ($errors->has('provinsi') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('provinsi', '<p class="help-block">:message</p>') !!}
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
