<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountsTable extends Model
{
    public $table = 'accounts_table';
    protected $connection = 'mysql';
    public $fillable = ['DomainId',
		'Email',
		'password'
	];
	public $timestamps = false;
}
