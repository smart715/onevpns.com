<?php
namespace App\Http\Controllers;
use App\UserListModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Validator;
class AuthController extends Controller
{
    private $apiToken;
    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(str_random(60)));
    }
    /**
     * Client Login
     */
    public function postLogin(Request $request)
    {
        // Validations
        $rules = [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            // Fetch User
            $user = User::where('email',$request->email)->first();
            if($user) {
                // Verify the password
                if( password_verify($request->password, $user->password) ) {
                    // Update Token
                    $postArray = ['api_token' => $this->apiToken];
                    $login = User::where('email',$request->email)->update($postArray);

                    if($login) {
                        return response()->json([
                            'name'         => $user->name,
                            'email'        => $user->email,
                            'access_token' => $this->apiToken,
                        ]);
                    }
                } else {
                    return response()->json([
                        'message' => 'Invalid Password',
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'User not found',
                ]);
            }
        }
    }
    /**
     * Register
     */
    public function postRegister(Request $request)
    {

        $validator = Validator::make($request->all());
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            $user_last        = User::where('created_at','desc')->first();
            $passord          ='hasan282801';
            $email            = 'hasan'.((int)$user_last->id+1).'@hasan.com';
            $postArray = [
                'name'        => 'Hasan Alper',
                'email'       => $email,
                'passowrd'    =>  bcrypt($passord),
                'api_token'   => $this->apiToken,
                'uuid'        => $request->uuid,
                'firebaseId'  => $request->firebaseId,
                'oneSignalId' => $request->oneSignalId
            ];
            // $user = User::GetInsertId($postArray);
            $user = User::insert($postArray);

            if($user) {
                return response()->json([
                    'access_token' => $this->apiToken,
                ]);
            } else {
                return response()->json([
                    'message' => 'Registration failed, please try again.',
                ]);
            }
        }
    }
    /**
     * Logout
     */


    public function createUser(Request $request){

        $userTokenControl = User::where('uuid',$request->uuid)->first();
        if ($userTokenControl){
            $access_array = array('access_token' => $userTokenControl->api_token);
            $api['result'] = 'success';
            $api['response'] = $access_array;
            return response()->json($api, 200);
        }

        $user_last        = User::orderBy('id','desc')->first();
        $passord='hasan282801';
        $email = 'hasan'.((int)$user_last->id+1).'@hasan.com';
        $postArray = [
            'name'        => 'Hasan Alper',
            'email'       => $email,
            'password'    =>  bcrypt($passord),
            'api_token'   => $this->apiToken,
            'uuid'        => $request->uuid,
            'firebaseId'  => $request->firebaseId,
            'oneSignalId' => $request->oneSignalId
        ];

        $user = User::insert($postArray);


        $user = User::where('email',$email)->first();
        if($user) {
            // Verify the password
            if( password_verify($passord, $user->password) ) {
                // Update Token
                $postArray = ['api_token' => $this->apiToken];
                $login = User::where('email',$email)->update($postArray);

                $access_array = array('access_token' =>$this->apiToken);
                if($login) {

                        $api['result'] = 'success';
                        $api['response'] = $access_array;
                        return response()->json($api, 200);

                }
            } else {
                return response()->json([
                    'message' => 'Invalid Password',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User not found',
            ]);
        }






    }
    public function postLogout(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token',$token)->first();
        if($user) {
            $postArray = ['api_token' => null];
            $logout = User::where('id',$user->id)->update($postArray);
            if($logout) {
                return response()->json([
                    'message' => 'User Logged Out',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
    }
}