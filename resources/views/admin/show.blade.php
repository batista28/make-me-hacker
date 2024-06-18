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
            <div style="font-size: 24px; font-weight: bold; color: white;">Información del usuario</div>
            <a href="{{ route('allUsers') }}" style="color: #4db8ff; text-decoration: none; font-weight: bold; margin-bottom: 10px;">&larr; Atras</a>
            <div style="width: 100%;">

                <div class="row">
                    <label for="code" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;"><strong>Nombre:</strong></label>
                    <div class="col-md-6" style="line-height: 35px; color: #ffffff;">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="row">
                    <label for="type" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;"><strong>Email:</strong></label>
                    <div class="col-md-6" style="line-height: 35px; color: #ffffff;">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row">
                    <label for="type" class="col-md-4 col-form-label text-md-end text-start" style="color: #ffffff;"><strong>Score:</strong></label>
                    <div class="col-md-6" style="line-height: 35px; color: #ffffff;">
                        {{ $user->score }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
