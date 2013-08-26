<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Felixkiss\SlugRoutes\SluggableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface, SluggableInterface
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Virtual attribute for full name.
	 * Combines first_name and last_name db columns.
	 *
	 * @return string
	 */
	public function getNameAttribute()
	{
		return $this->first_name.' '.$this->last_name;
	}

	/**
	 * Makes sure the slug is refreshed after we change first_name attribute.
	 *
	 * @param  string $firstName
	 * @return void
	 */
	public function setFirstNameAttribute($firstName)
	{
		$this->attributes['first_name'] = $firstName;

		$this->generateSlug();
	}

	/**
	 * Makes sure the slug is refreshed after we change last_name attribute.
	 *
	 * @param  string $lastName
	 * @return void
	 */
	public function setLastNameAttribute($lastName)
	{
		$this->attributes['last_name'] = $lastName;

		$this->generateSlug();
	}

	/**
	 * Regenerate the slug from name attribute.
	 *
	 * @return void
	 */
	protected function generateSlug()
	{
		$this->attributes['slug'] = Str::slug($this->name);
	}

	/**
	 * Use 'slug' db column as the identifier in URLs for this model.
	 * Should be URL friendly and unique to avoid collisions.
	 *
	 * @return string
	 */
	public function getSlugIdentifier()
	{
		return 'slug';
	}

	/**
	 * Ensure that we can always use $user->slug to generate URLs for
	 * parameterized routes.
	 *
	 * @return string
	 */
	public function getSlugAttribute()
	{
		if(isset($this->attributes['slug']))
		{
			return $this->attributes['slug'];
		}

		return $this->attributes[$this->getSlugIdentifier()];
	}
}