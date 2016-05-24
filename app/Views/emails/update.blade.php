<html>
<body>
@if ($donations->count() > 0)
    <h3>{{ ($donations->count() == 1) ? 'Er is 1 foto donatie die wacht op acceptatie':'Er zijn ' . $donations->count() . ' foto donaties die wachten op acceptatie' }}
        :</h3>
    @foreach($donations as $donation)

    @endforeach
@else
    <h3>Er zijn geen nieuwe foto donaties ontvangen.</h3>
@endif
@if ($contacts->count() > 0)
    <h3>{{ ($donations->count() == 1) ? 'Er is 1 nieuw contactverzoek ontvangen.':'Er zijn ' . $contacts->count() . ' nieuwe contactverzoeken ontvangen' }}
        :</h3>
    @foreach($contacts as $contact)

    @endforeach
@else
    <h3>Er zijn geen niewe contact verzoeken ontvangen.</h3>
@endif
</body>
</html>