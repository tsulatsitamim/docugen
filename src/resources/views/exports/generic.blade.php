<style>
    table {
        border-collapse: separate;
        border-spacing: 0;
        border-top: 1px solid #333;
    }

    td {
        padding: 10px 5px;
        font-size: 12px;
        border-bottom: 1px solid #333;
        border-right: 1px solid #333;
    }

    td:first-child {
        border-left: 1px solid #333;
    }
</style>

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
