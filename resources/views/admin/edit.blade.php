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
            <div style="font-size: 24px; font-weight: bold; color: white;">Modificar Usuario</div>
            <a href="{{ route('allUsers') }}" style="color: #4db8ff; text-decoration: none; font-weight: bold; margin-bottom: 10px;">&larr; Atras</a>
            <div style="width: 100%;">
                <form action="{{ route('updateUser', $user->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;">Nombre</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff; border: 1px solid #4db8ff; border-radius: 5px;">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;">Email</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff; border: 1px solid #4db8ff; border-radius: 5px;">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="score" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;">Score</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('score') is-invalid @enderror" id="score" name="score" value="{{ $user->score }}" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff; border: 1px solid #4db8ff; border-radius: 5px;">
                            @if ($errors->has('score'))
                            <span class="text-danger">{{ $errors->first('score') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar usuario" style="background-color: #4db8ff; color: #ffffff; border-radius: 5px;">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
