<!DOCTYPE html>
<html>
<head>
    <title>participants</title>
</head>
<body>


<h1>Contest "{{$contest->name}}" and , winners are chosen</h1>

<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                <thead>
                <tr>
                    <th>name</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Email</th>
                </tr>
                </thead>
                @if(isset($participants))
                    @if(count($participants)==0)
                        <h1>No participants</h1>
                    @elseif( count($participants)>1)
                        @foreach($participants as $participant)
                            <tr>
                                <td align="center" valign="top">
                                    {{$participant->name}}
                                </td>
                                <td align="center" valign="top">
                                    {{$participant->address}}
                                </td>
                                <td align="center" valign="top">
                                    {{$participant->location}}
                                </td>
                                <td align="center" valign="top">
                                    {{$participant->email}}
                                </td>
                            </tr>
                        @endforeach
                    @else

                        <tr>
                            <td align="center" valign="top">
                                {{$participants->name}}
                            </td>
                            <td align="center" valign="top">
                                {{$participants->address}}
                            </td>
                            <td align="center" valign="top">
                                {{$participants->location}}
                            </td>
                            <td align="center" valign="top">
                                {{$participants->email}}
                            </td>
                        </tr>
                    @endif
                @endif
            </table>
        </td>
    </tr>

</table>


</body>
</html>