<?php
require_once'../app/models/User.php';
class AuthController extends Controller
{
    private $model;

    public function __construct() {
        $this->model = new User();
    }
    public function profile() {
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }
        $data = $this->model->getUserById($_SESSION['user_id']);
        
        $this->view('auth/profile',$data);
    }
    public function register()
    {
        
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }

        $data = ['message' => ''];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once '../app/models/User.php';

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $existingUser = $userModel->getUserByUsername($username);
            $existingEmail = $userModel->getUserByEmail($email);

            if ($existingUser) {
                $data['message'] = "Cet utilisateur existe déjà. Veuillez choisir un autre nom d'utilisateur.";
            } elseif ($existingEmail) {
                $data['message'] = "Cet email est déjà utilisé. Veuillez choisir un autre email.";
            } else {
                $result = $userModel->registerUser($username, $email, $password);

                if ($result) {
                    redirect('auth/confirmation');
                } else {
                    $data['message'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }

        $this->view('auth/register', $data);
    }

    public function login()
    {
        $data = ['message' => ''];

        if(isset($_GET['message'])) $data['message'] = $_GET['message'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once '../app/models/User.php';

            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                loginUser($user);
                redirect('home/index');
            } else {
                $data['message'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        }

        $this->view('auth/login', $data);
    }

    public function confirmation() {
        $this->view("auth/confirmation");
    }

    public function logout() {
        logoutUser();
        redirect('auth/login');
    }
}
