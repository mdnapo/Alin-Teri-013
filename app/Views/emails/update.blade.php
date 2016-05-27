@extends('layouts.email')
@section('body')
    @if ($donations->count() > 0)
        <tr>
            <td>
                <h4>{{ ($donations->count() == 1) ? 'Er is 1 foto donatie die wacht op acceptatie':'Er zijn ' . $donations->count() . ' foto donaties die wachten op acceptatie' }}
                    :</h4>
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ url('/admin/steun-ons/') }}">
                    <table border="0" cellpadding="5" cellspacing="0" width="650">
                        <tbody>
                        <tr>
                            @for($i = 0; $i < $donations->count(); $i++)
                                @if($i%4 == 0 && $i != 0)
                        </tr>
                        <tr>
                            @endif
                            <td align="center">
                                <img src="{{ asset($donations[$i]->pic_loc) }}"
                                     height="145px"
                                     width="145px"/>
                            </td>
                            @endfor
                        </tr>
                        </tbody>
                    </table>
                </a>
            </td>
        </tr>
    @else
        <tr>
            <td>
                <h4>Er zijn geen nieuwe foto donaties ontvangen.</h4>
            </td>
        </tr>
    @endif

    @if ($contacts->count() > 0)
        <tr>
            <td>
                <h4>{{ ($donations->count() == 1) ? 'Er is 1 nieuw contactverzoek ontvangen.':'Er zijn ' . $contacts->count() . ' nieuwe contactverzoeken ontvangen' }}
                    :</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" cellpadding="5" cellspacing="0" width="650">
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                <span>{{ $contact->email}}</span>
                            </td>
                            <td>
                                {!! $contact->bericht !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    @else
        <tr>
            <td>
                <h4>Er zijn geen nieuwe contact verzoeken ontvangen.</h4>
            </td>
        </tr>
    @endif

@stop