<div>
    GPS Coordinates: {{ $gpsCoordinates->lon }} {{ $gpsCoordinates->lat }}
</div>
<table style="border-collapse: collapse">
    @foreach ($hourlyForecasts as $forecast)
        <tr>
            <td style="border: 1px solid black; padding: 5px">{{ date('j F, Y H:i:s', strtotime($forecast->time)) }}</td>
            <td style="border: 1px solid black; padding: 5px">{{ $forecast->temp }} {{ $unit }}</td>
        </tr>
    @endforeach
</table>

