<?php

namespace App\Http\Services\Api;

class AuthService
{
    /** 
     * POST: Login & generate token
     */
    public function login(array $data)
    { 
        try {
            // Start DB Transaction
            DB::beginTransaction();

            // Example throw ServiceException
            // if () {
            //     throw new ServiceException(
            //         message: 'Message describing the error ...',
            //         code: 403,
            //         context: [

            //         ]
            //     );
            // }

            // Commit Transaction
            DB::commit();
        } catch (ServiceException $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $th) {
            // Rollback Transaction
            DB::rollBack();
            throw new ServiceException(
                message: $th->getMessage(),
                code: 500,
                context: [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
                ]
            );
        }
    }
}
