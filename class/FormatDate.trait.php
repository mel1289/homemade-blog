<?php

namespace App;

trait FormatDate
{
    public function format_date ($date)
    {
        $date = date_create($date);
        return date_format($date, 'd/m/Y à H:i');
    }
}