<?php
$className = snake_case(class_basename($notification->type));
?>

<a href="@include('horicon::notifications.apps.' . $className . '_url')" class="dropdown-item notify-item">
    <div class="notify-icon bg-primary">
        <i class="fas fa-question"></i>
    </div>

    <p class="notify-details">
        @include('horicon::notifications.apps.' . $className)
    </p>

    <p class="text-muted mb-0 user-msg">
        <small>{{ $notification->created_at->diffForHumans() }}</small>
    </p>
</a>