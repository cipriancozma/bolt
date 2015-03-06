<?php
namespace Bolt\Storage\Entity;

use Bolt\Storage\Entity;

/**
 * Entity for Auth Tokens.
 */
class AuthToken extends Entity
{
    
    protected $id;
    protected $username;
    protected $token;
    protected $salt;
    protected $lastseen;
    protected $ip;
    protected $useragent;
    protected $validity;

}
