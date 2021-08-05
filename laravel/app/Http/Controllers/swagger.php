<?php
/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Clean Architecture Study Api",
 *     description="クリーンアーキテクチャー学習用のAPIです。",
 * )
 */

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */
