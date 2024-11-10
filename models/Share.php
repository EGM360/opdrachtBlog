<?php

namespace models;

use DateTime;

class Share extends Model
{
    public function __construct(
        public readonly int           $user_id,
        public readonly string        $title,
        public readonly string        $body,
        public readonly string        $link,
        public readonly DateTime|null $create_date = null,
        public readonly int|null      $id = null,
        public readonly User|null     $user = null,

    ) {

    }

    public static function fromArray(array $data): static {
        return new self(
            $data['user_id'],
            $data['title'],
            $data['body'],
            $data['link'],
            new DateTime($data['create_date']),
            $data['id'],
        );
    }

    public function toHtml(): string {
        $html = file_get_contents('views/share.html');

        foreach (['id', 'user_id', 'title', 'body', 'link', 'create_date'] as $property) {
            $value = $this->$property;
            if ($value instanceof DateTime) {
                $value = $value->format('j F Y H:i');
            }
            $html = str_replace('{{ ' . $property . ' }}', $value, $html);
        }

        return $html;
    }
}