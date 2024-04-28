<?php

class User
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $email;
    public string $gender;
    public string $created;
    public string $uniqueId;

    /**
     * @param array data
     * @return User
     */
    public function __construct(array $data)
    {
        $this->id = $data[0];
        $this->firstName = Utils::uppercaseToCamelCase($data[1]);
        $this->lastName = $data[2];
        $this->address = Utils::formatAddress($data[3], $data[4]);
        $this->email = Utils::maskEmail($data[5]);
        $this->gender = $data[6][0];
        $this->created = Utils::formatDate($data[7]);
        $this->uniqueId = $data[8];
    }
}

class DataService
{
    /**
     * @return User[]
     */
    public static function getUsers(): array
    {
        $users = [];
        $filestream = fopen("users_list.txt", "r");

        if ($filestream !== FALSE) {
            while (($data = fgetcsv($filestream, 0, "	", "\"")) !== FALSE) {
                $users[] = new User($data);
            }
            fclose($filestream);
        } else {
            $_SESSION["errors"][] = "File \"users_list.txt\" not found.";
        }

        array_shift($users);

        return $users;
    }
}