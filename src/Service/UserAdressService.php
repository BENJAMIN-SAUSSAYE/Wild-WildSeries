<?php

namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;

class UserAdressService
{
	public function __construct(private UserRepository $userRepository)
	{
	}

	public function getUserAdressFromSpecificRole(?string $role,): array
	{
		$listAdress = [];

		$listEmail = $this->userRepository->getEmailsFromSpecificRole($role);

		foreach ($listEmail[0] as $mail) {
			$listAdress[] = $mail;
		}

		return $listAdress;
	}
}
