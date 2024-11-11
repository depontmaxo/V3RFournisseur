<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\EmailService;
use App\Http\Controllers\Auth\LoginController;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$this->middleware('auth')->only('logout');
    }

    public function forgotPassword(Request $request){

        //si la requete est de type post
        if($request->isMethod('post')){

            $email = $request->input('email-send');
            $user = DB::table('utilisateur')->where('email', $email)->first();
            $message = null;

            if($user)
            {
                $full_name = $user->nomFournisseur;
                //on va generer un token pour la renitialisation du mot de passe de l'utilisateur
                $activation_token = md5(uniqid()) . $email . sha1($email);
                //dd($activation_token);

                $emailrestpwd = new EmailService;
                $subject = "Reset your password";
                $emailrestpwd->resetPassword($subject, $email, $full_name,true, $activation_token);

                $message = "Nous avons envoyé une requete pour changer votre mot de passe, regarder votre courriel";
                return back()->withErrors(['email-success' => $message])
                                ->with('old_email', $email)
                                ->with('success', $message);

            }
            else{
                $message = "Le courriel que vous avez entrer n'existe pas";
                return back()->withErrors(['email-error' => $message])
                            ->with('old_email', $email)
                            ->with('danger', $message);
            }
      
        }
        return view('auth.forgot_password');
    }



    public function index()
    {
        return view('User.connexionUser');  // Renvoie la vue d'index pour l'admin
    }


    public function loginEmploye(Request $request)
    {
        // Valider les champs requis
        $request->validate([
            'email' => 'required|email',
        ]);

        // Rechercher l'utilisateur en fonction de l'adresse e-mail
        $user = DB::table('users')->where('email', $request->email)->first();

        // Vérification de l'existence de l'utilisateur
        if ($user) {
            if ($user->is_admin) {
                // Rediriger vers la page admin si l'utilisateur est admin
                return redirect()->route('gestion.userAdmin');
            } else {
                // Rediriger vers la page utilisateur si l'utilisateur n'est pas admin
                return redirect()->route('Responsable.index');
            }
        } else {
            // Retourner une erreur si l'utilisateur n'est pas trouvé
            return redirect()->back()->withErrors(['error' => 'Les informations de connexion sont incorrectes.']);
        }

        dd($request->all());
    }




}
