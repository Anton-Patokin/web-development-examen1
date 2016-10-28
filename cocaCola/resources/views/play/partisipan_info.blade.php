{{Form::open(['url' => '/apartisipan-information'])}}
{{Form::token()}}
<div class="form-group col-md-6">
    {{Form::label('name', 'Name', ['class' => 'awesome'])}}
    {{ Form::text('name', '', array('class' => 'form-control')) }}
</div>
<div class="form-group col-md-6">
    {{Form::label('address', 'Address', ['class' => 'awesome'])}}
    {{ Form::text('address', '', array('class' => 'form-control')) }}
</div>
<div class="form-group col-md-6">
    {{Form::label('location', 'Location', ['class' => 'awesome'])}}
    {{ Form::text('location', '', array('class' => 'form-control')) }}
</div>
<div class="form-group col-md-6">
    {{Form::label('email', 'Email', ['class' => 'awesome'])}}
    {{ Form::text('email', '', array('class' => 'form-control')) }}
</div>

<div class="col-md-12">
    {{Form::submit('Click Me!',['class' => 'btn btn-primary'])}}
</div>
{{Form::close() }}