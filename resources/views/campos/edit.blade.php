@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Campo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($campo, ['route' => ['campos.update', $campo->id], 'method' => 'patch']) !!}

                        @include('campos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection