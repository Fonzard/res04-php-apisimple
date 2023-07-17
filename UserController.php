<?php
class UserController extends AbstractController {
    
    private UserManager $manager;
    
    public function __construct(){
        $this->manager = new UserManager("francisrouxel_apiSimple", "3306", "db.3wa.io", "francisrouxel", "acadbb28886b6985666cd7eff4651f1d");
    }
    
    public function create()
    {
        //Récupère les données du formulaire
        if(isset($_POST['firstname'], $_POST['lastname'], $_POST['email']))
        {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
        
            //Instancie les données recup en User
            $user = $this->manager->createUser(new User($firstname, $lastname, $email));
        
            //Connecte manuellement le user nouvellement créé
            $_SESSION['user'] = $user->getId();
            header: ('location:/');
        } else {
            header('location:/create');
        }
        //Trouver où rediriger ?? En Index ??
        
    }
    public function edit(int $user_id)
    {   
        $user_id = $_SESSION['id'];
        if (isset($user_id))
        {
            //Récupère l'id et les nouveaux atttributs du profil / Je ne suis pas sur que ce sois la bonne méthode
            $user = [
                'id' => $user_id,
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
            ];
            $this->manager->editUser($user);
        } else {
            header('location:/edit');
        }
        
    }
    public function delete(int $user_id)
    {
        $user_id = $_SESSION['id'];
        $user = $this->manager->userById($user_id);
        $user->delete();
        return $user['firstname']." à bien été supprimé";
    }
    public function read(int $user_id)
    {
        $user_id = $_SESSION['id'];
        $user = $this->manager->userById($user_id);
        $this->renderJson(['user' => $user]);
        header('location:/read');
    }
    public function readAll()
    {
        $allUsers = $this->manager->getAllUsers();
        $this->renderJson(['allUsers' => $allUsers]);
        header ('location:/read_all');
    }
}
?>