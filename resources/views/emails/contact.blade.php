<!DOCTYPE html>
<html>
<head>
    <title>Nieuw contact bericht</title>
</head>

<body>
    <h2>Nieuw bericht via Stof Shop</h2>

    <p><strong>Naam:</strong> {{ $data['name'] }}</p>

    <p><strong>Email:</strong> {{ $data['email'] }}</p>

    <p><strong>Telefoon:</strong> {{ $data['phone'] ?? '-' }}</p>

    <p><strong>Bedrijf:</strong> {{ $data['company'] ?? '-' }}</p>

    <hr>

    <p><strong>Bericht:</strong></p>

    <h2>Hallo {{ $data['name'] }},</h2>

    @if(isset($data['reply']))
        <p>{{ $data['reply'] }}</p>
    @endif
    
    @if(isset($data['message']))
        <h3>Nieuw contactbericht:</h3>
    
        <p>
            {{ $data['message'] }}
        </p>
    @endif

</body>
</html>

