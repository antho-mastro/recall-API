<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Models\AccountsModel;

/**
 * A controller class that handles requests for creating new accounts and 
 * generating JWTs.
 * 
 * @author frostybee
 */
class AccountsController extends BaseController
{
    private $accounts_model = null;

    public function __construct()
    {
        $this->accounts_model = new AccountsModel();
    }

    public function handleCreateAccount(Request $request, Response $response)
    {
        $account_data = $request->getParsedBody();
        
        // 1) Verify if any information about the new account to be created was included in the request.
        if (empty($account_data)) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);
        }

        // TODO: before creating the account, verify if there is already an existing one with the provided email.
        // 2) Data was provided, we attempt to create an account for the user.
        $new_account_id = $this->accounts_model->createAccount($account_data);

        if (!$new_account_id) {
            // 2.a) Failed to create the new account.
            // Handle the failure, prepare and return an appropriate response.
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Failed to create the new account.'], 500);
        }

        // 3) A new account has been successfully created. 
        // Prepare and return a response.
        // You might want to include additional data in the response.
        return $this->prepareOkResponse($response, ['success' => true, 'message' => 'Account created successfully.', 'account_id' => $new_account_id]);
    }

    public function handleGenerateToken(Request $request, Response $response, array $args)
    {
        $account_data = $request->getParsedBody();

        // 1) Reject the request if the request body is empty.
        if (empty($account_data)) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);
        }

        // TODO: Add validation for account credentials.
        // ...

        // 3) Check if there is an account matching the provided email address in the DB.
        $db_account = $this->accounts_model->getAccountByEmail($account_data['email']);

        if (!$db_account) {
            // 4.a) If the account does not exist, prepare and return a response with a message indicating the reason.
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Account not found.'], 404);
        }

        // TODO: Verify whether the provided password is valid.
        // ...

        // 5) Valid account detected => Now, we return an HTTP response containing the newly generated JWT.
        // TODO: add the account role to be included as JWT private claims.

        // 5.a): Prepare the private claims: user_id, email, and role.
        $private_claims = [
            'user_id' => $db_account['user_id'],
            'email' => $db_account['email'],
            'role' => $db_account['role'],
        ];

        // Current time stamp * 60 seconds
        $expires_in = time() + 60; //! NOTE: Expires in 1 minute.

        // 5.b) Create a JWT using the JWTManager's generateJWT() method.
        $jwt = JWTManager::generateJWT($private_claims, $expires_in);

        // 5.c) Prepare and return a response with a JSON doc containing the jwt.
        return $this->prepareOkResponse($response, ['token' => $jwt]);
    }
}
