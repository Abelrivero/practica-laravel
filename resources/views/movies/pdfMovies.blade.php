<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }
    </style>
  </head>
  <body>
      <div class="conteiner m-4">
        <h1 class="text-center">Listado de Peliculas con Actores</h1>
        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Actores</td>
                </tr>
            </thead>
            <tbody id="tBodyMovie">
                @foreach ($movies as $movie)
                <tr>
                    <td>{{$movie->title}}</td>
                    <td>
                        <ul>
                            @forelse ($movie->casting as $actorName)    
                                <li>{{$actorName}}</li>
                            @empty
                                <li>Sin Actor Registrado</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>