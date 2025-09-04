<?php

namespace App\Models;

use App\Models\User\Job;
use App\Models\User\SEO;
use App\Models\User\Table;
use App\Models\User\Member;
use App\Models\User\Slider;
use App\Models\User\Social;
use App\Models\User\Gallery;
use App\Models\User\Product;
use App\Models\User\Sitemap;
use App\Models\User\Customer;
use App\Models\User\Jcategory;
use App\Models\User\OrderItem;
use App\Models\User\OrderTime;
use App\Models\User\Pcategory;
use App\Models\User\TableBook;
use App\Models\User\TimeFrame;
use App\Models\User\BasicExtra;
use App\Models\User\IntroPoint;
use App\Models\User\PostalCode;
use App\Models\User\PageHeading;
use App\Models\User\BasicSetting;
use App\Models\User\MailTemplate;
use App\Models\User\ProductOrder;
use App\Models\User\PsubCategory;
use App\Models\User\BasicExtended;
use App\Models\User\ProductReview;
use App\Models\User\ServingMethod;
use App\Models\User\ShippingCharge;
use App\Models\User\UserPermission;
use App\Models\User\PosPaymentMethod;
use App\Models\User\ReservationInput;
use App\Models\User\UserCustomDomain;
use App\Models\User\ProductInformation;
use Illuminate\Notifications\Notifiable;
use App\Models\User\Journal\BlogCategory;
use App\Models\User\CustomPage\PageContent;
use App\Models\User\ReservationInputOption;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'admin_id',
        'first_name',
        'last_name',
        'email',
        'image',
        'username',
        'password',
        'phone',
        'city',
        'state',
        'address',
        'country',
        'status',
        'featured',
        'verification_link',
        'email_verified',
        'online_status',
        'preview_template',
        'pwa',
        'pass_token',
        'restaurant_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
