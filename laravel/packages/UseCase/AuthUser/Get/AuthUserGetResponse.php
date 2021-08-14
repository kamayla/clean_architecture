<?php


namespace Packages\UseCase\AuthUser\Get;


class AuthUserGetResponse
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /**
     * AuthUserGetResponse constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * 今回JsonAPIだけしか想定してないため、余分なプレゼンターなどを作らず
     * Responseクラスから直接toArrayで公開する。
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
