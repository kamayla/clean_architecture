<?php

namespace Packages\Domain\CommonRepository;

/**
 * Interface UuidGeneratorInterface
 * 識別子用のUuidを生成するためのインターフェース
 * Domain層をLaravelの技術基盤に依存させたくないので
 * Repositoryに閉じ込める。
 *
 * @package Packages\Domain\CommonRepository
 */
interface UuidGeneratorInterface
{
    /**
     * Uuidの識別子をStringで返す
     *
     * @return string
     */
    public function generateUuidString(): string;
}
