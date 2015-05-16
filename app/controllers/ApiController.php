<?php 

class ApiController extends BaseController
{

    protected $statusCode = 200;

    /* Start of Getter and Setter for Status Code */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    /* End of Getter and Setter for Status Code */


    /* This 2 function is for errors regarding fetching of data */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }


    // This function handles all the error messages.
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    // this function handles the success messages.
    public function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message 

        ]);
    }

    // This function is the one responsible for giving you the result.
    public function respond($data, $headers = [])
    {
        return Response::json($data,$this->getStatusCode(), $headers);
    }





}