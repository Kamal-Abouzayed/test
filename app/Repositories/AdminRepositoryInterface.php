<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AdminRepositoryInterface
{
   public function all();

   public function get($id);

   public function create(array $data);

   public function update($id ,array $data);

   public function delete($id);
}
