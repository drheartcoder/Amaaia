<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettingModel extends Model
{
    protected $table = 'site_settings';

    protected $fillable = 
    [
    'site_name',
    'site_address',
    'site_contact_number',
    'site_status',
    'meta_desc',
    'meta_keyword',
    'site_email_address',
    'fb_url',
    'twitter_url',
    'google_plus_url',
    'linkedin_url',
    'youtube_url',
    'instagram_url',
    'pintrest_url',
    'lat',
    'lon',
    'currency_rate',
    'transaction_charges',
    'gst',
    'product_return_days'
    ];
}
