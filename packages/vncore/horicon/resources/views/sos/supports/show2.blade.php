<h3 class="mb-2">{{ $support->location }}</h3>
<iframe
        width="100%"
        height="400"
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0"
        src="https://maps.google.com/maps?q={{ $support->lat }},{{ $support->lng }}&hl=es;z=14&amp;output=embed"
>
</iframe>
<div>{!! nl2br(e($support->content)) !!}</div>