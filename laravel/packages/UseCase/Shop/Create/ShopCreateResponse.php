<?php


namespace Packages\UseCase\Shop\Create;


class ShopCreateResponse
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /**
     * ShopCreateResponse constructor.
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
        ];
    }
}
