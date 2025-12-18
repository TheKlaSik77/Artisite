<?php
declare(strict_types=1);

require_once __DIR__ . '/utils/connection.php';

final class ProfileModel
{
    public function __construct(private PDO $pdo) {}

    public function getCustomerById(int $userId): ?array
    {
        return fetch_one(
            $this->pdo,
            "
            SELECT user_id, username, first_name, last_name, email, phone_number, description
            FROM `user`
            WHERE user_id = :id
            LIMIT 1
            ",
            ["id" => $userId]
        );
    }

    public function getCraftmanById(int $craftmanId): ?array
    {
        return fetch_one(
            $this->pdo,
            "
            SELECT craftman_id, siret, company_name, description, validator_id
            FROM craftman
            WHERE craftman_id = :id
            LIMIT 1
            ",
            ["id" => $craftmanId]
        );
    }
}
