# n-Tube Type Clone

**This is a work in progress (WIP) and will regularly be updated.**

This document has the command "sail" used heavily. This is because 
development was completed using a Docker based dev environment that is 
part of the Laravel installation. This may be omitted if you are not 
using Docker in your development process.

---
# Create new app

For all commands where `xxx` is shown, replace with your initials.

```bash
curl -s https://laravel.build/xxx-yt-clone | bash 
cd xxx-yt-clone 
sail up
```
---
# Initialise Version Control

We do this in two steps:
1. Create remote repository on GitHub or similar
2. Initialise the local repository, add and commit the ReadMe (this file), set the origin and then push to the remote we created.

## Create Remote Repository
Open the [GitHub website](http://github.com) and log into your account.

In the account create a new repository, but ensure the following:
- Do NOT add a readme or .gitignore or other files
- Make the project private if required
- Give the repository a suitable name (I used `totally-blank` in the demo image)

Keep the browser open as you are then able to copy the URL and 
commands as needed.

![Empty Repository Example](docs/images/Empty-Repo-GitHub.png)

### Terminal time
Open a terminal so that we may initialise the Repository.

> We usually need TWO terminals when developing, so if you have one 
> open, open a new one and make sure you are in your xxx-yt-clone folder
> before continuing.

Then run the following command sequence.

```bash
git init
git add ReadMe.md
git commit -m "Initial commit to start repository"
git branch -M main
git remote add origin URL_TO_YOUR_EMPTY_REMOTE_REPO
git push -u origin main
```

![Initialiasing the repository](docs/images/ReadMe.png)

## Updating and Committing the .gitignore

Add, or replace the contents of the attached file to the .gitignore file: [.gitignore](.gitignore)

```bash
git add .gitignore
git commit -m "Update the .gitignore to remove unwanted files"
git push -u origin main
```

---
# Add UI Skeleton Code

We are now ready to add the Jetstream UI components...

The installation will add registration and other components for the 
user, plus...

```bash
sail php artisan sail:publish
sail composer require laravel/jetstream
sail php artisan jetstream:install livewire --teams 

sail npm install 
sail npm run dev
sail php artisan migrate:fresh --seed
sail php artisan vendor:publish --tag=laravel-mail --tag=laravel-errors 
sail php artisan vendor:publish --tag=sail --tag=jetstream-views --tag=livewire 
sail php artisan vendor:publish --tag=livewire:assets --tag=livewire:config 
sail php artisan vendor:publish --tag=livewire:pagination --tag=sanctum-config
```

These commands add Laravel Livewire, and then publish the components and
some configuration files so that you can directly access and edit or
customise as required.

## IDE Helpers

Now to add a couple of helpers for PhpStorm (possibly other IDEs)...

```bash
sail composer require --dev barryvdh/laravel-ide-helper 
sail php artisan clear-compiled
sail php artisan ide-helper:generate
sail php artisan ide-helper:models -W
sail php artisan ide-helper:meta
```

Open the `composer.json` file, and add/modify an entry to the `scripts` 
area. If the post-update-cmd is already present then add the lines 
between the `[`square brackets`]`.

```json
  "post-update-cmd": [
      "Illuminate\\Foundation\\ComposerScripts::postUpdate",
      "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
      "@php artisan ide-helper:generate",
      "@php artisan ide-helper:models -W",
      "@php artisan ide-helper:meta"
  ],
```

### Do a Commit and Push to Version Control

Do the usual sequence of adding and pushing to  verison control, 
with a suitable comment:

```bash
git add .
git commit -m "Default configuration without seed users"
git push -u origin main
```

---
# Create Model for Channel

This command also creates a migration, factory, seeder, controller and 
policy for the Channels.

```bash
sail php artisan make:model Channel -a -r
```

Go to the `database/migrations` folder and open the file that contains `create_channels_table.php` in its filename.

Modify/Add the following code:

```PHP
Schema::create('channels', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('name');
    $table->string('slug');
    $table->boolean('private')->default(false);
    $table->string('uid');
    $table->text('description')->nullable();
    $table->string('image')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')
        ->on('users')->oncascade('delete');
});
```

Now open the model file for the channel, `Channel.php` that is in the `app/Models` folder.

Edit it to define the editable fields, and also the relationship between channel and user.

Add the following code inside the class definition, and after the `use HasFactory;` line:

```php
    protected $fillable = [
        'name',
        'description',
        'image',
        'public',
        'slug',
        'uid',
        'user_id',
    ];

    /**
     * A channel BELONGS TO a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
```

Edit the `User.php` file from the same folder and add the following relationship definition within the class, and after the `$casts`
definition:

```php
    /**
     * A user has MANY channels
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channels(){
        return $this->hasMany(Channel::class);
    }
```

Now run the migration again:

```bash
sail php artisan migrate:fresh --seed
```

When a user registers, we want the application to automatically create 
them a channel based around the user's name and add 'channel' to the 
end.

The channel name will be similar to this: `Eileen Dover Public Channel`.

It will have a 'slug' that will be similar to
`eileen-dover-public-channel`.

This slug will be used to identify the required channel when using a URL
similar to
`http://yt-clone.com/channels/eileen-dover-public-channel`.

To get the slug to be used for 'routing' we need to edit the Channel 
model and add the following before the `public function user` line:

```php
    /**
     * Provides the key name for the routes to be the slug in place of the commonly used 'id'.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
```

## Time to commit to this

OK, we have made some large changes in the code, so we will commit them to version control.

Perform the usual steps:

- add files to the staging area
- check the status of files in the staging area
- commit the changes to the repository
- push the changes to the remote repository

```bash
git add .
git status
git commit -m "Base application plus Channel model and migration"
git push origin main
```

---
# Add Seeder Data

To enable interactive testing, we will add some seed data that we can repeatedly use.

## User Seeder

Run the command:

```bash
sail php artisan make:seeder UserSeeder
```

Now find and open the new file in the `database/seeders` folder.

In the run method we are going to do two things:

1. Add required 'uses' statements
2. Create a list of known seed users,
3. Create the new user.
4. Create public and private channels for each user.
5. Create a 'team' for each user.

### Include Required Classes

Before we add the users, we will add the required `uses` statements:

```php
use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;
use Str;
```

We will be making use of these when we seed.

### Define Users
The seed users are:

```text
|---------------|--------------------|-----------|
| User Name     | eMail              |Password   |
|---------------|--------------------|-----------|
| Administrator | admin@example.com  | Password1 |
| Eileen Dover  | eileen@example.com | Password1 |
| Russel Leaves | russel@example.com | Password1 |
|---------------|--------------------|-----------|
```

These are added to an array containing an associative array for each 
user. The PHP to do this is shown below, and you should add it to the 
run method:

```php
$seedUsers = [
            [
            'name'=>'Administrator',
            'email'=>'admin@example.com',
            'password'=>Hash::make('Password1'),
                ],
            [
            'name'=>'Eileen Dover',
            'email'=>'eileen@example.com',
            'password'=>Hash::make('Password1'),
                ],
            [
            'name'=>'Russel Leaves',
            'email'=>'russel@example.com',
            'password'=>Hash::make('Password1'),
                ],
        ];
```

### Seeding Loop

Next we will create the loop that adds each new user, plus creates the channel:

```php
foreach ($seedUsers as $seedUser) {
    $user = User::create($seedUser);
    $team = $this->createTeam($user);
    foreach (['Public', 'Private'] as $pubOrPrivate) {
        $channelName = implode([$user->name, " ", $pubOrPrivate," channel"]);
        $userChannel = [
            'user_id' => $user->id,
            'name' => $channelName,
            'slug' => Str::slug($channelName, '-'),
            'public'=> $pubOrPrivate==='Public',
            'uid' => uniqid(true, true),
            'description' => null,
            'image' => null,
        ];
        Channel::create($userChannel);
    }
}
```

### Create Team method

After the seeding loop and just before the closing `}` curly bracket 
of the class we will add the following code, which creates a new 
personal team for the user. 

> We may or may not use teams later in the project.

```php
/**
 * Create a personal team for the user.
 *
 * Taken from the CreateNewUser class and reproduced for simplicity.
 *
 * @param  \App\Models\User  $user
 * @return void
 */
protected function createTeam(User $user)
{
    $user->ownedTeams()->save(
        Team::forceCreate([
              'user_id' => $user->id,
              'name' => explode(' ', $user->name, 2)[0]."'s Team",
              'personal_team' => true,
          ])
    );
}
```

## Channel Seeder

We do not have any seeding to be added at this time to the channels.

## Add Seeder Calls

Open the `DatabaseSeeder.php` file and modify the code so that it 
runs the required seeders in turn, starting with User.

The run method becomes:

```php
public function run()
{
    // \App\Models\User::factory(10)->create();
    $this->call([
        UserSeeder::class,
        ChannelSeeder::class,
                ]);
}
```

## Re-Run the Migrations

Now re-run the migration using:

```bash
sail php artisan migrate:fresh --seed
```

![Seeding the users and creating their channels and teams at the 
same time](docs/images/Seeding-users-channels-teams.png)

### Add, Commit, Push

Let's add the new code to version control.

```bash
git add .
git status
git commit -m "Base application plus Channel model and migration"
git push origin main
```

---



