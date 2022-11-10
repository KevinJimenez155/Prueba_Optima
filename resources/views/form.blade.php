<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        # {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center">Aliqua sint minim consequat reprehenderit occaecat.</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('store') }}" method="POST" class="form-group">
                        @csrf
                            <div class="container">
                                <div class="row">
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                    <div class="col-9">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name"  placeholder="Nombre Completo">
                                            <label for="name">Nombre Completo</label>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="age" name="age" required placeholder="Edad" min="18">
                                            <label for="floatingInput">Edad</label>
                                            @if ($errors->has('age'))
                                            <span class="text-danger">{{ $errors->first('age') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="phone" name="phone" required placeholder="Teléfono" pattern="[1-9]{1}[0-9]{9}">
                                            <label for="floatingInput">Teléfono</label>
                                            @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email" required placeholder="Correo">
                                            <label for="floatingInput">Correo</label>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select"id="car_interest" name="car_interest" required aria-label="Floating label select example">
                                                <option value="">Selecciona tu auto de interés</option>
                                                @foreach ($cars as $car)
                                                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="car_interest" name="car_interest" required placeholder="Auto de interés"> --}}
                                            <label for="floatingInput">Auto de interés</label>
                                            @if ($errors->has('car_interest'))
                                            <span class="text-danger">{{ $errors->first('car_interest') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3" style="display: none" id="myDiv">
                                            <select class="form-select"id="model_interest" name="model_interest" required aria-label="Floating label select example">
                                                <option>Selecciona el modelo de interés</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" id="model_interest" name="model_interest" required placeholder="Modelo de interés"> --}}
                                            <label for="floatingInput">Modelo de interés</label>
                                            @if ($errors->has('model_interest'))
                                            <span class="text-danger">{{ $errors->first('model_interest') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 text-end">
                <a href="{{route('list')}}" class="btn btn-lg btn-dark">Ver registros</a>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#car_interest').on('change', function(){
                let id = $('#car_interest').val();
                if(!id){
                    $('#myDiv').css("display", "none");
                }else{
                    $.ajax({
                        url:'{{ url('car') }}/'+id+'/models',
                        type: 'GET',
                        dataType: 'json',
                    }).done(function(data){
                        $('#myDiv').css("display", "block");
                        $('#model_interest').empty()
                        for(let i = 0; i < data.length; i++){
                            $('#model_interest').append($('<option>', {
                                value: data[i].id,
                                text: data[i].name
                            }));
                        }
                    })
                }
            });
        })
    </script>
</body>
</html>
