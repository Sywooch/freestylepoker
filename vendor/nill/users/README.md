Yii2 users module.
========================
Configuration
-------------

- Add module to config section:

```
'modules' => [
    'users' => [
        'class' => 'nill\blogs\Module',
        'robotEmail' => 'no-reply@yii2-start.domain', // Sender email. This email is required. From this address module will send all emails
        'robotName' => 'Robot' // Sender name
    ]
]
```

- Run migrations:

```
php yii migrate --migrationPath=@nill/users/migrations
```

- Run RBAC command:

```
php yii users/rbac/add
```