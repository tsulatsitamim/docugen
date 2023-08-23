<table>
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
