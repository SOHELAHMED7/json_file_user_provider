<?php

namespace App\Extensions;

use Illuminate\Contracts\Auth\UserProvider;
use App\Extensions\JsonFileUserAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

/**
 * Json File based user storage retrieval
 */
class JsonFileUserProvider implements UserProvider
{
    /**
     * The table containing the users.
     *
     * @var array
     */
    protected $user_data;

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Database\ConnectionInterface  $conn
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $table
     * @return void
     */
    public function __construct(array $user_data)
    {
        $this->user_data = $user_data;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = null;
        foreach ($this->user_data as $key => $value) {
            if($value['id'] === $identifier) {
                return $this->getGenericUser($value);
            }
        }

        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $user = null;
        foreach ($this->user_data as $key => $value) {
            if($value['id'] === $identifier && $value['remember_me_token'] === $token) {
                return $this->getGenericUser($value);
            }
        }
        return $user;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // login to update remember me token
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = null;
        foreach ($this->user_data as $key => $value) {
            foreach ($credentials as $c_key => $c_value) {
                if (! Str::contains($c_key, 'password')) {
                    if($value[$c_key] == $c_value) {
                        return $this->getGenericUser($value);
                    }
                }
            }
        }

        return $user;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new JsonFileUserAuthenticatable((array) $user);
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // hasher can be used here
        return $credentials['password'] === $user->getAuthPassword();
    }
}
