<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Department;
use App\Entity\Manager;

class AppFixtures extends Fixture
{
    private $stages = [
        [
            'code' => 'new',
            'name' => 'Новая'
        ],
        [
            'code' => 'in_progress',
            'name' => 'В работе'
        ],
        [
            'code' => 'closed',
            'name' => 'Закрыта'
        ]
    ];

    private $departments = [
        [
            'code' => 'sells',
            'name' => 'Отдел продаж',
            'permissions' => 1
        ],
        [
            'code' => 'financial',
            'name' => 'Бухгалтерия',
            'permissions' => 2
        ],
        [
            'code' => 'administration',
            'name' => 'Администрация',
            'permissions' => 3
        ]
    ];

    private $managers = [
        [
            'name' => 'Вася Пупкин',
            'phone' => '79998882223',
            'registered' => '1544087095',
            'birthdate' => '1544087095',
            'department' => 1
        ],
        [
            'name' => 'Пётр Первый',
            'phone' => '79998882224',
            'registered' => '1544087095',
            'birthdate' => '1544087095',
            'department' => 2
        ],
        [
            'name' => 'Бузова',
            'phone' => '79998882225',
            'registered' => '1544087095',
            'birthdate' => '1544087095',
            'department' => 3
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $departments = [];
        foreach ($this->stages as $stage) {
            $ob = new Stage();
            $ob->setCode($stage['code']);
            $ob->setName($stage['name']);
            $manager->persist($ob);
        }

        foreach ($this->departments as $dept) {
            $ob = new Department();
            $ob->setCode($dept['code']);
            $ob->setName($dept['name']);
            $ob->setPermissions($dept['permissions']);
            $departments[] = $ob;
            $manager->persist($ob);
        }

        foreach ($this->managers as $man) {
            $ob = new Manager();
            $ob->setName($man['name']);
            $ob->setPhone($man['phone']);
            $ob->setRegistered($man['registered']);
            $ob->setBirthdate($man['birthdate']);
            $ob->setDepartment($departments[rand(0, 2)]);
            $manager->persist($ob);
        }

        $manager->flush();
    }
}
