<a href="{{ $support->url()->show() }}" target="_blank">Chi tiết: #{{ $support->id }}</a>
<br/>
<table class="table">
    <tr>
        <td class="font-bold">Họ tên:</td>
        <td>{{ $user->name }}</td>
        <td class="font-bold">Hộ chiếu:</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td class="font-bold">Điện thoại:</td>
        <td>{{ $support->phone ? $support->phone : $user->sosUser->phone }}</td>
        <td class="font-bold">Ngày tháng:</td>
        <td>{{ $support->created_at->toDateTimeString() }}</td>
    </tr>
    <tr>
        <td class="font-bold">Trạng thái:</td>
        <td>
            @if($support->status == 0)
                <i class="fas fa-circle text-info"></i> Mới
            @elseif($support->status == 1)
                <i class="fas fa-circle text-success"></i> Hoàn thành
            @else
                <i class="fas fa-circle text-warning"></i> Đang xử lý
            @endif
        </td>
        <td class="font-bold">Loại hỗ trợ:</td>
        <td><i class="fas fa-circle {{ $support->urgent ? 'text-danger' : 'text-info' }}"></i>{{ $support->urgent ? __('SOS') : __('Bình thường') }}</td>
    </tr>
    <tr>
        <td class="font-bold">Tên vị trí:</td>
        <td>{!! $support->location !!}</td>
        <td class="font-bold">Nội dung:</td>
        <td>{!! nl2br(e($support->content)) !!}</td>
    </tr>
</table>

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