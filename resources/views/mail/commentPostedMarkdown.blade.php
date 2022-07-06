@component('mail::message')
# Hi

Someone has commented on your blog post

@component('mail::panel')
{{ $comment->comment }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
