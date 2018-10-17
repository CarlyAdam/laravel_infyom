@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pelis
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pelis, ['route' => ['pelis.update', $pelis->id], 'method' => 'patch']) !!}

                        @include('pelis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection