<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Packages\UseCase\User\Create\UserCreateRequest;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;
use Packages\Domain\Models\User\UserRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(
        Request $request,
        UserCreateUseCaseInterface $userCreateUseCase,
        UserRepository $userRepository
    ) {
        $this->validator($request->all())->validate();

        $userCreateRequest = new UserCreateRequest(
            (string) Str::orderedUuid(),
            $request->name,
            $request->email,
            $request->password
        );

        $userEntity = $userCreateUseCase($userCreateRequest);

        // 認証処理ではEloquentモデルのUserインスタンスが必要なため
        // 本来ContorllerではRepositoryを使わないのだが仕方なく使う。
        $ormUser = $userRepository->getUserById($userEntity->getId());

        event(new Registered($ormUser));

        $this->guard()->login($ormUser);

        if ($response = $this->registered($request, $ormUser)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
