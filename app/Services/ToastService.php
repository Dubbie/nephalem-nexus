<?php

namespace App\Services;

class ToastService
{
    public function setToast($type, $title, $message, $duration = 3000)
    {
        session()->flash('toast.type', $type);
        session()->flash('toast.title', $title);
        session()->flash('toast.message', $message);
        session()->flash('toast.duration', $duration);
    }
}
