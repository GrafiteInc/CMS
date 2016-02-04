<?php

    $notification = Session::get("notification");
    $notificationType = Session::get("notificationType");

    if ($notification) {
        echo 'quarxNotify("'.$notification.'", "'.$notificationType.'");';
    }