<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registerView()
    {
        /* Ir a la vista register */
        return view('auth.register');
    }
    /* Ir a la vista login */
    public function loginView()
    {
        return view('auth.login');
    }
    /* Ir a la vista del segundo factor */
    public function show2FA()
    {
        return view('auth.twoFactor');
    }
    /* Ir a la vista home */
    public function index()
    {
        return view('home');
    }
    /* Registra un usuario */
    public function store(StoreUserRequest $request)
    {
        // Si la validación pasa, puedes acceder a los datos validados
        $validatedData = $request->validated();

        //Crear el usuario
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('login')->with('success', 'Usuario creado con éxito.');
    }
    /* Hace login */
    public function login(LoginUserRequest $request)
    {
        //Se busca al usuario
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
        {
            return back()->withErrors([
                'credenciales' => 'Credenciales incorrectas.',
            ])->withInput();
        }
        //Se llama la función donde se manda el correo, regresando una ruta firmada
        return redirect($this->emailTwoFactor($user));
    }
    /* Envía el codigo */
    private function emailTwoFactor(User $user)
    {
        $generate = Str::random(6);
        $code =  Str::upper($generate);
        $user->code = Hash::make($code);
        $name = $user->name;
        $user->code_expires_at = now()->addMinutes(10); // Código válido por 10 minutos
        $user->save();
        Mail::send('emails.code', ['code' => $code, 'name' => $name], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Segundo factor de autenticación');
        });
         // Generar URL temporal firmada
        $url = URL::temporarySignedRoute(
            '2fa',
            now()->addMinutes(10),
            ['email' => encrypt($user->email)]
        );
        return $url;

    }
    /* Cofirmar codigo ingresado */
    public function confirmTwoFactor(VerifyCodeRequest $request)
    {
        Log::info($request->input('email'));
        Log::info(decrypt($request->input('email')));
        
        $email = decrypt($request->input('email')); // Accede al correo de la URL
        strtoupper($request->code);
        $user = User::where('email', $email)->first();
        //Codigo incorrecto
        if (!$user || !Hash::check(strtoupper($request->code), $user->code) || now()->greaterThan($user->code_expires_at)) {
            return back()->withErrors(['code' => 'Código inválido o expirado.']);
        }

        // Limpia el código y permite acceso
        $user->update([
            'code' => null,
            'code_expires_at' => null,
        ]);
        Auth::login($user); // Autenticar al usuario
        return redirect()->route('index');
    }
    /* Logout */
    public function destroy()
    {
        Auth::logout(); // Evita acceso sin la verificación
        return redirect()->route('login');
    }

}
