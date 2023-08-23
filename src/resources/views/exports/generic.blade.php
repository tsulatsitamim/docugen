<table>
    <thead>
        <tr>
            @foreach ($items[0] as $header)
                <th>{!! $header !!}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                @for ($i = 0; $i < $columns; $i++)
                    <td>{!! $item[$i] ?? '' !!}</td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
