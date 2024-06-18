<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Logros;
use App\Models\UserDesafio;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        // Traemos solamente los desafios del usuario activos
        $userDesafios = $user->desafios()
            ->whereHas('desafio', function ($query) {
                $query->where('active', 1);
            })
            ->with('desafio')
            ->get();

        // Traemos solamente los developers del usuario activos
        $userDevelopers = $user->developers()
            ->where('active', 1)
            ->with('developer')
            ->get();

        return view('welcome', [
            'user' => $user,
            'userDesafios' => $userDesafios,
            'userDevelopers' => $userDevelopers,
        ]);
    }

    public function ranking(Request $request)
    {
        // Traemos todos los usuarios ordenados por score
        $users = User::all()->sortByDesc('score');

        // Traemos un contador de 3
        $toppers = 3;

        return view('usuarios.index', ['users' => $users, "toppers" => $toppers]);
    }

    public function store(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'name' => 'required|max:70|min:5',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Guardamos en bd los datos
        User::create($request->all());

        // Redireccionamos a la vista
        return redirect()->route('login')->with('success', 'Usuario creado correctamente');
    }

    public function saveScore(Request $request)
    {
        // Recibimos el score
        $request->validate([
            'score' => 'required|integer',
        ]);

        // Recibimos el usuario
        $user = $request->user();


        $userDesafios = $user->desafios()
            ->whereHas('desafio', function ($query) {
                $query->where('active', 1);
            })
            ->with('desafio')
            ->get();

        foreach ($userDesafios as $userDesafio) {
            $userDesafio->active = 0;
            $userDesafio->save();
        }

        // Asignamos el score al usuario y guardamos
        $user->score = $request->input('score');
        $user->save();

        return redirect()->back()->with('success', 'Score updated successfully.');
    }

    public function create()
    {
        return view('registro.create');
    }

    public function edit($id)
    {
        // Recogemos el usuario en cuestion
        $usuario = User::find($id);


        return view('usuarios.edit', compact('usuario'));
    }

    public function show(Request $request)
    {
        $user = $request->user();

        return view('usuarios.show', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        // Validamos los datos
        $request->validate([
            'name' => 'required|max:70|min:5',
            'email' => 'required',
        ]);

        // Cargamos la discoteca a modificar
        $usuarios = User::find($id);

        // modificamos los datos en bd
        $usuarios->update($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Modificación realizada');
    }

    public function destroy(string $id)
    {
        // Cogemos el usuario en cuestion
        $usuarios = User::find($id);

        // Lo borramos
        $usuarios->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'usuario borrado');
    }

    public function formularioLogin()
    {
        return view("login.index");
    }

    public function iniciarSesion(Request $request)
    {
        // Recibimos el email y la contraseña
        $sesion = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        // Si esta autentificado iniciamos sesion
        if (auth()->attempt($sesion)) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
        }
        return back();
    }
    public function login(Request $request)
    {
        return view('login.index');
    }
    public function logout(Request $request)
    {
        // Cerramos sesion
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }

    //Admin routes
    public function allUsers(Request $request)
    {

        $user = $request->user();

        // Comprobamos que sea admin (es decir, tenga un correo en especifico)
        if ($user->email != "waterlolbusiness@hotmail.com") {
            $userDesafios = $user->desafios()
                ->whereHas('desafio', function ($query) {
                    $query->where('active', 1);
                })
                ->with('desafio')
                ->get();

            return view('welcome', [
                'user' => $user,
                'userDesafios' => $userDesafios
            ]);
        }

        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function showUser(Request $request, $id)
    {

        $user = $request->user();

        // Comprobamos que sea admin (es decir, tenga un correo en especifico)
        if ($user->email != "waterlolbusiness@hotmail.com") {
            $userDesafios = $user->desafios()
                ->whereHas('desafio', function ($query) {
                    $query->where('active', 1);
                })
                ->with('desafio')
                ->get();

            return view('welcome', [
                'user' => $user,
                'userDesafios' => $userDesafios
            ]);
        }

        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }

    public function createUser(Request $request)
    {

        $user = $request->user();

        // Comprobamos que sea admin (es decir, tenga un correo en especifico)
        if ($user->email != "waterlolbusiness@hotmail.com") {
            $userDesafios = $user->desafios()
                ->whereHas('desafio', function ($query) {
                    $query->where('active', 1);
                })
                ->with('desafio')
                ->get();

            return view('welcome', [
                'user' => $user,
                'userDesafios' => $userDesafios
            ]);
        }

        return view('admin.create');
    }

    public function storeUser(Request $request)
    {

        // Recibimos los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Creamos un nuevo usuario y le asignamos los datos para guardarlo
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('allUsers')->with('success', 'User created successfully.');
    }

    public function editUser(Request $request, $id)
    {
        $user = $request->user();

        // Comprobamos que sea admin (es decir, tenga un correo en especifico)
        if ($user->email != "waterlolbusiness@hotmail.com") {
            $userDesafios = $user->desafios()
                ->whereHas('desafio', function ($query) {
                    $query->where('active', 1);
                })
                ->with('desafio')
                ->get();

            return view('welcome', [
                'user' => $user,
                'userDesafios' => $userDesafios
            ]);
        }

        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {

        // Recibimos los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Creamos un nuevo usuario y le asignamos los datos para editarlo
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->score = $request->score;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('allUsers')->with('success', 'User updated successfully.');
    }

    public function destroyUser(Request $request, $id)
    {
        $user = $request->user();

        // Comprobamos que sea admin (es decir, tenga un correo en especifico)
        if ($user->email != "waterlolbusiness@hotmail.com") {
            $userDesafios = $user->desafios()->with('desafio')->get();

            return view('welcome', [
                'user' => $user,
                'userDesafios' => $userDesafios
            ]);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('allUsers')->with('success', 'User deleted successfully.');
    }

    public function cookies()
    {
        return view('information.cookies');
    }

    public function sobreNosotros()
    {

        return view("information.sobreNosotros");
    }
}
