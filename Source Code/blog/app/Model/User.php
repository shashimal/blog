<?php

class User extends AppModel {
    
    /*
     * Get users
     * 
     */

    public function getUsers() {

        $users = $this->query("SELECT id, user_name FROM users");
        return $users;
    }

}

?>
