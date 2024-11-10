<?php

namespace controllers;

use models\Share;

class SharesController extends Controller
{
    public function index(): string {
        $sql = "SELECT * FROM shares";
        $statement = $this->connection->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        $shares = [];

        foreach ($result as $row) {
            $shares[] = Share::fromArray($row)->toHtml();
        }

        $shares = str_replace('{{ base_url }}', $this->baseUrl, implode("\n", $shares));

        return $this->render('views/index.html', ['shares' => $shares]);
    }

    public function add(): string {

    }

    public function edit(): string {

    }

    public function delete(): string {

    }


}