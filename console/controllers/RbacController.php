<?php


namespace app\console\controllers;


use app\models\user\UserRecord;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        UserRecord::deleteAll();

        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand("ALTER TABLE user AUTO_INCREMENT = 1");
        $command->execute();

        $user1 = new UserRecord();
        $user1->username = 'First';
        $user1->password = '111111';

        $user1->save();

        $user2 = new UserRecord();
        $user2->username = 'Second';
        $user2->password = '222222';

        $user2->save();

        $authManager = \Yii::$app->authManager;

        $authManager->removeAll();

        $allCustomers = $authManager->createPermission('allCustomers');
        $allCustomers->description = 'Просмотр списка покупателей';
        $authManager->add($allCustomers);

        $viewCustomer = $authManager->createPermission('viewCustomer');
        $viewCustomer->description = 'Просмотр покупателя';
        $authManager->add($viewCustomer);

        $createCustomer = $authManager->createPermission('createCustomer');
        $createCustomer->description = 'Добавление покупателя';
        $authManager->add($createCustomer);

        $updateCustomer = $authManager->createPermission('updateCustomer');
        $updateCustomer->description = 'Добавление списка покупателей';
        $authManager->add($updateCustomer);

        $deleteCustomer = $authManager->createPermission('deleteCustomer');
        $deleteCustomer->description = 'Удаление покупателя';
        $authManager->add($deleteCustomer);

        $admin = $authManager->createRole('admin');
        $admin->description = 'Админ';
        $authManager->add($admin);
        $authManager->addChild($admin, $createCustomer);
        $authManager->addChild($admin, $updateCustomer);
        $authManager->addChild($admin, $deleteCustomer);

        $manager = $authManager->createRole('manager');
        $manager->description = 'Менеджер';
        $authManager->add($manager);

        $authManager->addChild($manager, $allCustomers);
        $authManager->addChild($manager, $viewCustomer);
        $authManager->addChild($admin, $manager);

        $authManager->assign($admin, 1);
        $authManager->assign($manager, 2);
    }
}