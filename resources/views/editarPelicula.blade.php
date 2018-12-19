<!DOCTYPE html>
<html>
    <head>
        <title>Agregar Pelicula</title>
    </head>
    <body>
        <form action="/api/movie/edit/{{$movies->id}}{{--?api_token=$user->api_token--}}" id="agregarPelicula" name="agregarPelicula" method="POST">
        {{--<form action="/editarPelicula/{{$movies->id}}/form" id="agregarPelicula" name="agregarPelicula" method="POST">
        @method('PUT')
        @csrf--}}
            <div>
                <label for="title">title</label>
                <input type="text" name="title" id="title" value="{{ $movies->title }}"/>
            </div>
            @if(!empty($errors->first('title')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('title') }}</div>
            @endif
            <div>
                <label for="rating">Rating</label>
                <input type="text" name="rating" id="rating" value="{{ $movies->rating }}"/>
            </div>
            @if(!empty($errors->first('rating')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('rating') }}</div>
            @endif
            <div>
                <label for="awards">awards</label>
                <input type="text" name="awards" id="awards" value="{{ $movies->awards }}"/>
            </div>
            @if(!empty($errors->first('awards')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('awards') }}</div>
            @endif
            <div>
                <label for="length">length</label>
                <input type="text" name="length" id="length" value="{{ $movies->length }}"/>
            </div>
            @if(!empty($errors->first('length')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('length') }}</div>
            @endif
            <div>
                <label>Fecha de Estreno</label>
                <select name="dia">
                    <option value="">Dia</option>
                    <?php for ($i=1; $i < 32; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                <select name="mes">
                    <option value="">Mes</option>
                    <?php for ($i=1; $i < 13; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                <select name="anio">
                    <option value="">Anio</option>
                    <?php for ($i=1900; $i < 2017; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            @if(!empty($errors->first('dia')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('dia') }}</div>
            @endif
            @if(!empty($errors->first('mes')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('mes') }}</div>
            @endif
            @if(!empty($errors->first('anio')))
                <div style="color:crimson; font-size:16px;">{{ $errors->first('anio') }}</div>
            @endif
            <input type="submit" value="Editar Pelicula" name="submit"/>
        </form>
    </body>
</html>
