<?php

namespace models;

abstract class Model
{
    abstract public static function fromArray(array $data): static;
}