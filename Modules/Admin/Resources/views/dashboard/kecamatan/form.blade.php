<div class="form-group row">
    {!! Form::label('kecamatan_id', 'Kecamatan ID', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kecamatan_id', null, ['class' => 'form-control ' . ($errors->has('kecamatan_id') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kecamatan_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kecamatan', 'Kecamatan', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('kecamatan', null, ['class' => 'form-control ' . ($errors->has('kecamatan') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('kecamatan', '<p class="help-block">:message</p>') !!}
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
