<?php

namespace Grafite\Cms\Services;

class CryptoService
{
    /**
     * Length of the hash to be returned.
     *
     * @var integer
     */
    protected $length;

    /**
     * Encrypted Key.
     *
     * @var string
     */
    protected $password;

    /**
     * Bad URL characters.
     *
     * @var array
     */
    protected $specialCharactersForward;

    /**
     * Bad URL characters.
     *
     * @var array
     */
    protected $specialCharactersReversed;

    /**
     * The encoding.
     *
     * @var string
     */
    protected $encoding;

    /**
     * Construct the Encrypter with the fields.
     *
     * @param string
     * @param string
     * @param int
     */
    public function __construct()
    {
        $this->password = config('app.key');

        $this->specialCharactersForward = [
            '+' => '.',
            '=' => '-',
            '/' => '~',
        ];
        $this->specialCharactersReversed = [
            '.' => '+',
            '-' => '=',
            '~' => '/',
        ];

        $this->encoding = 'AES-256-CBC';
    }

    /**
     * Encrypt the string using your app and session keys,
     * then return the new encrypted string.
     *
     * @param string $value String to encrypt
     *
     * @return string
     */
    public function encrypt($value)
    {
        $iv = substr(md5(random_bytes(16)), 0, 16);
        $encrypted = openssl_encrypt($value, $this->encoding, $this->password, null, $iv);

        return $this->url_encode($iv.$encrypted);
    }

    /**
     * Decrypt a string.
     *
     * @param string $value Encrypted string
     *
     * @throws Exception
     *
     * @return string
     */
    public function decrypt($value)
    {
        $decoded = $this->url_decode($value);
        $iv = substr($decoded, 0, 16);
        $encryptedValue = str_replace($iv, '', $decoded);

        return trim(openssl_decrypt($encryptedValue, $this->encoding, $this->password, null, $iv));
    }

    /**
     * Encode the string to be used as a url slug.
     *
     * @param  string
     *
     * @return string
     */
    public function url_encode($string)
    {
        return rawurlencode($this->url_base64_encode($string));
    }

    /**
     * Decode the string to be used as a url slug.
     *
     * @param  string
     *
     * @return string
     */
    public function url_decode($string)
    {
        return $this->url_base64_decode(rawurldecode($string));
    }

    /**
     * Base 64 encode.
     *
     * @param string $string String to encode
     *
     * @return string
     */
    protected function url_base64_encode($string)
    {
        return strtr(base64_encode($string), $this->specialCharactersForward);
    }

    /**
     * Base 64 decode.
     *
     * @param string $string String to decode
     *
     * @return string
     */
    protected function url_base64_decode($string)
    {
        return base64_decode(strtr($string, $this->specialCharactersReversed));
    }
}
