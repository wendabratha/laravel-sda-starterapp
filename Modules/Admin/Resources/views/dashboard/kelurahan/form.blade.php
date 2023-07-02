<div class="form-group row">
    {!! Form::label('kelurahan_id', 'Kelurahan ID', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kelurahan_id', null, ['class' => 'form-control ' . ($errors->has('kelurahan_id') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kelurahan_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kelurahan', 'Kelurahan', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kelurahan', null, ['class' => 'form-control ' . ($errors->has('kelurahan') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kelurahan', '<p class="help-block">:message</p>') !!}
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
