    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('Message')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Create')}}</th>
            </tr>
        </thead>
        <tbody>
            @php $n = 0; @endphp
            @if($notifications->isNotEmpty())
                @foreach ($notifications as $key => $notification)
                    <tr>
                        <td>{{ ($notifications ->currentpage()-1) * $notifications ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->notification_type }}</td>
                        <td>{{ date('d-m-Y', strtotime($notification->created_at)) }}</td>                                                    
                    </tr>
                @endforeach
            @else
                <tr><td colspan="4">{{__('No items found.')}}</td></tr>
            @endif
        </tbody>
    </table>                                    
@if($notifications->isNotEmpty())
{{ $notifications->links() }}
@endif