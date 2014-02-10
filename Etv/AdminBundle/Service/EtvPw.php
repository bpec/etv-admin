<?php

namespace Etv\AdminBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class EtvPw implements PasswordEncoderInterface
{

    public function encodePassword($raw, $salt)
    {
        return md5(md5($raw).$salt).$salt; // Custom function for encrypt
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

}
