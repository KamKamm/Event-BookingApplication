<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        $username = addsLashes($data['username']);
        $password =  addsLashes($data['password']);

        $usernameWithoutSpaces = str_replace(' ', '', $username);
        $query = "SELECT * FROM egn_users WHERE REPLACE(username, ' ', '') = '$usernameWithoutSpaces' LIMIT 1";

        $DB = new Database();
        $result = $DB->query($query);


        if (empty($username)) {
            $this->error .= "Username is empty!<br>";
        } elseif (empty($password)) {
            $this->error .= "Password is empty!<br>";
        }elseif (strlen($password) < 12) {
            $this->error .= "Password must be at least 12 characters long!<br>";
        }

        if ($result) {
            $row = $result[0];

            $hashed_password = $row['passwordHash'];

            if ($this->validatePassword($password, $hashed_password) == $hashed_password) {
                //create session data
                $_SESSION['eng_userid'] = $row['userID'];
                if ($this->validatePassword($password, $hashed_password) == $hashed_password && $username == $row['username']) {
                    $this->validate_user($data);
                }
            } elseif ($this->validatePasswordd($password, $hashed_password) == $hashed_password) {
                //create session data
                $_SESSION['eng_userid'] = $row['userID'];
                if ($this->validatePasswordd($password, $hashed_password) == $hashed_password && $username == $row['username']) {
                    $this->validate_user($data);
                }
            } else {
                $this->error .= "Invalid Credientials<br>";
            }

            if ($username == $row['username']) {
                //create session data

                $_SESSION['eng_userid'] = $row['userID'];
            } else {
                $this->error .= "Invalid Credientials<br>";
            }
        } else {
            $this->error .= "Invalid Credientials<br>";
        }
        return $this->error;
    }


    private function validatePassword($password, $hashed_password)
    {
        $hashed_input = hash("sha1", $password);
        return $hashed_input === $hashed_password;
    }


    private function validatePasswordd($password, $hashed_password)
    {
        // Validate using Bcrypt hash
        return password_verify($password, $hashed_password);
    }


    private function validate_user($data)
    {
        $username = $data['username'];
        $query = "select * from egn_users where username = '$username' limit 1";
        $DB = new Database();
        $row =  $DB->query($query);
        $row = $row[0];
        $_SESSION['USER'] = $row;
    }

    public function check_login($id)
    {
        if (is_numeric($id)) {
            $_SESSION['eng_userid'] = 0;
            return true;
        } 
    }


    // function redirectToLogin()
    // {
    //     header("Location: login.php");
    //     die;
    // }
}
