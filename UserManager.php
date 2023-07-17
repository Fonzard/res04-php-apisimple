<?php 

class UserManager extends AbstractManager {
    
    public function createUser(User $user) : ?User
    {
        $query = $this->db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $parameters = [
                'firstname' => $user->getFirstname(),
                'lastname' =>$user->getLastname(),
                'email' => $user->getEmail()
            ];
        $query->execute($parameters);
        
        $user->setId($this->db->lastInsertId()); // Récupère le dernière id enregistrer dans la BDD et l'assigne à l'objet user 
    }
    
    public function editUser(User $user) 
    {
        $query = $this->db->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email");
        $parameters = [
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail()
            ];
        $query->execute($parameters);
        $usersEdited = $this->userById($user->getid());
        return $userEdited;
    }
    
    public function userById($user_id) : User
    {
        
        $query = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $parameters = [
                'id' => $user_id
            ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
        
    }
    
    public function getAllUsers() {
        
        $query = $this->db->prepare("SELECT * FROM user");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        $usersTab = [];
        foreach ($users as $user)
        {
            $userInstance = new User ($user['firstname'], $user['lastname'], $user['email']);
            $usersTab[] = $userInstance;
        }
        return $userTab;
    }
}

?>