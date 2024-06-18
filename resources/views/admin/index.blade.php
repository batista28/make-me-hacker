@extends('../layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <div style="display: flex; flex-direction: column; margin-top: 200px; max-width: 800px; margin-left: auto; margin-right: auto; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); padding: 20px;">
            <div style="font-size: 24px; font-weight: bold; color: white;">Usuarios</div>
            <a href="{{ route('createUser') }}" style="color: #4db8ff; text-decoration: none; font-weight: bold; margin-bottom: 10px;">Crear usuario</a>
            <div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff;">ID</th>
                            <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff;">Nombre</th>
                            <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff;">Email</th>
                            <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff;">Score</th>
                            <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $user->id }}</td>
                            <td style="border-bottom: 1px solid #4db8ff; padding: 10px;"><a href="{{ route('showUser', $user->id)}}" style="color: #ffa64d; text-decoration: none;">{{ $user->name }}</a></td>
                            <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $user->email }}</td>
                            <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $user->score }}</td>
                            <td style="border-bottom: 1px solid #4db8ff; padding: 10px;">
                                <form action="{{ route('destroyUser', $user->id) }}" method="post" style="display: flex; justify-content: space-between;">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('showUser', $user->id) }}" style="background-color: #ffcc00; color: #000; margin-right: 5px; border-radius:5px; flex: 1; text-align: center; padding: 5px;"> Ver</a>

                                    <a href="{{ route('editUser', $user->id) }}" style="background-color: #4db8ff; color: #fff; margin-right: 5px; border-radius:5px; flex: 1; text-align: center; padding: 5px;"> Editar</a>

                                    <button type="submit" style="background-color: #ff4d4d; color: #fff; border-radius:5px; flex: 1; text-align: center; padding: 5px; padding-right:20px"> Borrar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection