<?php

    $notification = Session::get("notification");
    $notificationType = Session::get("notificationType");

    if ($notification) {
        echo 'gondolynNotify("'.$notification.'", "'.$notificationType.'");';
    }