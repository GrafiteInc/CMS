<?php

namespace Mlantz\Quarx\Services;

class CryptoService
{

    /**
     * Length of the hash to be returned
     *
     * @var interger
     */
    protected $length;

    /**
     * Encrypted Key
     * @var string
     */
    protected $encryptionKey;

    /**
     * Bad URL characters
     * @var array
     */
    protected $specialCharactersForward;

    /**
     * Bad URL characters
     * @var array
     */
    protected $specialCharactersReversed;

    /**
     * Construct the Encrypter with the fields
     *
     * @param string
     * @param string
     * @param integer
     */
    public function __construct()
    {
        $this->password = md5('quarx');

        $this->specialCharactersForward = [
            '+' => '.',
            '=' => '-',
            '/' => '~'
        ];
        $this->specialCharactersReversed = [
            '.' => '+',
            '-' => '=',
            '~' => '/'
        ];
    }

    /**
     * Encrypt the string using your app and session keys,
     * then return the new encrypted string
     *
     * @param  string $value String to encrypt
     * @return string
     */
    public function encrypt($value)
    {
        $encrypted = openssl_encrypt($value, 'AES-256-CBC', $this->password, null, substr($this->password, 16));

        return $this->url_encode($encrypted);
    }

    /**
     * Decrypt a string
     *
     * @param  string $value Encrypted string
     * @return string
     *
     * @throws Exception
     */
    public function decrypt($value)
    {
        $decoded = $this->url_decode($value);

        return trim(openssl_decrypt($decoded, 'AES-256-CBC', $this->password, null, substr($this->password, 16)));
    }

    /**
     * Encode the string to be used as a url slug
     *
     * @param  string
     * @return string
     */
    protected function url_encode($string)
    {
        return rawurlencode( $this->url_base64_encode($string) );
    }

    /**
     * Decode the string to be used as a url slug
     *
     * @param  string
     * @return string
     */
    protected function url_decode($string)
    {
        return $this->url_base64_decode( rawurldecode($string) );
    }

    /**
     * Base 64 encode
     * @param  string $string String to encode
     * @return string
     */
    protected function url_base64_encode($string)
    {
        return strtr(base64_encode($string), $this->specialCharactersForward);
    }

    /**
     * Base 64 decode
     * @param  string $string String to decode
     * @return string
     */
    protected function url_base64_decode($string)
    {
        return base64_decode(strtr($string, $this->specialCharactersReversed));
    }

}
