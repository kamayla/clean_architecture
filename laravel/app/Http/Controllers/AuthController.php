<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;
use Packages\UseCase\User\Create\UserCreateRequest;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"User/Auth"},
     *     description="ユーザー新規登録",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="氏名",
     *                     type="string",
     *                     default="Ippei Kamimura"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="メールアドレス",
     *                     type="string",
     *                     default="ippei_kamimura@icloud.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="パスワード",
     *                     type="string",
     *                     default="aaaaaa"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     description="パスワード(確認)",
     *                     type="string",
     *                     default="aaaaaa"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="認証トークンを返す",
     *     )
     * )
     */
    public function register(
        Request $request,
        UserCreateUseCaseInterface $userCreateUseCase
    ) {
        $userCreateRequest = new UserCreateRequest(
            (string) Str::orderedUuid(), // orderedUuidはタイムスタンプが加味されているため、重複リスクが限りなく0
            $request->name,
            $request->email,
            $request->password
        );

        $userCreateUseCase($userCreateRequest);

        if (!$token = auth('api')->attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"User/Auth"},
     *     description="ログイン",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="メールアドレス",
     *                     type="string",
     *                     default="ippei_kamimura@icloud.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="パスワード",
     *                     type="string",
     *                     default="aaaaaa"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="認証トークンを返す",
     *     )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/me",
     *     tags={"User/Auth"},
     *     description="自分自身を取得",
     *     @OA\Response(
     *         response="200",
     *         description="自分自身のJson",
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
