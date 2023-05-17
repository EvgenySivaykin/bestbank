<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const SORT = [
        'asc_fname' => 'Name A-Z',
        'desc_fname' => 'Name Z-A',
        'asc_lname' => 'Last name A-Z',
        'desc_lname' => 'Last name Z-A',
        'asc_balance' => 'Balance 0-9',
        'desc_balance' => 'Balance 9-0'
    ];

    const PER_PAGE = [
        'all', 4, 8, 16, 32
    ];




}