<?php

namespace App\Controllers;

use Config\Database;

class TestDatabase extends BaseController
{
    public function index()
    {
        try {
            $db = Database::connect();
            $db->initialize();

            $query = $db->query(
                "SELECT current_database() AS nama_database,
                        current_user AS username"
            );

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'CI4 berhasil terhubung ke PostgreSQL!',
                'database' => $query->getRowArray()
            ]);

        } catch (\Throwable $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }
}
