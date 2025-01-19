<?php

namespace App\DTOs;

class OperationResultDTO {
    public $status;
    public $message;
    public $data;

    public function __construct(bool $status, string $message = '', $data = null) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public function toArray() {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
