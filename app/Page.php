<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        "header_description",
        "service_description",
        "construction",
        "houseRenovation",
        "painting",
        "architectureDesign" ,
        "recentWorks",
        "employees_description",
        "projectsPg_description",
        "phone",
        "email",
        "facebook",
        "googlePlus",
        "twitter",
        "pinterest",
        "linkedIn",
        "address",
    ];
}
