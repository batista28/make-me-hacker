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
            <div style="font-size: 24px; font-weight: bold; color: white;">Añadir usuario</div>
            <a href="{{ route('allUsers') }}" style="color: #4db8ff; text-decoration: none; font-weight: bold; margin-bottom: 10px;">&larr; Atras</a>

            <form action="{{ route('storeUser') }}" method="post" style="width: 100%; display: flex; flex-direction: column;">
                @csrf

                <div class="mb-3 row" style="display: flex; flex-direction: column; align-items: center;">
                    <label for="name" style="color: #ffffff; margin-bottom: 5px;">Nombre:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" style="max-width: 400px;">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="mb-3 row" style="display: flex; flex-direction: column; align-items: center;">
                    <label for="email" style="color: #ffffff; margin-bottom: 5px;">Email:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" style="max-width: 400px;">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-3 row" style="display: flex; flex-direction: column; align-items: center;">
                    <label for="password" style="color: #ffffff; margin-bottom: 5px;">Contraseña:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" style="max-width: 400px;">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="mb-3 row" style="display: flex; justify-content: center;">
                    <input type="submit" class="btn btn-primary" value="Añadir usuario" style="max-width: 200px;">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
