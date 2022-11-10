<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <style>
        # {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center">Aliqua sint minim consequat reprehenderit occaecat.</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Carro de interes</th>
                                    <th>Modelo</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->age}}</td>
                                        <td>{{$user->car_model->car->name}}</td>
                                        <td>{{$user->car_model->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{route('show', $user->id)}}"  class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-id="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Carro de interes</th>
                                    <th>Modelo</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content text-center">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        ¿Está seguro de eliminar este registro?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger confirm">Si</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-12 mt-3 text-start">
                <a href="{{route('home')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Agregar un nuevo registro</a>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
            $('.delete').click(function(event){
                event.preventDefault();
                let _id = $(this).data('id');
                $('#exampleModal').data('idU', _id);
            });

            $('.confirm').click(function(){
                let id = $('#exampleModal').data('idU');
                $.ajax({
                    url:'{{ url('user') }}/'+id,
                    type: 'delete',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                }).done(function(data){
                    $('#exampleModal').modal('hide');
                    alert('el usuario se elimino de manera correcta');
                    setTimeout(function(){ location.reload() }, 1000);
                });
            });

        });
    </script>
</body>
</html>
