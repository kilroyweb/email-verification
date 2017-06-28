<?php

namespace KilroyWeb\EmailVerification\Traits;

trait HasEmailVerification{

    public $emailVerifiedField = 'email_verified';
    public $emailVerificationTokenField = 'email_verification_token';

    public static function findByEmailVerificationToken($token){
        $instance = new static;
        return static::where($instance->emailVerificationTokenField, $token)->first();
    }

    public function emailIsVerified(){
        $emailVerifiedField = $this->emailVerifiedField;
        return boolval($this->$emailVerifiedField);
    }

    public function getEmailVerificationToken(){
        $emailVerificationTokenField = $this->emailVerificationTokenField;
        return $this->$emailVerificationTokenField;
    }

    public function requestEmailVerification(){
        $this->storeGeneratedEmailVerificationToken();
        $this->sendEmailVerification();
    }

    public function verifyEmail(){
        $emailVerifiedField = $this->emailVerifiedField;
        $emailVerificationTokenField = $this->emailVerificationTokenField;
        $this->$emailVerifiedField = true;
        $this->$emailVerificationTokenField = null;
        $this->save();
    }

    public function sendEmailVerification(){
        \Mail::send(new \App\Mail\EmailVerification($this));
    }

    public function storeGeneratedEmailVerificationToken(){
        $emailVerificationTokenField = $this->emailVerificationTokenField;
        $this->$emailVerificationTokenField = md5(uniqid(rand(), true));
        $this->save();
    }

}