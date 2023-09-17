<?php use app\base\Init;

$firstName = Init::$self->user->firstname;
$lastName = Init::$self->user->lastname;
$email = Init::$self->user->email;
?>

<div class="container" style="padding: 5rem;">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <p class="card-text">Full Name</p>
            <h5 class="card-title"><?php echo $firstName .' '. $lastName ?></h5>
        </div>
        <div class="card-body">
            <p class="card-text">Email</p>
            <h5 class="card-title"><?php echo $email?></h5>
        </div>
    </div>
</div>