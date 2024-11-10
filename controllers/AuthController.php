<?php

namespace controllers;

use http\Request;
use models\User;

class AuthController extends Controller
{
    public function register(Request $request): string {
        if ($request->isMethod('POST')) {
            $user = new User(
                $request->post['name'],
                $request->post['email'],
                password_hash($request->post['password'], \PASSWORD_DEFAULT)
            );

            $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

            $statement = $this->connection->pdo->prepare($sql);
            $statement->execute($user->toArray());

            $this->redirect("/?action=login");
        }

        return $this->render('views/register.html');
    }

    public function login(Request $request): string {
        if ($request->isMethod('POST')) {
            $sql = 'SELECT * FROM users WHERE email = :email';

            $statement = $this->connection->pdo->prepare($sql);
            $statement->execute(['email' => $request->post['email']]);

            $result = $statement->fetch();

            if ($result !== false) {
                $user = User::fromArray($result);

                if (password_verify($request->post['password'], $user->password)) {
                    $_SESSION['user'] = $user;

                    $this->redirect("/?action=index");
                }
            }

            $this->redirect("/?action=login");
        }

        return $this->render('views/login.html');
    }

    public function logout(): void {
        unset($_SESSION['user']);

        $this->redirect("/");
    }
}