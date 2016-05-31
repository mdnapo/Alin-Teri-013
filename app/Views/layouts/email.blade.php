<html>
<body style="background-color: #009688;">
<table bgcolor="#EEEEEE" align="center" border="0" cellpadding="0" cellspacing="0" width="650px">
    <tbody>
    <tr>
        <td>
            <table bgcolor="#DDDDDD" border="0" cellpadding="0" cellspacing="0" width="650px">
                <tbody>
                <tr style="height: 20px">
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/images/logo.png') }}"/>
                        </a>
                    </td>
                </tr>
                <tr style="height: 20px">
                    <td>
                        &nbsp;
                    </td>
                </tr>
                </tbody>
            </table>
            <table border="0" style="padding: -5px;" cellspacing="0" width="650px">
                <tbody>
                @yield('body')
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>