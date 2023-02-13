<?php
// tests/AuthenticationTest.php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;

class UserTest extends ApiTestCase
{


    // private string $jwtToken;
    // private array $users;

    public  function testLogin(): void
    {
        $response = static::createClient()->request('POST', '/authentication_token', ['json' => [
            'email' => 'cake1@gmail.com',
            'password' => 'test',
        ]]);
        $this->assertResponseIsSuccessful();
    }

    // public function testCreateUser(): void
    // {
    //     // Test POST /api/users without auth
    //     $response = static::createClient()->request('POST', '/users', ['headers' => ['Accept' => 'application/json'], 'json' => [
    //         'email' => 'test-new-user@example.com',
    //         'roles' => ['ROLE_USER'],
    //         'password' => 'password',
    //         'plainPassword' => 'password',
    //         'firstName' => 'test',
    //         'lastName' => 'test',
    //         'is_Active' => true,
    //         'address' => 'test',
    //         'city' => 'test',
    //         'postal_code' => 75000,
    //         'country' => 'test',



    //     ]]);
    //     $this->assertResponseStatusCodeSame(201);
    // }


    // public function testLogin(): void
    // {
    //     $client = self::getClient();
    //     $container = self::getContainer();

    //     // $user = new User();
    //     // $user->setEmail('user1@gmail.com');
    //     // $user->setPassword(
    //     //     $container->get('security.user_password_hasher')->hashPassword($user, 'test')
    //     // );

    //     // $manager = $container->get('doctrine')->getManager();
    //     // $manager->persist($user);
    //     // $manager->flush();

    //     // retrieve a token
    //     $response = $client->request('POST', '/authentication_token', [
    //         'headers' => ['Content-Type' => 'application/json'],
    //         'json' => [
    //             'email' => 'user1@gmail.com',
    //             'password' => 'test',
    //         ],
    //     ]);

    //     $json = $response->toArray();
    //     $this->assertResponseIsSuccessful();
    //     $this->assertArrayHasKey('token', $json);

    //     // test not authorized
    //     // $client->request('GET', '/authentication_token');
    //     // $this->assertResponseStatusCodeSame(401);

    //     // test authorized
    //     // $client->request('GET', '/authentication_token', ['auth_bearer' => $json['token']]);
    //     // $this->assertResponseIsSuccessful();
    // }
}
