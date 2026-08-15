<?php

use Illuminate\Support\Facades\Broadcast;

/* Broadcast::channel('fabrikants.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
}); */


Broadcast::channel('fabrikants.{id}', function () {
    return true;
});

Broadcast::channel('stofs', function () {
    return true;
});