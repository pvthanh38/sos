<?php
$user = \App\User::find($notification->data['user_id']);
?>

@lang(':name: updated a FAQ #:id', ['name' => $user->present()->name ?? 'None', 'id' => $notification->data['id']])