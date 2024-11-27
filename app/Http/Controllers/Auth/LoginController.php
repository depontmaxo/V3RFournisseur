<?php

namespace App\Http\Controllers\Auth;

use App\Services\EmailService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



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
    protected $redirectTo = '/';

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
                $full_name = $user->nom_entreprise;
                //on va generer un token pour la renitialisation du mot de passe de l'utilisateur
                $activation_token = md5(uniqid()) . $email . sha1($email);
                //dd($activation_token);

                $emailrestpwd = new EmailService;
                $subject = "Reset your password";
                $emailrestpwd->resetPassword($subject, $email, $full_name,true, $activation_token);


                DB::table('utilisateur')
                ->where('email', $email)
                ->update(['activation_token'=>$activation_token]);

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


    /*
    IMPORTANT!!!!!!!

    Il peut y avoir un bug avec la session id, le problème va probablement être ici!!
    
    */
    public function loginEmploye(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Retrieve the user by email
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
    
            if (Auth::guard('user')->attempt($credentials)) {
                // User is logged in, check session data
                //dd(session()->all());  // Should contain the user's session data

                // Redirect based on user role
                if ($user->is_admin) {
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->route('Responsable.index');
                }
            } else {
                // Authentication failed
                dd('Authentication failed');
                return redirect()->back()->withErrors(['error' => 'Les informations de connexion sont incorrectes.']);
            }
        }

        // If the user doesn't exist, show all request data
        return redirect()->back()->withErrors(['error' => 'Le compte n\'a pas été trouvé. Veuillez vérifier le email et le mot de passe!']);
    }


    public function changePassword(Request $request, $token)
    {
        // Vérifier si la requête est de type POST
        if ($request->isMethod('post')) {
            $new_password = $request->input('new-password');
            $new_password_confirm = $request->input('confirm-password');
            $passwordLength = strlen($new_password);
            $message=null;


            if($passwordLength >=8){

                $message = 'Vos mots de passes doivent être identiques! ';

            if($new_password == $new_password_confirm){

                $user = DB::table('utilisateur')->where('activation_token', $token)->first();

                if($user) {

                    $id_user = $user->id;
                    DB::table('utilisateur')
                    ->where('id', $id_user)
                    ->update([
                        'password' => Hash::make($new_password), 
                        'updated_at' => new \DateTimeImmutable,
                        'activation_token' => ''
                    ]);


                    return redirect()->route('Connexion.pageConnexion')->with('success', 'Nouveau mot de passe sauvegardé avec succes!');

                }

                else{
                    return back()->with('danger', 'Ce token ne correspond pas à un utilisateur');
                }


            }
              
            else{
                return back()->withErrors(['password-error-confirm' => $message, 'password-success' =>'success'])
                ->with('danger', $message)
                ->with('old-new-password-confirm',  $new_password_confirm)
                ->with('old-new-password',  $new_password);
            }
              
            }

            else{
                     $message = "Votre mot de passe doit contenir aumoins 8 caractères!";
                     return back()->withErrors(['password-error' => $message])
                                   -> with('danger', $message)
                                   ->with('old-new-password',  $new_password);
            }

            
         

        }
    
     
        return view('auth.change_password', [
            'activation_token' => $token
        ]);
    }
    


}
