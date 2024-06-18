<head>
    <!-- Other head elements -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-control {
            width: 100%;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<div class="row justify-content-center mt-3" style="display:flex; justify-content: center; color:whitesmoke; width:100%; margin-top:10px">
    <div class="col-md-8">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2>Contactanos!</h2>
            </div>
            <div class="card-body">
                <!-- Formulario de contacto -->
                <form id="formularioContacto" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="message" class="col-md-4 col-form-label text-md-end text-start">Mensaje</label>
                        <div class="col-md-6" style="width: 760px; height: 150px;">
                            <textarea style="width: 760px; height: 150px;" class="form-control @error('message') is-invalid @enderror" id="message" name="message" required></textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4" style="margin-top:10px">
                            <button type="submit" class="btn btn-primary" style="background-color: #007bff; border: none; color: white; padding: 10px 20px; font-size: 16px; border-radius: 4px;">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById("formularioContacto");

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Correo enviado!',
                text: 'Se ha enviado el correo correctamente, recibira una respuesta pronto!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Limpiamos los datos del formulario
                    form.reset();
                }
            });
        });
    });
</script>