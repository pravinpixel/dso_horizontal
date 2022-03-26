<?php

namespace App\Interfaces;

interface MartialProductRepositoryInterface {
    public function update_form_one($id, $request);
    public function update_form_two($id, $request);
    public function update_form_three($id, $request);
}